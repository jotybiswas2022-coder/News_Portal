<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductPageTest extends TestCase
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
            'stock'       => 5,
            'details'     => 'A lightweight summer dress.',
            // products.image is NOT NULL in the schema, so tests pass a path
            // rather than null (the file itself is never read).
            'image'       => 'product/summer-dress.jpg',
        ], $attributes));
    }

    public function test_page_renders_a_single_heading(): void
    {
        $product = $this->product();

        $html = $this->get('/product/' . $product->id)->assertOk()->getContent();

        // The old layout repeated the product name as both a page head and the
        // detail title, leaving two <h1> elements on one page.
        $this->assertSame(1, substr_count($html, '<h1'));
    }

    public function test_breadcrumb_links_back_to_the_category(): void
    {
        $product = $this->product();

        $this->get('/product/' . $product->id)
            ->assertOk()
            ->assertSee('catalogue-bar')
            ->assertSee(url('/search?category=' . $product->category_id), false);
    }

    public function test_discounted_product_shows_the_savings_pill(): void
    {
        $product = $this->product(['discount' => 20]);

        $this->get('/product/' . $product->id)
            ->assertOk()
            ->assertSee('Save 20%')
            ->assertSee('product-detail__save');
    }

    public function test_in_stock_product_offers_the_sticky_buy_bar(): void
    {
        $product = $this->product(['stock' => 4]);

        $this->get('/product/' . $product->id)
            ->assertOk()
            ->assertSee('data-buy-bar', false)
            ->assertSee('data-buy-anchor', false);
    }

    public function test_sold_out_product_hides_the_buy_bar(): void
    {
        $product = $this->product(['stock' => 0, 'discount' => 0]);

        $this->get('/product/' . $product->id)
            ->assertOk()
            ->assertDontSee('data-buy-bar', false)
            ->assertSee('Sold Out')
            ->assertSee('Currently sold out');
    }
}
