@extends('frontend.app')

@section('title', 'Payment Details — ESHA\'S ROKOMARIS 2')
@section('meta_description', 'Send your payment and submit the proof at Esha\'s Rokomaris 2.')

@section('content')

@php
    $isCod   = ($method === 'cod');
    $isDone  = in_array($order->payment_status, ['submitted', 'paid'], true);
    $dueLabel = $isCod
        ? 'Delivery charge (advance payment)'
        : 'Order total';
@endphp

@if(session('success'))
    <div class="brand-container">
        <p class="notice" role="status">{{ session('success') }}</p>
    </div>
@endif

@if($errors->any())
    <div class="brand-container">
        <p class="notice notice--error" role="status">
            @foreach($errors->all() as $error)
                {{ $error }}@if(!$loop->last)<br>@endif
            @endforeach
        </p>
    </div>
@endif

<section class="page-head">
    <div class="brand-container">
        <span class="eyebrow">
            Order #{{ $order->id }} {{ $isCod ? '· Advance Delivery Payment' : '· Secure Payment' }}
        </span>
        <h1 class="page-head__title">
            @if($isCod) Pay Delivery Charge in Advance
            @else {{ ucfirst($method) }} Payment
            @endif
        </h1>
        <p class="page-head__text">
            @if($isCod)
                Your product value will be paid on delivery — but the delivery charge
                is paid now via bKash or Nagad.
            @else
                Send the full order amount to the number below, then submit your payment proof.
            @endif
        </p>
    </div>
</section>

