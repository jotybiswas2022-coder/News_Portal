@extends('frontend.forex.layouts.app')

@section('title', 'Payment Details — SMART BINARY ZONE')

@section('content')
<style>
.payment-page{min-height:100vh;padding-top:7rem;padding-bottom:4rem;position:relative;overflow:hidden}
.payment-inner{max-width:56rem;margin:0 auto;padding:0 1rem;position:relative;z-index:10}
@media (min-width:640px){.payment-inner{padding:0 1.5rem}}
@media (min-width:1024px){.payment-inner{padding:0 2rem}}
.payment-back{display:inline-flex;align-items:center;gap:0.5rem;color:rgba(234,234,234,0.4);text-decoration:none;font-size:0.875rem;margin-bottom:1.5rem;transition:all 0.2s}
.payment-back:hover{color:#00c8ff}
.pay-option{display:flex;align-items:center;gap:0.75rem;padding:0.875rem 1.125rem;border-radius:0.75rem;border:1px solid rgba(255,255,255,0.06);background:rgba(5,5,15,0.35);cursor:pointer;transition:all 0.3s;position:relative}
.pay-option:hover{border-color:rgba(0,200,255,0.2);background:rgba(0,200,255,0.04)}
.pay-option.active{border-color:#00c8ff;background:rgba(0,200,255,0.06);box-shadow:0 0 0 1px rgba(0,200,255,0.2)}
.pay-option-radio{width:1.125rem;height:1.125rem;border-radius:50%;border:2px solid rgba(255,255,255,0.15);display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:all 0.3s}
.pay-option.active .pay-option-radio{border-color:#00c8ff}
.pay-option-radio-inner{width:0.625rem;height:0.625rem;border-radius:50%;background:#00c8ff;opacity:0;transform:scale(0);transition:all 0.3s}
.pay-option.active .pay-option-radio-inner{opacity:1;transform:scale(1)}
.pay-option-icon{width:2rem;height:2rem;border-radius:0.5rem;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:0.75rem;font-weight:700}
.pay-option-left{flex:1;min-width:0}
.pay-option-name{color:#EAEAEA;font-weight:500;font-size:0.9375rem}
.pay-option-desc{color:rgba(234,234,234,0.4);font-size:0.75rem;margin-top:0.125rem}
.pay-option-check{color:#00c8ff;flex-shrink:0;opacity:0;transition:all 0.3s}
.pay-option.active .pay-option-check{opacity:1}
.pay-address-card{background:rgba(5,5,15,0.8);border:1px solid rgba(0,200,255,0.12);border-radius:0.75rem;padding:1rem;margin-top:1rem;display:none;animation:fadeInUp 0.3s ease}
.pay-address-card.show{display:block}
.pay-address-label{color:rgba(234,234,234,0.35);font-size:0.65rem;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:0.375rem}
.pay-address-value{color:#00c8ff;font-family:'JetBrains Mono',monospace;font-size:0.8125rem;word-break:break-all;line-height:1.5;background:rgba(0,200,255,0.03);padding:0.75rem;border-radius:0.5rem;border:1px solid rgba(0,200,255,0.06);margin-bottom:0.75rem}
.pay-copy-btn{display:inline-flex;align-items:center;gap:0.375rem;padding:0.5rem 1rem;font-size:0.75rem;font-weight:600;border-radius:0.5rem;background:rgba(0,200,255,0.08);border:1px solid rgba(0,200,255,0.15);color:#00c8ff;cursor:pointer;transition:all 0.3s}
.pay-copy-btn:hover{background:rgba(0,200,255,0.15);box-shadow:0 0 12px rgba(0,200,255,0.1)}

.pay-submit-area{border-top:1px solid rgba(255,255,255,0.06);padding-top:1.25rem;margin-top:0.5rem}
.file-upload-zone{position:relative;border:2px dashed rgba(255,255,255,0.08);border-radius:0.75rem;padding:2rem;text-align:center;cursor:pointer;transition:all 0.3s;background:rgba(5,5,15,0.5)}
.file-upload-zone:hover{border-color:rgba(0,200,255,0.25);background:rgba(0,200,255,0.03)}
.file-upload-zone.has-file{border-color:rgba(0,200,255,0.2);background:rgba(0,200,255,0.03)}
.file-upload-zone input{position:absolute;inset:0;opacity:0;cursor:pointer}
.file-upload-preview{display:none;margin-top:0.75rem}
.file-upload-preview.show{display:block}
.file-upload-preview img{width:100%;max-height:10rem;object-fit:contain;border-radius:0.5rem;border:1px solid rgba(255,255,255,0.06)}
</style>

<section class="payment-page">
    <div class="hero-orb hero-orb-1"></div>
    <div class="hero-orb hero-orb-2"></div>
    <div class="grid-bg" style="position:absolute;inset:0;opacity:0.3;pointer-events:none"></div>

    <div class="payment-inner">
        <!-- Back Link -->
        <a href="{{ route('forex.cart') }}" class="payment-back reveal">
            <svg style="width:1rem;height:1rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Back to Cart
        </a>

        <!-- Header -->
        <div style="display:flex;align-items:center;gap:0.75rem;margin-bottom:2rem;animation:fadeInUp 0.6s ease">
            <div style="width:2.5rem;height:2.5rem;border-radius:0.75rem;background:linear-gradient(135deg,rgba(0,200,255,0.15),rgba(0,200,255,0.05));display:flex;align-items:center;justify-content:center">
                <svg style="width:1.25rem;height:1.25rem;color:#00c8ff" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            </div>
            <div>
                <h1 style="font-size:1.875rem;font-weight:700;color:#EAEAEA;font-family:'Bebas Neue','Oswald',sans-serif">Payment Details</h1>
                <p style="color:rgba(234,234,234,0.4);font-size:0.875rem">Select a payment method, send payment, and submit your proof</p>
            </div>
        </div>

        <div style="display:grid;grid-template-columns:1fr;gap:1.5rem">
            <style>@media (min-width:768px){.pay-layout{grid-template-columns:1fr 22rem}}</style>

            <!-- Main Column -->
            <div class="pay-layout" style="display:grid;grid-template-columns:1fr;gap:1.5rem;align-items:start">

                <!-- LEFT: Payment Method Selection & Submit -->
                <div style="display:flex;flex-direction:column;gap:1.5rem">

                    <!-- ===== STEP 1: Select Payment Method ===== -->
                    <div class="glass-card reveal" style="padding:1.5rem;transition:all 0.4s cubic-bezier(0.4,0,0.2,1)" onmouseover="this.style.boxShadow='0 20px 60px -12px rgba(0,0,0,0.5), 0 0 0 1px rgba(0,200,255,0.12)'" onmouseout="this.style.boxShadow='none'">
                        <div style="display:flex;align-items:center;gap:0.625rem;margin-bottom:1.25rem">
                            <div style="width:1.75rem;height:1.75rem;border-radius:50%;background:linear-gradient(135deg,#00c8ff,#0099ff);display:flex;align-items:center;justify-content:center;font-size:0.75rem;font-weight:700;color:#05050f;flex-shrink:0">1</div>
                            <h3 style="color:#EAEAEA;font-weight:600;font-size:1.125rem">Select Payment Method</h3>
                        </div>

                        <div id="paymentMethods" style="display:flex;flex-direction:column;gap:0.625rem">
                            @php
                            $cryptoMethods = [
                                ['id' => 'binance_pay', 'name' => 'Binance Pay ID', 'logo' => 'https://cdn.jsdelivr.net/npm/cryptocurrency-icons/svg/color/bnb.svg'],
                                ['id' => 'usdt_trc20', 'name' => 'Tether USDT (TRC20)', 'logo' => 'https://cdn.jsdelivr.net/npm/cryptocurrency-icons/svg/color/usdt.svg'],
                                ['id' => 'usdc_bep20', 'name' => 'USDC (BEP20)', 'logo' => 'https://cdn.jsdelivr.net/npm/cryptocurrency-icons/svg/color/usdc.svg'],
                                ['id' => 'bitcoin', 'name' => 'Bitcoin (BTC)', 'logo' => 'https://cdn.jsdelivr.net/npm/cryptocurrency-icons/svg/color/btc.svg'],
                                ['id' => 'ethereum', 'name' => 'Ethereum (ERC20)', 'logo' => 'https://cdn.jsdelivr.net/npm/cryptocurrency-icons/svg/color/eth.svg'],
                                ['id' => 'toncoin', 'name' => 'TonCoin (TON)', 'logo' => 'https://cdn.simpleicons.org/ton'],
                                ['id' => 'usdt_bep20', 'name' => 'Tether USDT (BEP20)', 'logo' => 'https://cdn.jsdelivr.net/npm/cryptocurrency-icons/svg/color/usdt.svg'],
                            ];
                            @endphp
                            @foreach($cryptoMethods as $i => $method)
                            <div class="pay-option {{ $i === 0 ? 'active' : '' }}" data-method="{{ $method['id'] }}" onclick="selectPaymentMethod(this)">
                                <div class="pay-option-radio">
                                    <div class="pay-option-radio-inner"></div>
                                </div>
                                <div class="pay-option-icon" style="background:rgba(255,255,255,0.04);padding:0.25rem;overflow:hidden">
                                    <img src="{{ $method['logo'] }}" alt="{{ $method['name'] }}" style="width:100%;height:100%;object-fit:contain" loading="lazy">
                                </div>
                                <div class="pay-option-left">
                                    <div class="pay-option-name">{{ $method['name'] }}</div>
                                </div>
                                <svg class="pay-option-check" style="width:1.25rem;height:1.25rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            @endforeach
                        </div>
                        <input type="hidden" id="selectedPaymentMethod" value="binance_pay">

                        <!-- Payment Address Display -->
                        <div id="addressCard" class="pay-address-card show">
                            <div class="pay-address-label">Send Payment To This Address</div>
                            <div id="addressValue" class="pay-address-value">813258681</div>
                            <div style="display:flex;gap:0.5rem;flex-wrap:wrap">
                                <button onclick="copyAddress()" id="copyAddressBtn" class="pay-copy-btn">
                                    <svg style="width:0.875rem;height:0.875rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                    Copy Address
                                </button>
                                <span style="display:inline-flex;align-items:center;gap:0.375rem;padding:0.5rem 1rem;font-size:0.75rem;color:rgba(234,234,234,0.3);background:rgba(255,255,255,0.03);border-radius:0.5rem">
                                    <svg style="width:0.875rem;height:0.875rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m0 0v2m0-2h2m-2 0H10m9.364-7.364A9 9 0 1112 3a9 9 0 016.364 2.636z"/></svg>
                                    Send exact amount shown in order summary
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- ===== STEP 2: Submit Payment Details ===== -->
                    <div class="glass-card reveal" style="padding:1.5rem;transition:all 0.4s cubic-bezier(0.4,0,0.2,1);transition-delay:0.1s" onmouseover="this.style.boxShadow='0 20px 60px -12px rgba(0,0,0,0.5), 0 0 0 1px rgba(0,200,255,0.12)'" onmouseout="this.style.boxShadow='none'">
                        <div style="display:flex;align-items:center;gap:0.625rem;margin-bottom:1.25rem">
                            <div style="width:1.75rem;height:1.75rem;border-radius:50%;background:linear-gradient(135deg,#00c8ff,#0099ff);display:flex;align-items:center;justify-content:center;font-size:0.75rem;font-weight:700;color:#05050f;flex-shrink:0">2</div>
                            <h3 style="color:#EAEAEA;font-weight:600;font-size:1.125rem">Submit Payment Details</h3>
                        </div>

                        <form id="paymentForm" onsubmit="return false;">
                            <!-- Transaction ID -->
                            <div style="margin-bottom:1rem">
                                <label for="transactionId" style="display:block;color:rgba(234,234,234,0.35);font-size:0.7rem;font-weight:500;margin-bottom:0.375rem;text-transform:uppercase;letter-spacing:0.05em">
                                    Transaction ID / Hash <span style="color:#00c8ff">*</span>
                                </label>
                                <input type="text" id="transactionId" required placeholder="Paste your transaction ID or hash here" autocomplete="off"
                                    style="width:100%;background:rgba(5,5,15,0.8);border:1px solid rgba(255,255,255,0.08);border-radius:0.5rem;padding:0.75rem;font-size:0.8125rem;color:#EAEAEA;transition:all 0.3s;box-sizing:border-box;font-family:'JetBrains Mono',monospace"
                                    onfocus="this.style.borderColor='#00c8ff';this.style.boxShadow='0 0 0 3px rgba(0,200,255,0.15)'"
                                    onblur="this.style.borderColor='rgba(255,255,255,0.08)';this.style.boxShadow='none'">
                                <p style="color:rgba(234,234,234,0.2);font-size:0.7rem;margin-top:0.375rem;display:flex;align-items:center;gap:0.375rem">
                                    <svg style="width:0.75rem;height:0.75rem;flex-shrink:0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    Enter the transaction ID or hash from your payment
                                </p>
                            </div>

                            <!-- Payment Screenshot Upload -->
                            <div style="margin-bottom:1rem">
                                <label style="display:block;color:rgba(234,234,234,0.35);font-size:0.7rem;font-weight:500;margin-bottom:0.375rem;text-transform:uppercase;letter-spacing:0.05em">
                                    Payment Screenshot <span style="color:#00c8ff">*</span>
                                </label>
                                <div id="uploadZone" class="file-upload-zone">
                                    <input type="file" id="screenshotInput" accept="image/jpeg,image/png,image/webp" onchange="handleFileSelect(event)" onclick="event.stopPropagation()" required>
                                    <div id="uploadPlaceholder">
                                        <svg style="width:2rem;height:2rem;color:rgba(0,200,255,0.3);margin:0 auto 0.75rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        <p style="color:rgba(234,234,234,0.3);font-size:0.8125rem;margin:0">Click to upload payment screenshot</p>
                                        <p style="color:rgba(234,234,234,0.15);font-size:0.7rem;margin-top:0.375rem">JPEG, PNG or WebP — Max 5MB</p>
                                    </div>
                                    <div id="uploadPreview" class="file-upload-preview">
                                        <img id="previewImage" src="" alt="Payment screenshot preview">
                                        <p id="uploadFileName" style="color:rgba(234,234,234,0.4);font-size:0.75rem;margin-top:0.5rem"></p>
                                    </div>
                                </div>
                                <p id="uploadError" style="color:#ef4444;font-size:0.75rem;margin-top:0.375rem;display:none"></p>
                            </div>

                            <!-- Hidden fields for order data -->
                            <input type="hidden" id="orderNumberInput" value="">
                        </form>
                    </div>

                    <!-- Contact Info Summary -->
                    <div class="glass-card reveal" style="padding:1rem 1.25rem;transition:all 0.4s cubic-bezier(0.4,0,0.2,1);transition-delay:0.15s;display:flex;gap:1rem;flex-wrap:wrap;align-items:center" onmouseover="this.style.boxShadow='0 12px 40px -8px rgba(0,0,0,0.3)'" onmouseout="this.style.boxShadow='none'">
                        <div style="display:flex;align-items:center;gap:0.625rem">
                            <div style="width:1.75rem;height:1.75rem;border-radius:50%;background:linear-gradient(135deg,#00c8ff,#00c8ff);display:flex;align-items:center;justify-content:center;font-size:0.625rem;font-weight:700;color:#05050f;flex-shrink:0" id="contactInitial"></div>
                            <div>
                                <span style="color:rgba(234,234,234,0.3);font-size:0.65rem;text-transform:uppercase;letter-spacing:0.05em;display:block">Contact</span>
                                <span id="contactDisplayName" style="color:#EAEAEA;font-size:0.8125rem;font-weight:500"></span>
                            </div>
                        </div>
                        <div style="flex:1;min-width:0">
                            <span style="color:rgba(234,234,234,0.3);font-size:0.65rem;text-transform:uppercase;letter-spacing:0.05em;display:block">Email</span>
                            <span id="contactDisplayEmail" style="color:#EAEAEA;font-size:0.8125rem;word-break:break-all"></span>
                        </div>
                    </div>
                </div>

                <!-- RIGHT: Order Summary -->
                <div class="glass-card reveal" style="padding:1.5rem;transition:all 0.4s cubic-bezier(0.4,0,0.2,1);transition-delay:0.15s;position:sticky;top:6rem" onmouseover="this.style.boxShadow='0 20px 60px -12px rgba(0,0,0,0.5), 0 0 0 1px rgba(0,200,255,0.12)'" onmouseout="this.style.boxShadow='none'">
                    <h3 style="color:#EAEAEA;font-weight:600;margin-bottom:1rem;font-size:1.125rem;display:flex;align-items:center;gap:0.5rem">
                        <svg style="width:1.125rem;height:1.125rem;color:#00c8ff" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                        Order Summary
                    </h3>

                    <div id="paymentItems" style="display:flex;flex-direction:column;gap:0.625rem;margin-bottom:1.25rem;max-height:16rem;overflow-y:auto;padding-right:0.25rem"></div>

                    <div style="display:flex;flex-direction:column;gap:0.625rem;margin-bottom:1.5rem;padding-top:1rem;border-top:1px solid rgba(255,255,255,0.06)">
                        <div style="display:flex;align-items:center;justify-content:space-between;font-size:0.875rem">
                            <span style="color:rgba(234,234,234,0.5)">Subtotal</span>
                            <span id="paymentSubtotal" style="color:#EAEAEA;font-weight:600">$0.00</span>
                        </div>
                        <div style="display:flex;align-items:center;justify-content:space-between;font-size:0.75rem">
                            <span style="color:rgba(0,200,255,0.5);display:flex;align-items:center;gap:0.375rem">
                                <svg style="width:0.875rem;height:0.875rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                One-Time Payment
                            </span>
                            <span style="color:#00c8ff;font-size:0.75rem">Lifetime Access</span>
                        </div>
                        <div style="height:1px;background:rgba(255,255,255,0.06)"></div>
                        <div style="display:flex;align-items:center;justify-content:space-between">
                            <span style="color:#EAEAEA;font-weight:500;font-size:1rem">Total</span>
                            <span id="paymentTotal" style="color:#EAEAEA;font-weight:700;font-size:1.375rem">$0.00</span>
                        </div>
                    </div>

                    <button onclick="confirmOrder()" id="confirmOrderBtn" style="width:100%;display:inline-flex;align-items:center;justify-content:center;gap:0.5rem;padding:0.875rem 2rem;background:linear-gradient(135deg,#00c8ff,#0099ff);color:white;font-weight:600;font-size:1rem;border-radius:0.75rem;transition:all 0.3s;cursor:pointer;border:none" onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 30px rgba(0,200,255,0.25)'" onmouseout="this.style.transform='';this.style.boxShadow=''">
                        <svg style="width:1rem;height:1rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Confirm Order
                    </button>

                    <p style="color:rgba(234,234,234,0.2);font-size:0.7rem;text-align:center;margin-top:0.75rem;display:flex;align-items:center;justify-content:center;gap:0.375rem">
                        <svg style="width:0.75rem;height:0.75rem;flex-shrink:0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m0 0v2m0-2h2m-2 0H10m9.364-7.364A9 9 0 1112 3a9 9 0 016.364 2.636z"/></svg>
                        Your order will be reviewed after payment verification
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
// ===== PAYMENT ADDRESSES =====
const paymentAddresses = {
    binance_pay:  '813258681',
    usdt_trc20:   'TLssmM1yr4rA5E7RwZLicx1aUttUSzq6Ak',
    usdc_bep20:   '0xb554106a28b5dfcb18f96078706e54dcff7623ea',
    bitcoin:      '1HyYGn8LFUvJ5qoerAfYnFVcwAWPCf1Ui9',
    ethereum:     '0xb554106a28b5dfcb18f96078706e54dcff7623ea',
    toncoin:      'UQBsj6oetK9EbhNrzNKFjjn1U23zxsqhh6v9258ENsJf51kX',
    usdt_bep20:   '0xb554106a28b5dfcb18f96078706e54dcff7623ea',
};

const methodNames = {
    binance_pay: 'Binance Pay ID',
    usdt_trc20:  'Tether USDT (TRC20)',
    usdc_bep20:  'USDC (BEP20)',
    bitcoin:     'Bitcoin (BTC)',
    ethereum:    'Ethereum (ERC20)',
    toncoin:     'TonCoin (TON)',
    usdt_bep20:  'Tether USDT (BEP20)',
};

let uploadedFile = null;
let orderCreated = false;
let currentOrderNumber = null;

// ===== SELECT PAYMENT METHOD =====
function selectPaymentMethod(el) {
    document.querySelectorAll('.pay-option').forEach(function(opt) {
        opt.classList.remove('active');
    });
    el.classList.add('active');
    var method = el.getAttribute('data-method');
    document.getElementById('selectedPaymentMethod').value = method;

    // Update address
    var address = paymentAddresses[method] || '';
    document.getElementById('addressValue').textContent = address;
    document.getElementById('addressCard').classList.add('show');

    // Reset copy button
    var copyBtn = document.getElementById('copyAddressBtn');
    copyBtn.innerHTML = '<svg style="width:0.875rem;height:0.875rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg> Copy Address';
}

// ===== COPY ADDRESS =====
function copyAddress() {
    var address = document.getElementById('addressValue').textContent;
    if (!address) return;

    if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(address).then(function() {
            showCopySuccess();
        }).catch(function() {
            fallbackCopy(address);
        });
    } else {
        fallbackCopy(address);
    }
}

function fallbackCopy(text) {
    var textarea = document.createElement('textarea');
    textarea.value = text;
    textarea.style.position = 'fixed';
    textarea.style.opacity = '0';
    document.body.appendChild(textarea);
    textarea.select();
    try {
        document.execCommand('copy');
        showCopySuccess();
    } catch(e) {
        showToast('Failed to copy. Please select and copy manually.', 'error');
    }
    document.body.removeChild(textarea);
}

function showCopySuccess() {
    // Silently copy — no toast, no animation
}

// ===== FILE UPLOAD HANDLING =====
function handleFileSelect(event) {
    var file = event.target.files[0];
    if (!file) return;

    // Validate file type
    var validTypes = ['image/jpeg', 'image/png', 'image/webp'];
    if (!validTypes.includes(file.type)) {
        document.getElementById('uploadError').textContent = 'Please upload a valid image (JPEG, PNG, or WebP).';
        document.getElementById('uploadError').style.display = '';
        return;
    }
    // Validate size (5MB)
    if (file.size > 5 * 1024 * 1024) {
        document.getElementById('uploadError').textContent = 'File size must be less than 5MB.';
        document.getElementById('uploadError').style.display = '';
        return;
    }

    document.getElementById('uploadError').style.display = 'none';
    uploadedFile = file;

    // Show preview
    var reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById('previewImage').src = e.target.result;
        document.getElementById('uploadPlaceholder').style.display = 'none';
        document.getElementById('uploadPreview').classList.add('show');
        document.getElementById('uploadFileName').textContent = file.name + ' (' + (file.size / 1024).toFixed(1) + ' KB)';
        document.getElementById('uploadZone').classList.add('has-file');
    };
    reader.readAsDataURL(file);
}

// ===== RENDER ORDER SUMMARY =====
function renderPaymentSummary() {
    var cart = getCart();
    if (cart.length === 0) {
        window.location.href = '{{ route('forex.cart') }}';
        return;
    }

    // Contact info
    var name = sessionStorage.getItem('payment_name') || @json(Auth::user()?->name) || '';
    var email = sessionStorage.getItem('payment_email') || @json(Auth::user()?->email) || '';
    if (!name || !email) {
        showToast('Please provide your contact information first.', 'error');
        setTimeout(function() {
            window.location.href = '{{ route('forex.cart') }}';
        }, 1500);
        return;
    }
    document.getElementById('contactDisplayName').textContent = name;
    document.getElementById('contactDisplayEmail').textContent = email;
    document.getElementById('contactInitial').textContent = name.charAt(0).toUpperCase();

    // Items
    var sum = 0;
    var html = '';
    cart.forEach(function(item) {
        sum += item.price * item.qty;
        html += '<div style="display:flex;align-items:center;gap:0.75rem;padding:0.625rem 0.75rem;background:rgba(5,5,15,0.4);border:1px solid rgba(255,255,255,0.04);border-radius:0.5rem">' +
            '<div style="flex:1;min-width:0">' +
                '<div style="color:#EAEAEA;font-size:0.8125rem;font-weight:500;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">' + item.name + '</div>' +
                '<div style="color:rgba(234,234,234,0.3);font-size:0.7rem;margin-top:0.125rem">Qty: ' + item.qty + '</div>' +
            '</div>' +
            '<span style="color:#EAEAEA;font-weight:600;font-family:\'JetBrains Mono\',monospace;font-size:0.8125rem;flex-shrink:0">$' + (item.price * item.qty).toFixed(2) + '</span>' +
        '</div>';
    });
    document.getElementById('paymentItems').innerHTML = html;
    document.getElementById('paymentSubtotal').textContent = '$' + sum.toFixed(2);
    document.getElementById('paymentTotal').textContent = '$' + sum.toFixed(2);
}

// ===== CONFIRM ORDER =====
function confirmOrder() {
    var cart = getCart();
    if (cart.length === 0) {
        showToast('Your cart is empty!', 'error');
        return;
    }

    var name = sessionStorage.getItem('payment_name') || @json(Auth::user()?->name) || '';
    var email = sessionStorage.getItem('payment_email') || @json(Auth::user()?->email) || '';
    var paymentMethod = document.getElementById('selectedPaymentMethod').value;
    var transactionId = document.getElementById('transactionId').value.trim();

    if (!name || !email) {
        showToast('Contact information is missing.', 'error');
        return;
    }

    var total = cart.reduce(function(s, i) { return s + (i.price * i.qty); }, 0);
    var btn = document.getElementById('confirmOrderBtn');
    btn.disabled = true;
    btn.innerHTML = '<svg class="animate-spin" style="width:1rem;height:1rem" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg> Processing...';

    // Step 1: Place the order (create it in backend)
    var placePromise;
    if (!orderCreated) {
        placePromise = fetch('{{ route('order.place') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                items: JSON.stringify(cart),
                total: total,
                name: name,
                email: email,
                payment_method: paymentMethod,
                notes: 'Payment: ' + (methodNames[paymentMethod] || paymentMethod)
            })
        })
        .then(function(res) {
            if (!res.ok) throw new Error('Failed to create order');
            return res.json();
        })
        .then(function(data) {
            if (data && data.order_number) {
                orderCreated = true;
                currentOrderNumber = data.order_number;
                return data.order_number;
            }
            throw new Error('No order number returned');
        });
    } else {
        placePromise = Promise.resolve(currentOrderNumber);
    }

    placePromise
    .then(function(orderNumber) {
        // Step 2: Submit payment proof (with file upload)
        var formData = new FormData();
        formData.append('order_number', orderNumber);
        formData.append('transaction_id', transactionId);
        formData.append('payment_screenshot', uploadedFile);

        return fetch('{{ route('order.confirm-payment') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            },
            body: formData
        });
    })
    .then(function(response) {
        if (response.redirected) {
            clearCart();
            sessionStorage.removeItem('payment_name');
            sessionStorage.removeItem('payment_email');
            window.location.href = response.url;
            return;
        }
        if (!response.ok) {
            return response.json().then(function(err) {
                var msg = 'Failed to submit payment details';
                if (err.errors) {
                    var first = Object.values(err.errors)[0];
                    if (first && first.length) msg = first[0];
                } else if (err.message) {
                    msg = err.message;
                }
                throw new Error(msg);
            });
        }
        return response;
    })
    .then(function() {
        // Redirect on success
        clearCart();
        sessionStorage.removeItem('payment_name');
        sessionStorage.removeItem('payment_email');
        window.location.href = '{{ route('forex.my-orders') }}';
    })
    .catch(function(error) {
        showToast(error.message || 'Something went wrong. Please try again.', 'error');
        btn.disabled = false;
        btn.innerHTML = '<svg style="width:1rem;height:1rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> Confirm Order';
    });
}

document.addEventListener('DOMContentLoaded', function() {
    renderPaymentSummary();
});
</script>
@endpush
@endsection
