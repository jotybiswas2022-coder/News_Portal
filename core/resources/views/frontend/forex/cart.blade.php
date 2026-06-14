@extends('frontend.forex.layouts.app')

@section('title', 'Shopping Cart — SMART BINARY ZONE')

@section('content')
<!-- ==================== CART HERO ==================== -->
<section style="min-height:100vh;padding-top:7rem;padding-bottom:3rem;position:relative;overflow:hidden">
    <div class="hero-orb hero-orb-1"></div>
    <div class="hero-orb hero-orb-2"></div>
    <div class="grid-bg" style="position:absolute;inset:0;opacity:0.3;pointer-events:none"></div>
    <div style="position:relative;z-index:10;max-width:56rem;margin:0 auto;padding-left:1rem;padding-right:1rem">
        <style>
            @media (min-width:640px){.cart-px{padding-left:1.5rem;padding-right:1.5rem}}
            @media (min-width:1024px){.cart-px{padding-left:2rem;padding-right:2rem}}
            @media (min-width:640px){.cart-flex{flex-direction:row}}
            .btn-icon{width:2.25rem;height:2.25rem;display:flex;align-items:center;justify-content:center;color:#9ca3af;font-size:1.125rem;font-weight:500;transition:all 0.2s;cursor:pointer;background:transparent;border:none;border-radius:0.375rem}
            .btn-icon:hover{color:#EAEAEA;background:rgba(0,95,231,0.1)}
        </style>
        <div style="display:flex;align-items:center;gap:0.75rem;margin-bottom:2rem;animation:fadeInUp 0.6s ease">
            <div style="width:2.5rem;height:2.5rem;border-radius:0.75rem;background:linear-gradient(135deg,rgba(0,95,231,0.15),rgba(0,95,231,0.05));display:flex;align-items:center;justify-content:center">
                <svg style="width:1.25rem;height:1.25rem;color:#005fe7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
            </div>
            <div>
                <h1 style="font-size:1.875rem;font-weight:700;color:#EAEAEA;font-family:'Bebas Neue','Oswald',sans-serif">Shopping Cart</h1>
                <p id="cartItemCount" style="color:rgba(234,234,234,0.4);font-size:0.875rem">0 items in your cart</p>
            </div>
        </div>

        <!-- Empty State -->
        <div id="cartEmpty" style="text-align:center;padding-top:5rem;padding-bottom:5rem;animation:scaleIn 0.4s ease">
            <div class="glass-card" style="width:6rem;height:6rem;margin:0 auto 1.5rem;border-radius:1rem;display:flex;align-items:center;justify-content:center;padding:0;transition:all 0.3s" onmouseover="this.style.boxShadow='0 0 0 1px rgba(34,85,255,0.15)'" onmouseout="this.style.boxShadow='none'">
                <svg style="width:3rem;height:3rem;color:rgba(234,234,234,0.12);transition:color 0.3s" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
            </div>
            <p style="color:#EAEAEA;font-weight:600;font-size:1.125rem;margin-bottom:0.5rem">Your cart is empty</p>
            <p style="color:rgba(234,234,234,0.4);font-size:0.875rem;margin-bottom:2rem;line-height:1.6;max-width:24rem;margin-left:auto;margin-right:auto">Looks like you haven't added any Expert Advisors yet. Browse our collection and find the perfect EA for your trading style.</p>
            <a href="{{ route('forex.home') }}" class="btn-primary group" style="display:inline-flex;align-items:center;gap:0.5rem">
                Browse Expert Advisors
                <svg style="width:1rem;height:1rem;transition:transform 0.3s" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>

        <!-- Cart Content -->
        <div id="cartContent" style="display:none">
            <div id="cartItems" style="display:flex;flex-direction:column;gap:1rem;margin-bottom:2rem"></div>

            <!-- Cart Summary -->
            <div class="glass-card" style="padding:1.5rem;transition:all 0.4s cubic-bezier(0.4,0,0.2,1)" onmouseover="this.style.boxShadow='0 20px 60px -12px rgba(0,0,0,0.5), 0 0 0 1px rgba(34,85,255,0.12)'" onmouseout="this.style.boxShadow='none'">
                <style>@media (min-width:640px){.cart-summary-p{padding:2rem}}</style>
                <h3 style="color:#EAEAEA;font-weight:600;margin-bottom:1rem;font-size:1.125rem">Order Summary</h3>

                <!-- Contact Info Form -->
                <div style="margin-bottom:1.25rem;padding-bottom:1.25rem;border-bottom:1px solid rgba(255,255,255,0.06)">
                    <p style="color:rgba(234,234,234,0.4);font-size:0.75rem;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:0.75rem;font-weight:500">Contact Information</p>
                    <div style="display:grid;gap:0.75rem" class="checkout-contact-grid">
                        <style>@media (min-width:640px){.checkout-contact-grid{grid-template-columns:1fr 1fr}}</style>
                        <div>
                            <label for="checkoutName" style="display:block;color:rgba(234,234,234,0.35);font-size:0.7rem;font-weight:500;margin-bottom:0.25rem;text-transform:uppercase;letter-spacing:0.05em">Full Name <span style="color:#005fe7">*</span></label>
                            <input type="text" id="checkoutName" value="{{ Auth::check() ? e(Auth::user()->name) : '' }}" placeholder="Your name" autocomplete="name"
                                {{ Auth::check() ? 'readonly' : '' }}
                                style="width:100%;background:rgba(5,5,15,0.8);border:1px solid rgba(255,255,255,0.08);border-radius:0.5rem;padding:0.625rem 0.75rem;font-size:0.8125rem;color:#EAEAEA;transition:all 0.3s;box-sizing:border-box;{{ Auth::check() ? 'opacity:0.6;cursor:not-allowed' : '' }}"
                                onfocus="this.style.borderColor='#005fe7';this.style.boxShadow='0 0 0 3px rgba(34,85,255,0.15)'"
                                onblur="this.style.borderColor='rgba(255,255,255,0.08)';this.style.boxShadow='none'">
                        </div>
                        <div>
                            <label for="checkoutEmail" style="display:block;color:rgba(234,234,234,0.35);font-size:0.7rem;font-weight:500;margin-bottom:0.25rem;text-transform:uppercase;letter-spacing:0.05em">Email Address <span style="color:#005fe7">*</span></label>
                            <input type="email" id="checkoutEmail" value="{{ Auth::check() ? e(Auth::user()->email) : '' }}" placeholder="your@email.com" autocomplete="email"
                                {{ Auth::check() ? 'readonly' : '' }}
                                style="width:100%;background:rgba(5,5,15,0.8);border:1px solid rgba(255,255,255,0.08);border-radius:0.5rem;padding:0.625rem 0.75rem;font-size:0.8125rem;color:#EAEAEA;transition:all 0.3s;box-sizing:border-box;{{ Auth::check() ? 'opacity:0.6;cursor:not-allowed' : '' }}"
                                onfocus="this.style.borderColor='#005fe7';this.style.boxShadow='0 0 0 3px rgba(34,85,255,0.15)'"
                                onblur="this.style.borderColor='rgba(255,255,255,0.08)';this.style.boxShadow='none'">
                        </div>
                    </div>
                    @guest
                    <p style="color:rgba(234,234,234,0.2);font-size:0.7rem;margin-top:0.5rem;display:flex;align-items:center;gap:0.375rem">
                        <svg style="width:0.75rem;height:0.75rem;flex-shrink:0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        We'll send your order confirmation to this email
                    </p>
                    @endguest
                    @auth
                    <p style="color:rgba(0,95,231,0.4);font-size:0.7rem;margin-top:0.5rem;display:flex;align-items:center;gap:0.375rem">
                        <svg style="width:0.75rem;height:0.75rem;flex-shrink:0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Signed in as <strong style="color:rgba(0,95,231,0.6)">{{ Auth::user()->email }}</strong>
                    </p>
                    @endauth
                </div>

                <div style="display:flex;flex-direction:column;gap:0.75rem;margin-bottom:1.5rem">
                    <div style="display:flex;align-items:center;justify-content:space-between;font-size:0.875rem">
                        <span style="color:rgba(234,234,234,0.5)">Subtotal</span>
                        <span id="cartSubtotal" style="color:#EAEAEA;font-weight:600">$0.00</span>
                    </div>
                    <div style="display:flex;align-items:center;justify-content:space-between;font-size:0.875rem">
                        <span style="color:rgba(234,234,234,0.5)">Tax</span>
                        <span style="color:rgba(234,234,234,0.3)">Calculated at checkout</span>
                    </div>
                    <div style="height:1px;background:rgba(255,255,255,0.06)"></div>
                    <div style="display:flex;align-items:center;justify-content:space-between">
                        <span style="color:#EAEAEA;font-weight:500">Total</span>
                        <span id="cartTotal" style="color:#EAEAEA;font-weight:700;font-size:1.25rem">$0.00</span>
                    </div>
                </div>
                <button onclick="proceedToPayment(event)" id="checkoutBtn" style="width:100%;display:inline-flex;align-items:center;justify-content:center;gap:0.5rem;padding:0.875rem 2rem;background:linear-gradient(135deg,#005fe7,#2255ff);color:white;font-weight:600;font-size:1rem;border-radius:0.75rem;transition:all 0.3s;cursor:pointer;border:none" onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 30px rgba(34,85,255,0.25)'" onmouseout="this.style.transform='';this.style.boxShadow=''">
                    <svg style="width:1rem;height:1rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Proceed to Payment Details
                </button>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
function renderCart() {
    const cart = getCart();
    const empty = document.getElementById('cartEmpty');
    const content = document.getElementById('cartContent');
    const items = document.getElementById('cartItems');
    const subtotal = document.getElementById('cartSubtotal');
    const total = document.getElementById('cartTotal');
    const count = document.getElementById('cartItemCount');

    if (cart.length === 0) {
        empty.style.display = '';
        content.style.display = 'none';
        if (count) count.textContent = '0 items in your cart';
        return;
    }
    empty.style.display = 'none';
    content.style.display = '';
    if (count) count.textContent = cart.reduce((s, i) => s + i.qty, 0) + ' items in your cart';

    let sum = 0;
    let html = '';
    cart.forEach((item, index) => {
        sum += item.price * item.qty;
        html += `
        <div class="glass-card" style="padding:1rem;display:flex;align-items:center;gap:1rem;transition:all 0.4s cubic-bezier(0.4,0,0.2,1)" onmouseover="this.style.boxShadow='0 8px 24px -4px rgba(0,0,0,0.3), 0 0 0 1px rgba(34,85,255,0.1)'" onmouseout="this.style.boxShadow='none'">
            <style>@media (min-width:640px){.cart-item-p{padding:1.25rem}}</style>
            <div style="flex:1;min-width:0">
                <h3 style="color:#EAEAEA;font-weight:500;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">${item.name}</h3>
                <p style="color:#005fe7;font-size:0.875rem;font-weight:600">$${item.price.toFixed(2)}</p>
            </div>
            <div style="display:flex;align-items:center;gap:0.75rem">
                <div style="display:flex;align-items:center;background:#05050f;border:1px solid #2a2a2a;border-radius:0.5rem;overflow:hidden">
                    <button onclick="updateQty(${index}, -1)" class="btn-icon">−</button>
                    <span style="color:#EAEAEA;font-family:'JetBrains Mono',monospace;width:2rem;text-align:center;font-size:0.875rem">${item.qty}</span>
                    <button onclick="updateQty(${index}, 1)" class="btn-icon">+</button>
                </div>
            </div>
            <span style="color:#EAEAEA;font-weight:600;width:5rem;text-align:right;font-family:'JetBrains Mono',monospace;font-size:0.875rem">$${(item.price * item.qty).toFixed(2)}</span>
            <button onclick="removeFromCart(${index})" style="width:2rem;height:2rem;border-radius:50%;background:#1a1a1a;border:1px solid #2a2a2a;display:flex;align-items:center;justify-content:center;color:#9ca3af;cursor:pointer;transition:all 0.2s" onmouseover="this.style.color='#ef4444';this.style.borderColor='rgba(239,68,68,0.3)'" onmouseout="this.style.color='#9ca3af';this.style.borderColor='#2a2a2a'">
                <svg style="width:1rem;height:1rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>`;
    });
    items.innerHTML = html;
    subtotal.textContent = '$' + sum.toFixed(2);
    if (total) total.textContent = '$' + sum.toFixed(2);

    // Animate newly added items
    items.querySelectorAll('.reveal').forEach((el, i) => {
        setTimeout(() => el.classList.add('visible'), 50 * i);
    });
}

function updateQty(index, delta) {
    const cart = getCart();
    cart[index].qty = Math.max(1, cart[index].qty + delta);
    saveCart(cart);
    renderCart();
    updateCartBadge();
}

function proceedToPayment(event) {
    const cart = getCart();
    if (cart.length === 0) {
        showToast('Your cart is empty!', 'error');
        return;
    }

    const nameField = document.getElementById('checkoutName');
    const emailField = document.getElementById('checkoutEmail');
    const customerName = (nameField?.value || @json(Auth::user()?->name)) || null;
    const customerEmail = (emailField?.value || @json(Auth::user()?->email)) || null;

    if (!customerEmail) {
        showToast('Please enter your email address to proceed.', 'error');
        if (emailField) { emailField.style.borderColor = '#ef4444'; emailField.focus(); }
        return;
    }
    if (!customerName) {
        showToast('Please enter your name to proceed.', 'error');
        if (nameField) { nameField.style.borderColor = '#ef4444'; nameField.focus(); }
        return;
    }
    if (customerEmail && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(customerEmail)) {
        showToast('Please enter a valid email address.', 'error');
        if (emailField) { emailField.style.borderColor = '#ef4444'; emailField.focus(); }
        return;
    }

    // Store contact info in sessionStorage so the payment-details page can read it
    sessionStorage.setItem('payment_name', customerName);
    sessionStorage.setItem('payment_email', customerEmail);

    const btn = event.currentTarget || event.target;
    btn.disabled = true;
    btn.innerHTML = '<svg class="animate-spin" style="width:1rem;height:1rem" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg> Redirecting...';

    window.location.href = '{{ route('forex.payment-details') }}';
}

document.addEventListener('DOMContentLoaded', function() {
    renderCart();
});
</script>
@endpush
@endsection
