@extends('layouts.admin')

@section('content')
    <h1>Reports</h1>

    <!-- Orders Report Section -->
    <div class="report-section">
        <h2>Order Report</h2>
        <p>Total Orders: {{ $orderCount }}</p>
        <p>Total Revenue: ${{ number_format($totalRevenue, 2) }}</p>
        <p>Pending Orders: {{ $pendingOrders }}</p>
        
        <!-- Dropdown for Order Report Actions -->
        <div class="dropdown">
            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="orderReportActions" data-bs-toggle="dropdown" aria-expanded="false">
                Actions
            </button>
            <ul class="dropdown-menu" aria-labelledby="orderReportActions">
                <li><a class="dropdown-item" href="{{ route('reports.orders.export') }}">Export Order Report</a></li>
                <li><a class="dropdown-item" href="{{ route('reports.orders.download') }}">Download Order Report</a></li>
            </ul>
        </div>
    </div>

    <!-- Sales Report Section -->
    <div class="report-section">
        <h2>Sales Report</h2>
        <p>Total Sales: {{ $salesCount }}</p>
        <p>Total Sales Revenue: ${{ number_format($totalSalesRevenue, 2) }}</p>
        
        <!-- Dropdown for Sales Report Actions -->
        <div class="dropdown">
            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="salesReportActions" data-bs-toggle="dropdown" aria-expanded="false">
                Actions
            </button>
            <ul class="dropdown-menu" aria-labelledby="salesReportActions">
                <li><a class="dropdown-item" href="{{ route('reports.sales.export') }}">Export Sales Report</a></li>
                <li><a class="dropdown-item" href="{{ route('reports.sales.download') }}">Download Sales Report</a></li>
            </ul>
        </div>
    </div>

    <!-- Reviews Report Section -->
    <div class="report-section">
        <h2>Review Report</h2>
        <p>Total Reviews: {{ $reviewsCount }}</p>
        <p>Average Rating: {{ number_format($averageRating, 2) }}</p>
        
        <!-- Dropdown for Reviews Report Actions -->
        <div class="dropdown">
            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="reviewsReportActions" data-bs-toggle="dropdown" aria-expanded="false">
                Actions
            </button>
            <ul class="dropdown-menu" aria-labelledby="reviewsReportActions">
                <li><a class="dropdown-item" href="{{ route('reports.reviews.export') }}">Export Reviews Report</a></li>
                <li><a class="dropdown-item" href="{{ route('reports.reviews.download') }}">Download Reviews Report</a></li>
            </ul>
        </div>
    </div>

    <!-- Admin Activity Report Section -->
    <div class="report-section">
        <h2>Admin Activity Report</h2>
        <p>Total Admins: {{ $adminCount }}</p>
        <p>Last Admin Login: {{ $lastAdminLogin }}</p>
        
        <!-- Dropdown for Admin Activity Report Actions -->
        <div class="dropdown">
            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="adminReportActions" data-bs-toggle="dropdown" aria-expanded="false">
                Actions
            </button>
            <ul class="dropdown-menu" aria-labelledby="adminReportActions">
                <li><a class="dropdown-item" href="{{ route('reports.admin.export') }}">Export Admin Activity Report</a></li>
                <li><a class="dropdown-item" href="{{ route('reports.admin.download') }}">Download Admin Activity Report</a></li>
            </ul>
        </div>
    </div>

@endsection
