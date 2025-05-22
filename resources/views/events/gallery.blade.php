@extends('layouts.app')
@section('content')
<div class="container-fluid my-4">
    <div class="row">
        <!-- Sidebar for event navigation -->
        <aside class="col-lg-2 mb-4 mb-lg-0">
            <div class="card shadow-sm rounded-4 border-0 sticky-top" style="top:90px;">
                <div class="card-body d-flex flex-column gap-3 p-3">
                    <a href="{{ route('events.index') }}" class="text-secondary">My Events</a>
                    <a href="{{ route('events.gallery') }}" class="fw-bold text-primary-emphasis">Event Gallery</a>
                    <a href="{{ route('events.create') }}" class="text-secondary">Submit Event</a>
                </div>
            </div>
        </aside>
        <main class="col-lg-10">
            <div class="d-flex align-items-center mb-4 gap-3">
                <span style="display:inline-block;vertical-align:middle;">@include('partials.nav-icons', ['icon' => 'events'])</span>
                <h1 class="display-5 fw-bold mb-0" style="letter-spacing:1px;">Event Gallery</h1>
            </div>
            @if($events->isEmpty())
                <div class="alert alert-info">No approved events yet.</div>
            @else
                <div class="row g-4">
                    @foreach($events as $event)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="card h-100 shadow-sm rounded-4 border-0">
                                @if($event->image_url)
                                    <img src="{{ $event->image_url }}" alt="{{ $event->name }}" class="card-img-top rounded-top-4" style="height:160px;object-fit:cover;">
                                @else
                                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center rounded-top-4" style="height:160px;">
                                        <span class="text-muted">No image</span>
                                    </div>
                                @endif
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title mb-1">{{ $event->name }}</h5>
                                    <div class="text-muted small mb-2">{{ $event->event_date }}</div>
                                    <div class="mb-2">{{ $event->description }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </main>
    </div>
</div>
@endsection
