@extends('layouts.app')
@section('content')
<div class="elbes-container py-5">
    <!-- Announcement Banner -->
    <div class="elbes-alert elbes-alert-info text-center mb-5" style="background:linear-gradient(90deg,#1ecbe1,#0e7c7b);color:#fff;font-size:1.2rem;border:none;border-radius:12px;">
        <strong>Just Launched!</strong> Discover exclusive offers and free delivery on your first order. <a href="{{ route('shop') }}" class="text-white text-decoration-underline">Start exploring</a>
    </div>
    <!-- Multi-Item Linked Carousel -->
    <h2 class="mb-4 fw-bold" style="color:#1ecbe1;">Handpicked For You</h2>
    @php
        $products = $featuredProducts ?? [];
        $count = count($products);
    @endphp
    @if($count > 0)
    <div id="featuredProductsCarousel" class="carousel slide mb-5" data-bs-ride="carousel">
        <div class="carousel-inner">
            @for($i = 0; $i < $count; $i++)
                <div class="carousel-item @if($i === 0) active @endif">
                    <div class="row justify-content-center">
                        @for($j = 0; $j < 3; $j++)
                            @php $product = $products[($i + $j) % $count]; @endphp
                            <div class="col-12 col-md-4 mb-3">
                                <div class="card h-100 border-primary text-center p-3">
                                    @if($product->image_url)
                                        <img src="{{ $product->image_url }}" class="card-img-top mx-auto" alt="{{ $product->name }}" style="height:200px;object-fit:cover;max-width:300px;">
                                    @else
                                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height:200px;">
                                            <span class="text-muted">No image</span>
                                        </div>
                                    @endif
                                    <div class="card-body d-flex flex-column align-items-center">
                                        <h5 class="card-title">{{ $product->name }}</h5>
                                        <p class="card-text text-muted mb-1">{{ $product->category }}</p>
                                        <p class="card-text fw-bold mb-2">${{ $product->price }}</p>
                                        <a href="{{ route('shop') }}" class="btn btn-outline-primary mt-auto">View Shop</a>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            @endfor
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#featuredProductsCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#featuredProductsCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    @else
        <div class="elbes-alert elbes-alert-info text-center mb-5">Check out our full selection in the <a href="{{ route('shop') }}">Shop</a>!</div>
    @endif
    <!-- Hero Section -->
    <div class="d-flex justify-content-center align-items-center mb-5" style="min-height:320px;">
        <div class="card shadow-lg border-0 flex-row align-items-center p-4" style="background:linear-gradient(90deg,#e6f2ff 60%,#1ecbe1 100%);max-width:900px;width:100%;">
            <div class="d-flex align-items-center justify-content-center" style="min-width:220px;">
                <img src="{{ asset('hero.jpeg') }}" alt="Shop Hero" class="rounded-circle shadow" style="width:180px;height:180px;object-fit:cover;border:6px solid #fff;">
            </div>
            <div class="flex-grow-1 ps-4">
                <h1 class="fw-bold mb-3" style="color:#0e7c7b; letter-spacing:1px;">Your New Shopping Destination</h1>
                <p class="lead text-muted mb-4">Find the latest trends, unique finds, and everyday essentials—all in one place. elbes MY brings you a fresh, easy, and inspiring way to shop online.</p>
                <a href="{{ route('shop') }}" class="elbes-btn elbes-btn-primary btn-lg px-4 me-2">Browse Collection</a>
                @guest
                    <a href="{{ route('register') }}" class="elbes-btn elbes-btn-outline-primary btn-lg px-4">Join Now</a>
                @endguest
            </div>
        </div>
    </div>
    <!-- Info Cards -->
    <div class="row text-center mb-5">
        <div class="col-md-4 mb-3">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <span class="material-symbols-rounded" style="font-size:3rem;color:#1ecbe1;">local_shipping</span>
                    <h5 class="card-title fw-bold">Lightning-Fast Delivery</h5>
                    <p class="card-text text-muted">We get your order to your door in record time—no waiting, no worries.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <span class="material-symbols-rounded" style="font-size:3rem;color:#0e7c7b;">verified_user</span>
                    <h5 class="card-title fw-bold">Shop With Confidence</h5>
                    <p class="card-text text-muted">Your privacy and security are our top priorities, every step of the way.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <span class="material-symbols-rounded" style="font-size:3rem;color:#ffc107;">support_agent</span>
                    <h5 class="card-title fw-bold">Friendly, Local Support</h5>
                    <p class="card-text text-muted">Questions? Our team is here for you—fast, helpful, and always local.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
