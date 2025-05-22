@extends('layouts.app')
@section('content')
<div class="container-fluid my-4">
    <div class="row">
        <!-- Sidebar for admin navigation -->
        <aside class="col-lg-2 mb-4 mb-lg-0">
            <div class="card shadow-sm rounded-4 border-0 sticky-top" style="top:90px;">
                <div class="card-body d-flex flex-column gap-3 p-3">
                    <a href="{{ route('admin.dashboard') }}" class="text-secondary">Dashboard</a>
                    <a href="{{ route('admin.users') }}" class="fw-bold text-primary-emphasis">Manage Users</a>
                    <a href="{{ route('products.index') }}" class="text-secondary">Manage Products</a>
                    <a href="{{ route('events.pending') }}" class="text-secondary">Pending Events</a>
                </div>
            </div>
        </aside>
        <main class="col-lg-10">
            <div class="d-flex align-items-center mb-4 gap-3">
                <span style="display:inline-block;vertical-align:middle;">@include('partials.nav-icons', ['icon' => 'admin'])</span>
                <h1 class="display-5 fw-bold mb-0" style="letter-spacing:1px;">Manage Users</h1>
            </div>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <div class="card shadow-sm rounded-4 border-0 mb-4">
                <div class="card-header bg-primary text-white rounded-top-4">
                    <h2 class="mb-0" style="font-size:1.2rem; font-weight:600;">All Users</h2>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td class="align-middle">{{ $user->id }}</td>
                                <td class="align-middle">{{ $user->first_name }} {{ $user->last_name }}</td>
                                <td class="align-middle">{{ $user->email }}</td>
                                <td class="align-middle">{{ $user->role }}</td>
                                <td class="align-middle">
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
