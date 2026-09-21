<?php

namespace Tests\Feature;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CheckoutPageTest extends TestCase
{
    use RefreshDatabase;

    private function product(): Product
    {
        $category = Category::create(['name' => 'Dresses']);

        return Product::create([
            'name'        => 'Summer Dress',
            'category_id' => $category->id,
            'base_price'  => 100,
            'price'       => 120,
            'discount'    => 0,
            'stock'       => 7,
            'details'     => 'A lightweight summer dress.',
            'image'       => 'product/summer-dress.jpg',
        ]);
    }

    private function userWithItem(): User
    {
        $user = User::factory()->create();
        Cart::create(['user_id' => $user->id, 'product_id' => $this->product()->id, 'quantity' => 2]);

        return $user;
    }

    public function test_checkout_shows_the_progress_track_on_the_details_step(): void
    {
        $this->actingAs($this->userWithItem())
            ->get('/billing')
            ->assertOk()
            ->assertSee('checkout-steps')
            ->assertSee('aria-current="step"', false)
            // Bag is behind us, Details is where we are.
            ->assertSee('checkout-step is-done', false)
            ->assertSee('checkout-step is-current', false);
    }

    public function test_delivery_region_is_choosable_and_posts_with_the_form(): void
    {
        $response = $this->actingAs($this->userWithItem())->get('/billing')->assertOk();

        $html = $response->getContent();

        // The radios carry the field name themselves, so the choice still
        // reaches the controller if the totals script never runs.
        $this->assertStringContainsString('name="delivery_region" value="inside"', $html);
        $this->assertStringContainsString('name="delivery_region" value="outside"', $html);
    }

    public function test_inside_khulna_is_preselected(): void
    {
        $html = $this->actingAs($this->userWithItem())
            ->get('/billing')
            ->assertOk()
            ->assertSee('data-old=""', false)
            ->getContent();

        $this->assertMatchesRegularExpression('/name="delivery_region" value="inside"\s+checked/', $html);
    }

    public function test_a_posted_region_survives_a_validation_round_trip(): void
    {
        $html = $this->actingAs($this->userWithItem())
            ->withSession(['_old_input' => ['delivery_region' => 'outside']])
            ->get('/billing')
            ->assertOk()
            ->assertSee('data-old="outside"', false)
            ->getContent();

        $this->assertMatchesRegularExpression('/name="delivery_region" value="outside"\s+checked/', $html);
    }

    public function test_summary_lists_items_and_offers_the_mobile_submit_bar(): void
    {
        $this->actingAs($this->userWithItem())
            ->get('/billing')
            ->assertOk()
            ->assertSee('checkout-summary__item-thumb')
            ->assertSee('data-checkout-bar', false)
            ->assertSee('data-checkout-anchor', false)
            // The bar submits the same form it sits outside of.
            ->assertSee('form="checkoutForm"', false);
    }

    public function test_empty_bag_skips_the_progress_track_and_summary(): void
    {
        $this->actingAs(User::factory()->create())
            ->get('/billing')
            ->assertOk()
            ->assertSee('Nothing to check out yet')
            ->assertDontSee('checkout-steps')
            ->assertDontSee('data-checkout-bar', false)
            ->assertDontSee('Order Summary');
    }
}
