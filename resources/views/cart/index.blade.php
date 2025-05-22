@extends('layouts.app')
@section('content')
<div class="container my-4">
    <div class="d-flex align-items-center mb-4">
        <span class="me-3" style="display:inline-block;vertical-align:middle;">@include('partials.nav-icons', ['icon' => 'cart'])</span>
        <h1 class="display-5 fw-bold mb-0" style="letter-spacing:1px;">Your Shopping Cart</h1>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if($cartItems->isEmpty())
        <div class="alert alert-info">Looks like your cart is empty. Ready to discover something new?</div>
        <a href="{{ route('shop') }}" class="btn btn-primary mt-3">Browse Products</a>
    @else
        <div class="card shadow-sm rounded-4 border-0 mb-4 cart-card">
            <div class="card-header bg-primary text-white rounded-top-4">
                <h2 class="mb-0" style="font-size:1.2rem; font-weight:600;">Items in Your Bag</h2>
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
                            <th>Actions</th>
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
                            <!-- Quantity update -->
                            <td class="align-middle">
                                <form method="POST" action="{{ route('cart.update', $item->product_id) }}" class="d-flex align-items-center gap-2">
                                    @csrf
                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control form-control-sm text-center" style="width:60px;">
                                    <button type="submit" class="btn btn-outline-secondary btn-sm px-2">Update</button>
                                </form>
                            </td>
                            <!-- Subtotal (desktop only) -->
                            <td class="align-middle d-none d-md-table-cell fw-bold">${{ number_format($item->product->price * $item->quantity, 2) }}</td>
                            <!-- Actions -->
                            <td class="align-middle">
                                <form method="POST" action="{{ route('cart.remove', $item->product_id) }}" onsubmit="return confirm('Remove this item from your bag?');" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm px-3">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
            <h3 class="fw-bold mb-0">Total: ${{ number_format($total, 2) }}</h3>
            <a href="{{ route('cart.checkout') }}" class="btn btn-success btn-lg rounded-pill px-5 py-2">Proceed to Checkout</a>
        </div>
        <a href="{{ route('shop') }}" class="btn btn-outline-primary rounded-pill px-4">Continue Shopping</a>
    @endif
</div>
@endsection

@push('scripts')
<style>
.cart-card {
    transition: box-shadow 0.2s;
}
.cart-card:hover {
    box-shadow: 0 0 0 0.2rem #b2f0e6;
}
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // AJAX Update Cart
    document.querySelectorAll('form[action*="cart.update"]').forEach(form => {
        form.addEventListener('submit', function(e) {
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
                let msg = data.success ? 'Cart updated!' : (data.error || 'Error updating cart.');
                alert(msg);
                if(data.success) location.reload();
            });
        });
    });
    // AJAX Remove from Cart
    document.querySelectorAll('form[action*="cart.remove"]').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            if(!confirm('Remove this item?')) return;
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
                let msg = data.success ? 'Item removed!' : (data.error || 'Error removing item.');
                alert(msg);
                if(data.success) location.reload();
            });
        });
    });
});
</script>
@endpush
