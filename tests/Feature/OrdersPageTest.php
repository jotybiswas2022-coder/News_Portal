<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrdersPageTest extends TestCase
{
    use RefreshDatabase;

    private function user(): User
    {
        return User::factory()->create();
    }

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

    private function order(User $user, array $attributes = []): Order
    {
        return Order::create(array_merge([
            'user_id'                      => $user->id,
            'firstname'                    => 'Esha',
            'lastname'                     => 'Rahman',
            'email'                        => 'esha@example.com',
            'phone'                        => '01700000000',
            'address'                      => 'Sonadanga, Khulna',
            'product_price_after_discount' => 200,
            'delivery_charge'              => 60,
            'tax'                          => 0,
            'total_price'                  => 260,
            'status'                       => 'Pending',
            'payment_method'               => 'cod',
            'payment_status'               => 'unpaid',
        ], $attributes));
    }

    private function item(Order $order, Product $product, int $qty = 1): OrderDetail
    {
        return OrderDetail::create([
            'order_id'         => $order->id,
            'product_id'       => $product->id,
            'product_name'     => $product->name,
            'product_quantity' => (string) $qty,
            'product_price'    => (string) $product->price,
            'status'           => 'Processing',
        ]);
    }

    public function test_guests_are_sent_to_login(): void
    {
        $this->get('/orders')->assertRedirect('/login');
    }

    public function test_it_shows_the_real_order_id_not_the_list_position(): void
    {
        // Someone else's order takes id 1, so our order is id 2 — a page that
        // printed the loop index would show "Order #1" here.
        $this->order($this->user());

        $user  = $this->user();
        $mine  = $this->order($user);
        $this->item($mine, $this->product());

        $this->actingAs($user)
            ->get('/orders')
            ->assertOk()
            ->assertSee('Order #' . $mine->id)
            ->assertSee('Order #2')
            ->assertDontSee('Order #1');
    }

    public function test_it_renders_the_account_header_with_the_order_count(): void
    {
        $user = $this->user();
        $this->item($this->order($user), $this->product());

        $this->actingAs($user)
            ->get('/orders')
            ->assertOk()
            ->assertSee('page-band')
            ->assertSee('My Orders')
            ->assertSee('1 order')
            ->assertSee('breadcrumbs__current');
    }

    public function test_it_lists_the_ordered_products_with_a_cost_breakdown(): void
    {
        $user    = $this->user();
        $product = $this->product();
        $order   = $this->order($user);
        $this->item($order, $product, 3);

        $this->actingAs($user)
            ->get('/orders')
            ->assertOk()
            ->assertSee('Summer Dress')
            ->assertSee('× 3')
            // 120 * 3
            ->assertSee('360.00')
            ->assertSee('os-breakdown')
            ->assertSee('Order breakdown')
            ->assertSee('Order Total')
            // 260.00 total and the 60.00 delivery it is made of
            ->assertSee('260.00')
            ->assertSee('60.00');
    }

    public function test_status_filters_only_cover_the_statuses_in_play(): void
    {
        $user = $this->user();
        $this->order($user);
        $this->order($user, ['status' => 'Delivered']);

        $this->actingAs($user)
            ->get('/orders')
            ->assertOk()
            ->assertSee('data-status-filter="all"', false)
            ->assertSee('data-status-filter="pending"', false)
            ->assertSee('data-status-filter="delivered"', false)
            ->assertDontSee('data-status-filter="approved"', false)
            ->assertSee('data-status="pending"', false)
            ->assertSee('data-status="delivered"', false)
            // The counter badge for the single pending order
            ->assertSee('chip__count');
    }

    public function test_an_unpaid_order_offers_the_payment_link(): void
    {
        $user  = $this->user();
        $order = $this->order($user, ['payment_status' => 'unpaid', 'payment_method' => 'cod']);
        $this->item($order, $this->product());

        $this->actingAs($user)
            ->get('/orders')
            ->assertOk()
            ->assertSee('Pay Now')
            ->assertSee('/user/order/payment/' . $order->id)
            ->assertSee('os-pay__method--unpaid')
            ->assertSee('Pay delivery charge in advance to confirm');
    }

    public function test_a_paid_order_hides_the_payment_link_and_shows_its_proof(): void
    {
        $user  = $this->user();
        $order = $this->order($user, [
            'payment_status' => 'paid',
            'payment_method' => 'bkash',
            'sender_number'  => '01812345678',
            'transaction_id' => 'TXN99881',
        ]);
        $this->item($order, $this->product());

        $this->actingAs($user)
            ->get('/orders')
            ->assertOk()
            ->assertSee('os-pay__method--paid')
            ->assertSee('Payment received')
            ->assertSee('bKash')
            ->assertSee('Sent from 01812345678')
            ->assertSee('Transaction ID: TXN99881')
            ->assertDontSee('Pay Now');
    }

    public function test_another_shopper_never_sees_your_orders(): void
    {
        $mine    = $this->user();
        $stranger = $this->user();

        $order = $this->order($mine);
        $this->item($order, $this->product());

        $this->actingAs($stranger)
            ->get('/orders')
            ->assertOk()
            ->assertSee('No orders yet')
            ->assertDontSee('Order #' . $order->id);
    }

    public function test_an_empty_history_shows_the_empty_state(): void
    {
        $this->actingAs($this->user())
            ->get('/orders')
            ->assertOk()
            ->assertSee('cart-empty__icon')
            ->assertSee('No orders yet')
            ->assertSee('Start Shopping')
            // Nothing to search or filter yet (the guard script still ships)
            ->assertDontSee('os-toolbar')
            ->assertDontSee('class="os-list"');
    }
}
