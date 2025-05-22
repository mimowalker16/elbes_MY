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
                    <a href="{{ route('products.index') }}" class="text-secondary">Manage Products</a>
                    <a href="{{ route('events.pending') }}" class="fw-bold text-primary-emphasis">Pending Events</a>
                </div>
            </div>
        </aside>
        <main class="col-lg-10">
            <div class="d-flex align-items-center mb-4 gap-3">
                <span style="display:inline-block;vertical-align:middle;">@include('partials.nav-icons', ['icon' => 'pending-events'])</span>
                <h1 class="display-5 fw-bold mb-0" style="letter-spacing:1px;">Pending Events (Admin Approval)</h1>
            </div>
            @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
            @if($events->isEmpty())
                <div class="alert alert-info">No pending events.</div>
            @else
                <div class="card shadow-sm rounded-4 border-0 mb-4">
                    <div class="card-header bg-primary text-white rounded-top-4">
                        <h2 class="mb-0" style="font-size:1.2rem; font-weight:600;">Pending Events</h2>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($events as $event)
                                <tr>
                                    <td class="align-middle">{{ $event->name }}</td>
                                    <td class="align-middle">{{ $event->description }}</td>
                                    <td class="align-middle">{{ $event->event_date }}</td>
                                    <td class="align-middle">@if($event->image_url)<img src="{{ $event->image_url }}" class="rounded-3 border" style="width:80px;height:60px;object-fit:cover;">@else<span class="text-muted">No image</span>@endif</td>
                                    <td class="align-middle d-flex flex-column flex-md-row gap-2">
                                        <form method="POST" action="{{ route('events.approve', $event->id) }}" class="d-inline w-100 w-md-auto">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm rounded-pill px-3 w-100 w-md-auto">Approve</button>
                                        </form>
                                        <form method="POST" action="{{ route('events.reject', $event->id) }}" class="d-inline w-100 w-md-auto">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm rounded-pill px-3 w-100 w-md-auto">Reject</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            @endif
        </main>
    </div>
</div>
@endsection
