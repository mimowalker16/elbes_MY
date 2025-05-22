@extends('layouts.app')
@section('content')
<div class="container-fluid my-4">
    <div class="row">
        <!-- Sidebar for admin navigation -->
        <aside class="col-lg-2 mb-4 mb-lg-0">
            <div class="card shadow-sm rounded-4 border-0 sticky-top" style="top:90px;">
                <div class="card-body d-flex flex-column gap-3 p-3">
                    <a href="{{ route('admin.dashboard') }}" class="text-secondary">Dashboard</a>
                    <a href="{{ route('admin.users') }}" class="text-secondary">Manage Users</a>
                    <a href="{{ route('products.index') }}" class="fw-bold text-primary-emphasis">Manage Products</a>
                    <a href="{{ route('events.pending') }}" class="text-secondary">Pending Events</a>
                </div>
            </div>
        </aside>
        <main class="col-lg-10">
            <div class="d-flex align-items-center mb-4 gap-3">
                <span style="display:inline-block;vertical-align:middle;">@include('partials.nav-icons', ['icon' => 'products'])</span>
                <h1 class="display-5 fw-bold mb-0" style="letter-spacing:1px;">Manage Your Inventory</h1>
            </div>
            <a href="{{ route('products.create') }}" class="btn btn-success mb-3 rounded-pill px-4">Add Product</a>
            <div class="card shadow-sm rounded-4 border-0 mb-4">
                <div class="card-header bg-primary text-white rounded-top-4">
                    <h2 class="mb-0" style="font-size:1.2rem; font-weight:600;">All Products</h2>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td class="align-middle">{{ $product->name }}</td>
                                <td class="align-middle">{{ $product->category }}</td>
                                <td class="align-middle fw-bold">${{ number_format($product->price, 2) }}</td>
                                <td class="align-middle">{{ $product->stock_quantity }}</td>
                                <td class="align-middle">
                                    @if($product->image_url)
                                        <img src="{{ asset($product->image_url) }}" alt="{{ $product->name }}" style="width:50px;height:50px;object-fit:cover;" class="rounded-3 border">
                                    @else
                                        <span class="text-muted">No image</span>
                                    @endif
                                </td>
                                <td class="align-middle d-flex flex-column flex-md-row gap-2">
                                    <a href="{{ route('products.edit', $product) }}" class="btn btn-outline-primary btn-sm rounded-pill px-3 w-100 w-md-auto">Modify</a>
                                    <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline w-100 w-md-auto" onsubmit="return confirm('Delete this product?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3 w-100 w-md-auto">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
            <div class="mt-4 d-flex flex-column flex-md-row align-items-center justify-content-between gap-2">
                <div class="text-muted small w-100 w-md-auto text-md-start text-center mb-2 mb-md-0">
                    {{ $products->firstItem() }}–{{ $products->lastItem() }} of {{ $products->total() }} results
                </div>
                <div class="d-flex justify-content-md-end justify-content-center w-100 w-md-auto">
                    {{ $products->links() }}
                </div>
            </div>
        </main>
    </div>
</div>
@endsection

@push('scripts')
<style>
.pagination {
    display: flex;
    justify-content: center;
    gap: 0.5rem;
    margin-bottom: 2rem;
}
@media (min-width: 768px) {
    .pagination {
        justify-content: flex-end;
    }
}
.pagination .page-item {
    display: inline-block;
}
.pagination .page-link {
    border-radius: 50px !important;
    background: var(--elbes-light) !important;
    color: var(--elbes-primary) !important;
    border: 1.5px solid var(--elbes-primary) !important;
    font-weight: 600;
    padding: 0.5rem 1.1rem;
    margin: 0 0.15rem;
    transition: background 0.2s, color 0.2s;
}
.pagination .page-link:hover, .pagination .page-item.active .page-link {
    background: var(--elbes-primary) !important;
    color: #fff !important;
    border-color: var(--elbes-primary) !important;
}
</style>
@endpush
