<?php

namespace Tests\Feature;

use App\Models\Slider;
use App\Models\User;
use DOMDocument;
use DOMXPath;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SliderAdminPageTest extends TestCase
{
    use RefreshDatabase;

    /** A real 1x1 PNG, so the image rules pass without the GD extension. */
    private const PNG = 'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNkYPhfDwAChwGA60e6kgAAAABJRU5ErkJggg==';

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');
    }

    private function admin(): User
    {
        return User::factory()->create(['is_admin' => 1]);
    }

    private function upload(string $name = 'banner.png'): UploadedFile
    {
        $path = tempnam(sys_get_temp_dir(), 'slider') . '.png';
        file_put_contents($path, base64_decode(self::PNG));

        return new UploadedFile($path, $name, 'image/png', null, true);
    }

    private function xpath(string $html): DOMXPath
    {
        $previous = libxml_use_internal_errors(true);

        $dom = new DOMDocument();
        $dom->loadHTML($html);

        libxml_clear_errors();
        libxml_use_internal_errors($previous);

        return new DOMXPath($dom);
    }

    /**
     * The screen used to render the file inputs outside the form, so Save sent
     * an empty request and every upload was silently dropped.
     */
    public function test_every_file_input_belongs_to_the_save_form(): void
    {
        $html = $this->actingAs($this->admin())->get('/admin/sliders')->assertOk()->getContent();
        $xpath = $this->xpath($html);

        $form = $xpath->query('//form[@id="sliderForm"]');
        $this->assertSame(1, $form->length, 'The save form is missing.');

        foreach (['slider1', 'slider2', 'about_image'] as $field) {
            $inputs = $xpath->query("//form[@id=\"sliderForm\"]//input[@type=\"file\"][@name=\"{$field}\"]");
            $this->assertSame(1, $inputs->length, "The {$field} file input is not inside the save form.");
        }
    }

    public function test_the_save_form_posts_multipart_to_the_store_route(): void
    {
        $html = $this->actingAs($this->admin())->get('/admin/sliders')->assertOk()->getContent();

        $this->assertMatchesRegularExpression(
            '/<form[^>]*id="sliderForm"[^>]*>/',
            $html
        );
        $this->assertStringContainsString('enctype="multipart/form-data"', $html);
        $this->assertStringContainsString('action="' . url('/admin/sliders/store') . '"', $html);
    }

    public function test_a_save_button_sits_inside_the_form_it_submits(): void
    {
        $html = $this->actingAs($this->admin())->get('/admin/sliders')->assertOk()->getContent();
        $xpath = $this->xpath($html);

        $buttons = $xpath->query('//form[@id="sliderForm"]//button[@type="submit"]');

        $this->assertSame(1, $buttons->length, 'The Save button is not inside the save form.');
    }

    public function test_each_uploaded_image_gets_its_own_delete_button(): void
    {
        Storage::disk('public')->put('sliders/desktop.jpg', 'bytes');
        Storage::disk('public')->put('sliders/mobile.jpg', 'bytes');
        Storage::disk('public')->put('sliders/promise.jpg', 'bytes');

        Slider::create([
            'slider1'     => 'sliders/desktop.jpg',
            'slider2'     => 'sliders/mobile.jpg',
            'about_image' => 'sliders/promise.jpg',
        ]);

        $html = $this->actingAs($this->admin())->get('/admin/sliders')->assertOk()->getContent();

        foreach (['slider1', 'slider2', 'about_image'] as $field) {
            $this->assertStringContainsString("clearImage('{$field}')", $html, "No delete control for {$field}.");
        }

        // One labelled button per card, plus the ✕ overlay on each preview.
        $this->assertSame(3, substr_count($html, '<i class="bi bi-trash3 me-1"></i>Delete this image'));
        $this->assertSame(3, substr_count($html, 'class="slider-preview__clear"'));
    }

    public function test_a_field_without_an_image_offers_no_delete_button(): void
    {
        Storage::disk('public')->put('sliders/desktop.jpg', 'bytes');

        Slider::create(['slider1' => 'sliders/desktop.jpg']);

        $html = $this->actingAs($this->admin())->get('/admin/sliders')->assertOk()->getContent();

        $this->assertStringContainsString("clearImage('slider1')", $html);
        $this->assertStringNotContainsString("clearImage('slider2')", $html);
        $this->assertStringNotContainsString("clearImage('about_image')", $html);
        $this->assertSame(1, substr_count($html, '<i class="bi bi-trash3 me-1"></i>Delete this image'));
        $this->assertSame(2, substr_count($html, 'No image to delete'));
    }

    public function test_the_delete_confirmation_uses_sweetalert_not_native_confirm(): void
    {
        Storage::disk('public')->put('sliders/desktop.jpg', 'bytes');

        Slider::create(['slider1' => 'sliders/desktop.jpg']);

        $html = $this->actingAs($this->admin())->get('/admin/sliders')->assertOk()->getContent();

        $this->assertStringContainsString('Swal.fire', $html);
        // Both the per-image delete and Delete All go through Swal.
        $this->assertStringContainsString('Delete this image?', $html);
        $this->assertStringContainsString('Delete all sliders?', $html);
        // A native confirm() would block the dialog SweetAlert renders.
        $this->assertStringNotContainsString('return confirm(', $html);
        $this->assertStringNotContainsString('window.confirm(', $html);
    }

    public function test_the_screen_hands_the_delete_script_the_row_id(): void
    {
        Storage::disk('public')->put('sliders/desktop.jpg', 'bytes');

        $slider = Slider::create(['slider1' => 'sliders/desktop.jpg']);

        $html = $this->actingAs($this->admin())->get('/admin/sliders')->assertOk()->getContent();
        $xpath = $this->xpath($html);

        $hidden = $xpath->query('//input[@id="sliderId"]');

        $this->assertSame(1, $hidden->length);
        $this->assertSame((string) $slider->id, $hidden->item(0)->getAttribute('value'));
    }

    public function test_deleting_one_image_leaves_the_others_untouched(): void
    {
        Storage::disk('public')->put('sliders/desktop.jpg', 'bytes');
        Storage::disk('public')->put('sliders/mobile.jpg', 'bytes');

        $slider = Slider::create([
            'slider1' => 'sliders/desktop.jpg',
            'slider2' => 'sliders/mobile.jpg',
        ]);

        $this->actingAs($this->admin())
            ->post('/admin/sliders/update/' . $slider->id, ['remove_slider2' => 1])
            ->assertRedirect();

        $slider->refresh();

        $this->assertSame('sliders/desktop.jpg', $slider->slider1);
        $this->assertNull($slider->slider2);
        Storage::disk('public')->assertExists('sliders/desktop.jpg');
        Storage::disk('public')->assertMissing('sliders/mobile.jpg');
    }

    public function test_the_empty_state_is_shown_before_anything_is_uploaded(): void
    {
        $html = $this->actingAs($this->admin())->get('/admin/sliders')->assertOk()->getContent();

        $this->assertStringContainsString('No image to delete', $html);
        $this->assertSame(3, substr_count($html, 'No image to delete'));
        $this->assertStringContainsString('sliderId', $html);
    }

    public function test_a_picked_banner_is_saved_and_replaces_the_one_before_it(): void
    {
        Storage::disk('public')->put('sliders/old.png', 'old-bytes');

        $slider = Slider::create(['slider1' => 'sliders/old.png']);

        $this->actingAs($this->admin())
            ->post('/admin/sliders/store', ['slider1' => $this->upload()])
            ->assertRedirect();

        $slider->refresh();

        $this->assertNotNull($slider->slider1);
        $this->assertNotSame('sliders/old.png', $slider->slider1);
        Storage::disk('public')->assertExists($slider->slider1);
        Storage::disk('public')->assertMissing('sliders/old.png');
    }

    public function test_the_mobile_banner_uploads_through_the_update_route(): void
    {
        Storage::disk('public')->put('sliders/desktop.png', 'bytes');

        $slider = Slider::create(['slider1' => 'sliders/desktop.png']);

        $this->actingAs($this->admin())
            ->post('/admin/sliders/update/' . $slider->id, ['slider2' => $this->upload('mobile.png')])
            ->assertRedirect();

        $slider->refresh();

        $this->assertNotNull($slider->slider2);
        // The desktop banner it was posted alongside is left alone.
        $this->assertSame('sliders/desktop.png', $slider->slider1);
    }

    public function test_non_admins_cannot_reach_the_screen(): void
    {
        $this->actingAs(User::factory()->create(['is_admin' => 0]))
            ->get('/admin/sliders')
            ->assertRedirect('/login');
    }
}
