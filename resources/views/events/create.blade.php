@extends('layouts.app')
@section('content')
<div class="container-fluid my-4">
    <div class="row">
        <!-- Sidebar for event navigation -->
        <aside class="col-lg-2 mb-4 mb-lg-0">
            <div class="card shadow-sm rounded-4 border-0 sticky-top" style="top:90px;">
                <div class="card-body d-flex flex-column gap-3 p-3">
                    <a href="{{ route('events.index') }}" class="text-secondary">My Events</a>
                    <a href="{{ route('events.gallery') }}" class="text-secondary">Event Gallery</a>
                    <a href="{{ route('events.create') }}" class="fw-bold text-primary-emphasis">Submit Event</a>
                </div>
            </div>
        </aside>
        <main class="col-lg-10">
            <div class="d-flex align-items-center mb-4 gap-3">
                <span style="display:inline-block;vertical-align:middle;">@include('partials.nav-icons', ['icon' => 'events'])</span>
                <h1 class="display-5 fw-bold mb-0" style="letter-spacing:1px;">Submit Event/Salon Image</h1>
            </div>
            <div class="card shadow-sm rounded-4 border-0 p-4 mb-4">
                <div class="text-center mb-4">
                    <span class="material-symbols-rounded" style="font-size:2.5rem;color:#1abc9c;">add_a_photo</span>
                    <div class="text-muted mb-2">Share your event with the community</div>
                </div>
                @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('events.store') }}" enctype="multipart/form-data" id="eventForm">
                    @csrf
                    <div class="alert alert-info" id="imageSizeAlert" style="display:none;">Image must be 2MB or less.</div>
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Event Date</label>
                        <input type="date" name="event_date" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Image <span class="text-muted" style="font-size:0.95em;">(Max 2MB, jpeg/png/jpg/gif)</span></label>
                        <input type="file" name="image" class="form-control" accept="image/*" required id="eventImageInput">
                    </div>
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary rounded-pill px-5">Submit</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>
@endsection
@push('scripts')
<script>
document.getElementById('eventImageInput').addEventListener('change', function() {
    const alertDiv = document.getElementById('imageSizeAlert');
    if (this.files[0] && this.files[0].size > 2 * 1024 * 1024) {
        alertDiv.style.display = 'block';
        this.value = '';
    } else {
        alertDiv.style.display = 'none';
    }
});
</script>
@endpush
