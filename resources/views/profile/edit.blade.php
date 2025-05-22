@extends('layouts.app')
@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-sm rounded-4 border-0 mb-4 p-4">
                <div class="text-center mb-4">
                    <span class="material-symbols-rounded" style="font-size:3rem;color:#1abc9c;">account_circle</span>
                    <h1 class="fw-bold mb-1" style="letter-spacing:1px;">Your Account Details</h1>
                    <div class="text-muted mb-2">Update your personal information below</div>
                </div>
                <form method="POST" action="{{ route('profile.update') }}" class="px-2 px-md-4">
                    @csrf
                    @method('PATCH')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name', $user->first_name) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name', $user->last_name) }}" required>
                        </div>
                        <div class="col-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                        </div>
                        <div class="col-12">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $user->address) }}">
                        </div>
                        <div class="col-12">
                            <label for="credit_card_number" class="form-label">Credit Card Number</label>
                            <input type="text" class="form-control" id="credit_card_number" name="credit_card_number" value="{{ old('credit_card_number', $user->credit_card_number) }}">
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary rounded-pill px-5">Save Changes</button>
                    </div>
                </form>
            </div>
            <div class="card shadow-sm rounded-4 border-0 mb-4">
                <div class="card-body">
                    <h2 class="h5 mb-3">Update Your Password</h2>
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input type="password" class="form-control" id="current_password" name="current_password" autocomplete="current-password">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="password" name="password" autocomplete="new-password">
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" autocomplete="new-password">
                        </div>
                        <button type="submit" class="btn btn-outline-primary rounded-pill px-4">Update Password</button>
                    </form>
                </div>
            </div>
            <div class="card shadow-sm rounded-4 border-0 mb-4">
                <div class="card-body">
                    <h2 class="h5 mb-3 text-danger">Permanently Remove Account</h2>
                    <form method="POST" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('DELETE')
                        <div class="mb-3">
                            <label for="delete_password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="delete_password" name="password" placeholder="Enter your password to confirm">
                        </div>
                        <button type="submit" class="btn btn-danger rounded-pill px-4">Delete My Account</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // AJAX review submission (already present)
    // Add AJAX for profile update
    const profileForm = document.querySelector('form[action*="profile.update"]');
    if(profileForm) {
        profileForm.addEventListener('submit', function(e) {
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
                let msg = data.success ? 'Profile updated!' : (data.error || 'Error updating profile.');
                alert(msg);
                if(data.success) location.reload();
            });
        });
    }
});
</script>
@endpush
