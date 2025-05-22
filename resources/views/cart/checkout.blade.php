@extends('layouts.app')
@section('content')
<div class="container my-4">
    <h1 class="mb-4 fw-bold" style="letter-spacing:1px;">Checkout</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if($cartItems->isEmpty())
        <div class="alert alert-info">Your cart is empty. There is nothing to checkout.</div>
        <a href="{{ route('shop') }}" class="btn btn-primary mt-3">Continue Shopping</a>
    @else
        <div class="row g-4">
            <!-- Order Summary -->
            <div class="col-12 col-lg-7">
                <div class="card shadow-sm rounded-4 border-0 mb-4 checkout-card">
                    <div class="card-header bg-primary text-white rounded-top-4">
                        <h2 class="mb-0" style="font-size:1.2rem; font-weight:600;">Order Summary</h2>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Product</th>
                                    <th class="d-none d-md-table-cell">Price</th>
                                    <th>Quantity</th>
                                    <th class="d-none d-md-table-cell">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($cartItems as $item)
                                <tr>
                                    <!-- Product info: image + name -->
                                    <td class="align-middle">
                                        <div class="d-flex align-items-center gap-3">
                                            @if($item->product->image_url)
                                                <img src="{{ asset($item->product->image_url) }}" alt="{{ $item->product->name }}" style="width:48px;height:48px;object-fit:cover;" class="rounded-3 border">
                                            @else
                                                <span class="text-muted">No image</span>
                                            @endif
                                            <div>
                                                <div class="fw-semibold">{{ $item->product->name }}</div>
                                                <div class="text-muted small d-md-none">${{ number_format($item->product->price, 2) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <!-- Price (desktop only) -->
                                    <td class="align-middle d-none d-md-table-cell fw-bold">${{ number_format($item->product->price, 2) }}</td>
                                    <!-- Quantity -->
                                    <td class="align-middle">{{ $item->quantity }}</td>
                                    <!-- Subtotal (desktop only) -->
                                    <td class="align-middle d-none d-md-table-cell fw-bold">${{ number_format($item->product->price * $item->quantity, 2) }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
                <div class="text-end mb-4">
                    <h3 class="fw-bold">Total: ${{ number_format($total, 2) }}</h3>
                </div>
            </div>
            <!-- Shipping & Payment -->
            <div class="col-12 col-lg-5">
                <div class="card shadow-sm rounded-4 border-0 mb-4 position-relative" style="background:linear-gradient(135deg,#e8f6f3 60%,#f8fafc 100%);border-left:6px solid #1abc9c;">
                    <div class="card-header bg-white border-0 rounded-top-4 pb-0">
                        <h2 class="mb-0 d-flex align-items-center gap-2" style="font-size:1.1rem; font-weight:600; color:#1abc9c;">
                            <span class="material-symbols-rounded align-middle" style="font-size:1.5rem;">local_shipping</span>
                            Shipping & Payment
                        </h2>
                    </div>
                    <div class="card-body pt-2 pb-4 px-4">
                        <div class="mb-4">
                            <h5 class="mb-2 d-flex align-items-center gap-2" style="color:#1abc9c;">
                                <span class="material-symbols-rounded align-middle" style="font-size:1.3rem;">person</span>
                                Shipping Address
                            </h5>
                            <div class="ps-4 ms-1 border-start border-2 border-primary-subtle">
                                <div class="fw-semibold">{{ Auth::user()->name ?? Auth::user()->first_name }}</div>
                                <div class="text-muted small">{{ Auth::user()->email }}</div>
                                @if(Auth::user()->address)
                                    <div class="mt-1">{{ Auth::user()->address }}</div>
                                @else
                                    <div class="mt-1 text-warning d-flex align-items-center gap-2">
                                        No address on file.
                                        <a href="{{ route('profile.edit') }}" class="ps-1 profile-link-update-cyan" style="font-size:inherit;text-decoration:none;">Update in Profile</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <hr class="my-3">
                        <div class="mb-4">
                            <h5 class="mb-2 d-flex align-items-center gap-2" style="color:#1abc9c;">
                                <span class="material-symbols-rounded align-middle" style="font-size:1.3rem;">credit_card</span>
                                Payment Method
                            </h5>
                            <div class="ps-4 ms-1 border-start border-2 border-primary-subtle">
                                @if(Auth::user()->credit_card_number)
                                    <span class="fw-semibold">Credit Card:</span>
                                    <span class="text-muted small">**** **** **** {{ substr(Auth::user()->credit_card_number, -4) }}</span>
                                @else
                                    <span class="text-warning d-flex align-items-center gap-2">
                                        No credit card on file.
                                        <a href="{{ route('profile.edit') }}" class="ps-1 text-primary text-decoration-underline-hover" style="font-size:inherit;text-decoration:none;">Update in Profile</a>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <form method="POST" action="{{ route('cart.placeOrder') }}" class="mt-4">
                            @csrf
                            <button type="submit" class="btn btn-success w-100 rounded-pill py-2 fs-5 shadow-sm" style="background:#1abc9c;border:0;">Place Order</button>
                        </form>
                    </div>
                </div>
                <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary w-100 rounded-pill">&laquo; Back to Cart</a>
            </div>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<style>
.checkout-card {
    transition: box-shadow 0.2s;
}
.checkout-card:hover {
    box-shadow: 0 0 0 0.2rem #b2f0e6;
}
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // AJAX Place Order (optional enhancement)
    const checkoutForm = document.querySelector('form[action*="cart.placeOrder"]');
    if(checkoutForm) {
        checkoutForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            fetch(this.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                let msg = data.success ? 'Order placed!' : (data.error || 'Error placing order.');
                alert(msg);
                if(data.success && data.redirect) window.location.href = data.redirect;
            });
        });
    }
});
</script>
@endpush

@push('styles')
<style>
.profile-link-update-cyan {
    color: #1abc9c !important;
    transition: color 0.15s;
    text-decoration: none;
    cursor: pointer;
}
.profile-link-update-cyan:hover {
    text-decoration: underline !important;
    color: #148f77 !important;
}
</style>
@endpush
