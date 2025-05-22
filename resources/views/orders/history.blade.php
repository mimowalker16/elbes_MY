@extends('layouts.app')
@section('content')
<div class="container my-4">
    <div class="d-flex align-items-center mb-4">
        <span class="me-3" style="display:inline-block;vertical-align:middle;">@include('partials.nav-icons', ['icon' => 'orders'])</span>
        <h1 class="display-5 fw-bold mb-0" style="letter-spacing:1px;">Your Past Purchases</h1>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($orders->isEmpty())
        <div class="alert alert-info">No orders yet! Start shopping and your history will appear here.</div>
    @else
        <div class="row g-4">
        @foreach($orders as $order)
            <div class="col-12">
                <div class="card shadow-sm rounded-4 border-0 mb-3 order-history-card">
                    <div class="card-header bg-primary text-white rounded-top-4 d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-2">
                        <div>
                            <span class="fw-bold">Order #{{ $order->id }}</span>
                            <span class="ms-2 small">Placed: {{ $order->order_date }}</span>
                        </div>
                        <div class="fw-bold">Total: ${{ $order->total_amount }}</div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Product</th>
                                    <th>Image</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($orderItems->where('order_id', $order->id) as $item)
                                <tr>
                                    <td class="align-middle">{{ $item->name }}</td>
                                    <td class="align-middle">@if($item->image_url)<img src="{{ $item->image_url }}" style="width:50px;height:50px;object-fit:cover;" class="rounded-3 border">@endif</td>
                                    <td class="align-middle">${{ $item->price }}</td>
                                    <td class="align-middle">{{ $item->quantity }}</td>
                                    <td class="align-middle">${{ $item->price * $item->quantity }}</td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="bg-light-subtle px-4 py-3">
                                        <div class="reviews" id="reviews-{{ $item->product_id }}-order-{{ $order->id }}">
                                            <div class="fw-semibold mb-2">Share your thoughts:</div>
                                            <div class="reviews-list mb-2"></div>
                                            @auth
                                                <form class="review-form d-flex flex-column flex-md-row align-items-md-center gap-2" data-product="{{ $item->product_id }}">
                                                    <label class="mb-1 mb-md-0">Rating:
                                                        <span class="star-input d-inline-flex ms-1">
                                                            @for($i=1;$i<=5;$i++)
                                                                <input type="radio" name="rating" id="star-{{ $item->product_id }}-{{ $i }}" value="{{ $i }}" style="display:none;" />
                                                                <label for="star-{{ $item->product_id }}-{{ $i }}" class="star-label" style="cursor:pointer;font-size:1.5rem;color:#e4e5e9;">&#9733;</label>
                                                            @endfor
                                                        </span>
                                                    </label>
                                                    <label class="flex-grow-1 mb-1 mb-md-0">Comment:
                                                        <input type="text" name="comment" maxlength="1000" placeholder="What did you love?" class="form-control form-control-sm ms-2">
                                                    </label>
                                                    <button type="submit" class="btn btn-primary btn-sm ms-md-2 py-1" style="min-width:110px;max-height:32px;">Send Review</button>
                                                </form>
                                                <div class="review-message mt-1" style="color:green;"></div>
                                            @endauth
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    @endif
</div>
@endsection

@push('scripts')
<style>
.star-label.selected,
.star-label:hover,
.star-label:hover ~ .star-label {
    color: #FFD600 !important;
}
.star-input input[type="radio"]:checked ~ label {
    color: #FFD600 !important;
}
.order-history-card {
    transition: box-shadow 0.2s;
}
.order-history-card:hover {
    box-shadow: 0 0 0 0.2rem #b2f0e6;
}
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    @foreach($orders as $order)
        @foreach($orderItems->where('order_id', $order->id) as $item)
            loadReviews({{ $item->product_id }});
        @endforeach
    @endforeach

    function loadReviews(productId) {
        fetch('/products/' + productId + '/reviews')
            .then(res => res.json())
            .then(data => {
                let html = '';
                if (data.reviews.length === 0) {
                    html = '<em>No reviews yet.</em>';
                } else {
                    data.reviews.forEach(r => {
                        html += `<div class="d-flex align-items-center mb-1">
                            <span class="star-rating me-2">${renderStars(r.rating)}</span>
                            <span>${r.comment ? r.comment : ''}</span>
                        </div>`;
                    });
                }
                document.querySelectorAll('#reviews-' + productId + ' .reviews-list').forEach(function(el) {
                    el.innerHTML = html;
                });
            });
    }

    function renderStars(rating) {
        let stars = '';
        for (let i = 1; i <= 5; i++) {
            if (i <= rating) {
                stars += `<svg width="18" height="18" fill="#FFD600" viewBox="0 0 24 24" style="vertical-align:middle;"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>`;
            } else {
                stars += `<svg width="18" height="18" fill="#e4e5e9" viewBox="0 0 24 24" style="vertical-align:middle;"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>`;
            }
        }
        return stars;
    }

    document.querySelectorAll('.review-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const productId = this.getAttribute('data-product');
            const formData = new FormData(this);
            fetch('/products/' + productId + '/review', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                let msgDiv = this.parentElement.querySelector('.review-message');
                if (data.success) {
                    msgDiv.textContent = 'Review submitted!';
                    loadReviews(productId);
                    this.reset();
                } else {
                    msgDiv.textContent = data.error || 'Error submitting review.';
                    msgDiv.style.color = 'red';
                }
            });
        });
    });

    document.querySelectorAll('.star-input').forEach(function(starInput) {
        const stars = starInput.querySelectorAll('.star-label');
        stars.forEach((star, idx) => {
            star.addEventListener('mouseenter', function() {
                for(let i=0; i<=idx; i++) stars[i].style.color = '#FFD600';
                for(let i=idx+1; i<stars.length; i++) stars[i].style.color = '#e4e5e9';
            });
            star.addEventListener('mouseleave', function() {
                const checked = starInput.querySelector('input[type="radio"]:checked');
                let val = checked ? parseInt(checked.value) : 0;
                stars.forEach((s, i) => s.style.color = i < val ? '#FFD600' : '#e4e5e9');
            });
            star.addEventListener('click', function() {
                starInput.querySelectorAll('input[type="radio"]')[idx].checked = true;
                stars.forEach((s, i) => s.style.color = i <= idx ? '#FFD600' : '#e4e5e9');
            });
        });
    });
});
</script>
@endpush
