@extends('layouts.admin')

@section('content')
    <div class="dashboard-overview">
        <h1>Welcome to Admin Dashboard</h1>
        <p>Manage your system and monitor activities from here!</p>
    </div>

    <!-- Dashboard Stats Table -->
    <div class="dashboard-stats">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Statistic</th>
                    <th>Value</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Total Orders</td>
                    <td>{{ $orderCount }}</td>
                </tr>
                <tr>
                    <td>Total Revenue</td>
                    <td>${{ number_format($totalRevenue, 2) }}</td>
                </tr>
                <tr>
                    <td>Pending Orders</td>
                    <td>{{ $pendingOrders }}</td>
                </tr>
                <tr>
                    <td>Total Sales</td>
                    <td>{{ $salesCount }}</td>
                </tr>
                <tr>
                    <td>Total Sales Revenue</td>
                    <td>${{ number_format($totalSalesRevenue, 2) }}</td>
                </tr>
                <tr>
                    <td>Total Reviews</td>
                    <td>{{ $reviewsCount }}</td>
                </tr>
                <tr>
                    <td>Average Rating</td>
                    <td>{{ number_format($averageRating, 2) }}</td>
                </tr>
                <tr>
                    <td>Total Admins</td>
                    <td>{{ $adminCount }}</td>
                </tr>
                <tr>
                    <td>Last Admin Login</td>
                    <td>{{ $lastAdminLogin }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
