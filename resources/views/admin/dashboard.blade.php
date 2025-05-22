@extends('layouts.app')
@section('content')
<div class="container-fluid my-4">
    <div class="row">
        <!-- Sidebar for admin navigation -->
        <aside class="col-lg-2 mb-4 mb-lg-0">
            <div class="card shadow-sm rounded-4 border-0 sticky-top" style="top:90px;">
                <div class="card-body d-flex flex-column gap-3 p-3">
                    <a href="{{ route('admin.dashboard') }}" class="fw-bold text-primary-emphasis">Dashboard</a>
                    <a href="{{ route('admin.users') }}" class="text-secondary">Manage Users</a>
                    <a href="{{ route('products.index') }}" class="text-secondary">Manage Products</a>
                    <a href="{{ route('events.pending') }}" class="text-secondary">Pending Events</a>
                </div>
            </div>
        </aside>
        <main class="col-lg-10">
            <div class="d-flex align-items-center mb-4 gap-3">
                <span style="display:inline-block;vertical-align:middle;">@include('partials.nav-icons', ['icon' => 'admin'])</span>
                <h1 class="display-5 fw-bold mb-0" style="letter-spacing:1px;">Admin Dashboard</h1>
            </div>
            <!-- Stats and Charts Grid -->
            <div class="row g-4 mb-4">
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="card h-100 shadow-sm rounded-4 border-0 text-white" style="background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);">
                        <div class="card-body py-4">
                            <h6 class="card-title mb-2">Total Sales</h6>
                            <div class="display-6 fw-bold">{{ $totalSales }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="card h-100 shadow-sm rounded-4 border-0 text-white" style="background: linear-gradient(135deg, #1cc88a 0%, #13855c 100%);">
                        <div class="card-body py-4">
                            <h6 class="card-title mb-2">Total Revenue</h6>
                            <div class="display-6 fw-bold">${{ number_format($totalRevenue, 2) }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="card h-100 shadow-sm rounded-4 border-0 text-white" style="background: linear-gradient(135deg, #36b9cc 0%, #258fa3 100%);">
                        <div class="card-body py-4">
                            <h6 class="card-title mb-2">Orders This Month</h6>
                            <div class="display-6 fw-bold">{{ $ordersThisMonth }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="card h-100 shadow-sm rounded-4 border-0 text-white" style="background: linear-gradient(135deg, #858796 0%, #343a40 100%);">
                        <div class="card-body py-4">
                            <h6 class="card-title mb-2">Total Users</h6>
                            <div class="display-6 fw-bold">{{ $userCount }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Charts Row -->
            <div class="row g-4 mb-4">
                <div class="col-12 col-lg-4">
                    <div class="card shadow-sm rounded-4 border-0 h-100">
                        <div class="card-header bg-white border-0 rounded-top-4 pb-0">
                            <h6 class="mb-0 fw-bold" style="color:#1abc9c;">Sales Trend (Last 6 Months)</h6>
                        </div>
                        <div class="card-body"><canvas id="salesChart" height="180"></canvas></div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="card shadow-sm rounded-4 border-0 h-100">
                        <div class="card-header bg-white border-0 rounded-top-4 pb-0">
                            <h6 class="mb-0 fw-bold" style="color:#4e73df;">Revenue Trend (Last 6 Months)</h6>
                        </div>
                        <div class="card-body"><canvas id="revenueChart" height="180"></canvas></div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="card shadow-sm rounded-4 border-0 h-100">
                        <div class="card-header bg-white border-0 rounded-top-4 pb-0">
                            <h6 class="mb-0 fw-bold" style="color:#36b9cc;">Orders Trend (Last 6 Months)</h6>
                        </div>
                        <div class="card-body"><canvas id="ordersChart" height="180"></canvas></div>
                    </div>
                </div>
            </div>
            <!-- Top Products Table -->
            <div class="card shadow-sm rounded-4 border-0 mb-4">
                <div class="card-header bg-dark text-white rounded-top-4 d-flex align-items-center justify-content-between">
                    <h2 class="mb-0" style="font-size:1.2rem; font-weight:600; letter-spacing:1px;">Top 5 Products (All Time)</h2>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover mb-0" style="font-size:1.05rem;">
                        <thead style="background: #f8f9fc;">
                            <tr>
                                <th style="color:#4e73df; font-weight:600;">Product</th>
                                <th style="color:#1cc88a; font-weight:600;">Sold</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($topProducts as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->sold }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Data passed from controller as JSON
    const salesData = @json($salesData ?? []);
    const revenueData = @json($revenueData ?? []);
    const ordersData = @json($ordersData ?? []);
    const months = @json($monthsLabels ?? []);

    // Sales Chart
    if (document.getElementById('salesChart')) {
        new Chart(document.getElementById('salesChart').getContext('2d'), {
            type: 'line',
            data: {
                labels: months,
                datasets: [{
                    label: 'Sales',
                    data: salesData,
                    borderColor: '#1abc9c',
                    backgroundColor: 'rgba(26,188,156,0.1)',
                    tension: 0.4,
                    fill: true,
                    pointRadius: 4,
                    pointBackgroundColor: '#1abc9c',
                }]
            },
            options: {responsive:true, plugins:{legend:{display:false}}}
        });
    }
    // Revenue Chart
    if (document.getElementById('revenueChart')) {
        new Chart(document.getElementById('revenueChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: months,
                datasets: [{
                    label: 'Revenue',
                    data: revenueData,
                    backgroundColor: '#4e73df',
                    borderRadius: 8,
                }]
            },
            options: {responsive:true, plugins:{legend:{display:false}}}
        });
    }
    // Orders Chart
    if (document.getElementById('ordersChart')) {
        new Chart(document.getElementById('ordersChart').getContext('2d'), {
            type: 'line',
            data: {
                labels: months,
                datasets: [{
                    label: 'Orders',
                    data: ordersData,
                    borderColor: '#36b9cc',
                    backgroundColor: 'rgba(54,185,204,0.1)',
                    tension: 0.4,
                    fill: true,
                    pointRadius: 4,
                    pointBackgroundColor: '#36b9cc',
                }]
            },
            options: {responsive:true, plugins:{legend:{display:false}}}
        });
    }
});
</script>
@endpush
