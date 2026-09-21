<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SliderImageTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');
    }

    private function admin(): User
    {
        return User::factory()->create(['is_admin' => 1]);
    }

    /**
     * The GD extension is not available in this environment, so the file bytes
     * are written directly instead of going through UploadedFile::fake()->image().
     */
    private function storedImage(string $path): string
    {
        Storage::disk('public')->put($path, 'fake-image-bytes');

        return $path;
    }

    private function promiseImageOnHomepage(string $html): ?string
    {
        preg_match('/class="promise__media reveal">\s*<img src="([^"]+)"/', $html, $matches);

        return $matches[1] ?? null;
    }

    public function test_sliders_screen_offers_the_promise_image_field(): void
    {
        Slider::create(['about_image' => $this->storedImage('sliders/promise.jpg')]);

        $this->actingAs($this->admin())
            ->get('/admin/sliders')
            ->assertOk()
            ->assertSee('about_image')
            ->assertSee('Our Promise image')
            ->assertSee('name="about_image"', false);
    }

    public function test_remove_flag_clears_the_about_image_and_its_file(): void
    {
        $path = $this->storedImage('sliders/promise.jpg');
        $slider = Slider::create(['about_image' => $path]);

        $this->actingAs($this->admin())
            ->post('/admin/sliders/update/' . $slider->id, ['remove_about_image' => 1])
            ->assertRedirect();

        $this->assertNull($slider->refresh()->about_image);
        Storage::disk('public')->assertMissing($path);
    }

    public function test_remove_flag_leaves_the_other_images_alone(): void
    {
        $desktop = $this->storedImage('sliders/desktop.jpg');
        $promise = $this->storedImage('sliders/promise.jpg');

        $slider = Slider::create([
            'slider1'     => $desktop,
            'about_image' => $promise,
        ]);

        $this->actingAs($this->admin())
            ->post('/admin/sliders/update/' . $slider->id, ['remove_about_image' => 1]);

        $slider->refresh();

        $this->assertSame($desktop, $slider->slider1);
        $this->assertNull($slider->about_image);
        Storage::disk('public')->assertExists($desktop);
    }

    public function test_store_creates_the_slider_row(): void
    {
        $this->assertSame(0, Slider::count());

        $this->actingAs($this->admin())
            ->post('/admin/sliders/store', ['remove_about_image' => 0])
            ->assertRedirect();

        $this->assertSame(1, Slider::count());
    }

    public function test_homepage_prefers_the_about_image_for_the_promise_band(): void
    {
        $productPhoto = $this->storedImage('product/summer-dress.jpg');
        $aboutImage   = $this->storedImage('sliders/promise.jpg');

        $category = Category::create(['name' => 'Dresses']);
        Product::create([
            'name'        => 'Summer Dress',
            'category_id' => $category->id,
            'base_price'  => 100,
            'price'       => 120,
            'discount'    => 0,
            'stock'       => 5,
            'details'     => 'A lightweight summer dress.',
            'image'       => $productPhoto,
        ]);

        Slider::create(['about_image' => $aboutImage]);

        $html = $this->get('/')->assertOk()->getContent();

        $this->assertSame(
            config('app.storage_url') . $aboutImage,
            $this->promiseImageOnHomepage($html)
        );
    }

    public function test_homepage_falls_back_to_the_newest_product_photo(): void
    {
        $productPhoto = $this->storedImage('product/summer-dress.jpg');

        $category = Category::create(['name' => 'Dresses']);
        Product::create([
            'name'        => 'Summer Dress',
            'category_id' => $category->id,
            'base_price'  => 100,
            'price'       => 120,
            'discount'    => 0,
            'stock'       => 5,
            'details'     => 'A lightweight summer dress.',
            'image'       => $productPhoto,
        ]);

        // A slider row exists but carries no promise image.
        Slider::create(['slider1' => $this->storedImage('sliders/desktop.jpg')]);

        $html = $this->get('/')->assertOk()->getContent();

        $this->assertSame(
            config('app.storage_url') . $productPhoto,
            $this->promiseImageOnHomepage($html)
        );
    }
}
