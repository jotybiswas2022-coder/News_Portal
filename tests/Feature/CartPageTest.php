<?php

namespace Tests\Feature;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartPageTest extends TestCase
{
    use RefreshDatabase;

    private function product(array $attributes = []): Product
    {
        $category = Category::create(['name' => 'Dresses']);

        return Product::create(array_merge([
            'name'        => 'Summer Dress',
            'category_id' => $category->id,
            'base_price'  => 100,
            'price'       => 120,
            'discount'    => 0,
            'stock'       => 7,
            'details'     => 'A lightweight summer dress.',
            'image'       => 'product/summer-dress.jpg',
        ], $attributes));
    }

    private function user(): User
    {
        return User::factory()->create();
    }

    public function test_bag_shows_the_checkout_progress_and_summary(): void
    {
        $user = $this->user();
        Cart::create(['user_id' => $user->id, 'product_id' => $this->product()->id, 'quantity' => 2]);

        $this->actingAs($user)
            ->get('/cart')
            ->assertOk()
            ->assertSee('page-band')
            ->assertSee('checkout-steps')
            ->assertSee('aria-current="step"', false)
            ->assertSee('Order Summary')
            ->assertSee('Inside Khulna')
            ->assertSee('Outside Khulna');
    }

    public function test_bag_renders_the_mobile_checkout_bar(): void
    {
        $user = $this->user();
        Cart::create(['user_id' => $user->id, 'product_id' => $this->product()->id, 'quantity' => 1]);

        $this->actingAs($user)
            ->get('/cart')
            ->assertOk()
            ->assertSee('data-checkout-bar', false)
            ->assertSee('data-checkout-anchor', false)
            // The bar's total is recalculated by the region selector.
            ->assertSee('cart-bar-total', false);
    }

    public function test_bag_exposes_the_delivery_charges_for_the_region_selector(): void
    {
        $user = $this->user();
        Cart::create(['user_id' => $user->id, 'product_id' => $this->product()->id, 'quantity' => 1]);

        $this->actingAs($user)
            ->get('/cart')
            ->assertOk()
            ->assertSee('data-inside=', false)
            ->assertSee('data-outside=', false)
            ->assertSee('cart-grand-total', false);
    }

    public function test_empty_bag_shows_the_empty_state_without_the_checkout_bar(): void
    {
        $this->actingAs($this->user())
            ->get('/cart')
            ->assertOk()
            ->assertSee('cart-empty__icon')
            ->assertSee('Your bag is empty')
            ->assertDontSee('data-checkout-bar', false)
            ->assertDontSee('Order Summary');
    }
}
