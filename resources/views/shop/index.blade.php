@extends('layouts.app')
@section('content')
<div class="container-fluid my-4">
    <div class="row">
        <!-- Sidebar: Category Filter (collapsible on mobile) -->
        <nav class="col-md-2 mb-3 mb-md-0">
            <div class="card shadow-sm rounded-4 sticky-top" style="top:90px;">
                <div class="card-body p-3">
                    <h6 class="fw-bold mb-3" style="letter-spacing:1px;">Categories</h6>
                    <form method="GET" action="{{ route('shop') }}" id="categoryForm">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2">
                                <button type="submit" name="category" value="" class="btn btn-link p-0 w-100 text-center text-decoration-none {{ !request('category') ? 'fw-bold text-primary' : '' }}">All Categories</button>
                            </li>
                            @foreach($categories as $cat)
                                <li class="mb-2">
                                    <button type="submit" name="category" value="{{ $cat }}" class="btn btn-link p-0 w-100 text-center text-decoration-none {{ request('category') == $cat ? 'fw-bold text-primary' : '' }}">{{ $cat }}</button>
                                </li>
                            @endforeach
                        </ul>
                    </form>
                </div>
            </div>
        </nav>
        <main class="col-md-10">
            <!-- Search Bar -->
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between mb-4 gap-3">
                <form method="GET" action="{{ route('shop') }}" class="w-100 w-md-50 mx-auto" style="max-width:500px;">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control rounded-start-pill" placeholder="Find something special..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary rounded-end-pill px-4">Search</button>
                    </div>
                </form>
            </div>

            <!-- Best Sellers: Horizontal Scroll -->
            @if($bestSellers && count($bestSellers))
            <h2 class="mb-3" style="font-size:1.3rem;">Top Picks This Month</h2>
            <div class="mb-4 overflow-auto" style="white-space:nowrap;">
                <div class="d-flex flex-row gap-3" style="min-width:300px;">
                    @foreach($bestSellers as $category => $product)
                        <div class="card border-0 shadow-sm rounded-4 position-relative" style="min-width:220px;max-width:220px;">
                            @if($product->image_url)
                                <img src="{{ $product->image_url }}" class="card-img-top rounded-top-4" alt="{{ $product->name }}" style="height:120px;object-fit:cover;">
                            @else
                                <img src="{{ asset('placeholder.svg') }}" class="card-img-top rounded-top-4" alt="No image" style="height:120px;object-fit:cover;opacity:0.7;">
                            @endif
                            <div class="card-body p-3">
                                <span class="badge bg-success mb-1">{{ $category }}</span>
                                <div class="fw-bold small">{{ $product->name }}</div>
                                <div class="small text-muted">Sold: {{ $product->total_sold }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Product Grid -->
            <div class="row g-4">
                @foreach($products as $product)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm rounded-4 position-relative product-card">
                        <div class="position-relative">
                            @if($product->image_url)
                                <img src="{{ $product->image_url }}" class="card-img-top rounded-top-4" alt="{{ $product->name }}" style="height:180px;object-fit:cover;">
                            @else
                                <img src="{{ asset('placeholder.svg') }}" class="card-img-top rounded-top-4" alt="No image" style="height:180px;object-fit:cover;opacity:0.7;">
                            @endif
                            <!-- Quick View Icon Overlay -->
                            <button class="btn btn-light btn-sm rounded-circle shadow position-absolute top-0 end-0 m-2 quick-view-btn" data-product-id="{{ $product->id }}" title="Quick View" style="z-index:2;">
                                <span class="material-symbols-rounded align-middle">visibility</span>
                            </button>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title mb-1" style="font-size:1.1rem;">{{ $product->name }}</h5>
                            <div class="text-muted small mb-1">{{ $product->category }}</div>
                            <div class="fw-bold mb-3" style="font-size:1.1rem;">${{ $product->price }}</div>
                            <form method="POST" action="{{ route('cart.add', $product) }}" class="mt-auto add-to-cart-form">
                                @csrf
                                <div class="input-group">
                                    <input type="number" name="quantity" value="1" min="1" class="form-control rounded-start-pill" style="max-width:60px;" aria-label="Quantity">
                                    <button type="submit" class="btn btn-primary rounded-end-pill px-3" aria-label="Add to cart">
                                        <span class="material-symbols-rounded align-middle">add_shopping_cart</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="mt-4 d-flex flex-column flex-md-row align-items-center justify-content-between gap-2">
                <div class="text-muted small w-100 w-md-auto text-md-start text-center mb-2 mb-md-0">
                    {{ $products->firstItem() }}–{{ $products->lastItem() }} of {{ $products->total() }} results
                </div>
                <div class="d-flex justify-content-md-end justify-content-center w-100 w-md-auto">
                    {{ $products->withQueryString()->links() }}
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
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Quick View Modal logic
    document.querySelectorAll('.quick-view-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const productId = this.getAttribute('data-product-id');
            fetch(`/products/${productId}`)
                .then(res => res.json())
                .then(product => {
                    document.getElementById('quickViewTitle').textContent = product.name;
                    document.getElementById('quickViewImage').src = product.image_url || '/placeholder.svg';
                    document.getElementById('quickViewImage').alt = product.name;
                    document.getElementById('quickViewCategory').textContent = product.category;
                    document.getElementById('quickViewPrice').textContent = `$${product.price}`;
                    document.getElementById('quickViewDescription').textContent = product.description || '';
                    const modal = new bootstrap.Modal(document.getElementById('quickViewModal'));
                    modal.show();
                });
        });
    });

    // AJAX Add to Cart
    document.querySelectorAll('.add-to-cart-form').forEach(form => {
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
            .then data => {
                let msg = data.success ? 'Added to cart!' : (data.error || 'Error adding to cart.');
                alert(msg);
            });
        });
    });
});
</script>
@endpush

<!-- Quick View Modal -->
<div class="modal fade" id="quickViewModal" tabindex="-1" aria-labelledby="quickViewTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="quickViewTitle"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <img id="quickViewImage" src="" alt="" class="img-fluid mb-3 rounded" style="max-height:220px;object-fit:cover;">
        <div class="mb-2"><span class="badge bg-secondary" id="quickViewCategory"></span></div>
        <div class="mb-2 fw-bold" id="quickViewPrice"></div>
        <div class="mb-2" id="quickViewDescription"></div>
      </div>
    </div>
  </div>
</div>