<section class="section section--ivory">
    <div class="brand-container">

        @if($isDone)

            {{-- ======================================== ALREADY SUBMITTED --}}
            <div class="payment-done">
                <span class="payment-done__mark" aria-hidden="true">
                    @if($order->payment_status === 'paid')
                        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                            <path d="M22 4 12 14.01l-3-3"/>
                        </svg>
                    @else
                        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                            <path d="M14 2v6h6"/>
                            <path d="M9 13v3m3-5v5m3-4v2"/>
                        </svg>
                    @endif
                </span>

                <h2 class="payment-done__title">
                    {{ $order->payment_status === 'paid' ? 'Payment Confirmed' : 'Payment Details Submitted' }}
                </h2>
                <p class="payment-done__text">
                    @if($order->payment_status === 'paid')
                        Your payment has been confirmed. Thank you!
                    @else
                        We've received your payment details and will verify them shortly.
                        The order will move ahead once the payment is confirmed.
                    @endif
                </p>

                <ul class="payment-done__list">
                    <li>
                        <span>Order ID</span>
                        <span>#{{ $order->id }}</span>
                    </li>
                    <li>
                        <span>Amount paid</span>
                        <span>{{ $currency }} {{ number_format($amountDue, 2) }}</span>
                    </li>
                    @if($order->sender_number)
                        <li>
                            <span>Your number</span>
                            <span>{{ $order->sender_number }}</span>
                        </li>
                    @endif
                    @if($order->transaction_id)
                        <li>
                            <span>Transaction ID</span>
                            <span>{{ $order->transaction_id }}</span>
                        </li>
                    @endif
                    @if($order->payment_screenshot)
                        <li>
                            <span>Payment screenshot</span>
                            <span>
                                <a href="{{ config('app.storage_url') . $order->payment_screenshot }}" target="_blank" rel="noopener">View attachment</a>
                            </span>
                        </li>
                    @endif
                </ul>

                <div class="payment-done__actions">
                    <a class="btn" href="{{ url('/orders') }}">View My Orders</a>
                    <a class="link-arrow" href="{{ url('/search') }}">Continue Shopping</a>
                </div>
            </div>

        @else

            {{-- ====================================== PAYMENT STEPS --}}
            <div class="payment-layout">

                {{-- ---------------------------- WHERE TO SEND MONEY --}}
                <div class="payment-card">
                    <h2 class="payment-card__title">
                        Step 1 · Send Money
                    </h2>

                    @if(!$isCod && !($bkashNo || $nagadNo))
                        {{-- Specific provider number missing is handled below --}}
                    @endif

                    <div class="payment-amount">
                        <span class="payment-amount__label">{{ $dueLabel }}</span>
                        <span class="payment-amount__value">{{ $currency }} {{ number_format($amountDue, 2) }}</span>
                    </div>

                    @if($isCod)

                        {{-- COD: choose which one to pay the delivery charge to --}}
                        <p class="payment-card__hint">Pay the delivery charge to either number below:</p>

                        <div class="payment-options">
                            @foreach(['bkash' => 'bKash', 'nagad' => 'Nagad'] as $pv => $pl)
                                <div class="payment-method-box">
                                    <span class="payment-method-box__label">{{ $pl }} Number</span>
                                    <span class="payment-method-box__number">
                                        {{ $pv === 'bkash' ? ($bkashNo ?? '—') : ($nagadNo ?? '—') }}
                                    </span>
                                </div>
                            @endforeach
                        </div>

                    @else

                        {{-- bKash / Nagad single number --}}
                        @php
                            $payNumber = $method === 'bkash' ? $bkashNo : $nagadNo;
                            $payLabel  = $method === 'bkash' ? 'bKash' : 'Nagad';
                        @endphp

                        @if(!$payNumber)
                            <p class="notice notice--error">
                                No {{ $payLabel }} number has been set yet. Please contact support.
                            </p>
                        @else
                            <div class="payment-method-box payment-method-box--single">
                                <span class="payment-method-box__label">{{ $payLabel }} Number</span>
                                <span class="payment-method-box__number">{{ $payNumber }}</span>
                            </div>
                        @endif

                    @endif

                    <p class="payment-tip">
                        Open your {{ $isCod ? 'bKash/Nagad' : ucfirst($method) }} app,
                        choose "Send Money", enter the number above and send
                        {{ $currency }} {{ number_format($amountDue, 2) }}.
                        Keep the Transaction ID safe — you'll need it below.
                    </p>
                </div>

                {{-- -------------------------------- PROOF FORM --}}
                <div class="payment-card">
                    <h2 class="payment-card__title">Step 2 · Submit Payment Proof</h2>

                    <form action="{{ url('/user/order/payment/' . $order->id) }}" method="POST" enctype="multipart/form-data" class="payment-form">
                        @csrf

                        @if($isCod)
                            <div class="form-field">
                                <label>Paid via <span class="req">*</span></label>
                                <div class="pay-options pay-options--stack">
                                    <label class="pay-option">
                                        <input type="radio" name="advance_method" value="bkash"
                                               {{ old('advance_method') === 'bkash' ? 'checked' : '' }} required>
                                        <span class="pay-option__box">
                                            <span class="pay-option__name">bKash</span>
                                            <span class="pay-option__sub">{{ $bkashNo ?? '00000000000' }}</span>
                                        </span>
                                    </label>
                                    <label class="pay-option">
                                        <input type="radio" name="advance_method" value="nagad"
                                               {{ old('advance_method') === 'nagad' ? 'checked' : '' }}>
                                        <span class="pay-option__box">
                                            <span class="pay-option__name">Nagad</span>
                                            <span class="pay-option__sub">{{ $nagadNo ?? '00000000000' }}</span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        @endif

                        <div class="form-field">
                            <label for="sender_number">Your {{ $isCod ? 'bKash/Nagad' : ucfirst($method) }} number <span class="req">*</span></label>
                            <input class="form-control" type="tel" id="sender_number" name="sender_number"
                                   value="{{ old('sender_number', $order->sender_number ?? '') }}"
                                   placeholder="01XXXXXXXXX" required>
                        </div>

                        <div class="form-field">
                            <label for="transaction_id">Transaction ID <span class="req">*</span></label>
                            <input class="form-control" type="text" id="transaction_id" name="transaction_id"
                                   value="{{ old('transaction_id', $order->transaction_id ?? '') }}"
                                   placeholder="e.g. 9HDWXY1A2B" required>
                        </div>

                        <div class="form-field">
                            <label for="screenshot">Payment screenshot (optional)</label>
                            <input class="form-control" type="file" id="screenshot" name="screenshot"
                                   accept="image/*">
                            <span class="form-note">JPEG, PNG or WebP, up to 4 MB.</span>
                        </div>

                        <button type="submit" class="btn btn--block">Submit Payment Proof</button>
                    </form>
                </div>

            </div>

        @endif

    </div>
</section>

@include('frontend.partials.footer')

@endsection