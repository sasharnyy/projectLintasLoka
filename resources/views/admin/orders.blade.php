@extends('layouts.admin')

@section('content')
<div class="order-content">
    <h1>Orders</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>User</th>
                <th>Total Amount</th>
                <th>Payment Method</th>
                <th>Status</th>
                <th>Date</th>
                <th>Destination</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->username }}</td>  
                    <td>Rp{{ number_format($order->total_price, 2) }}</td> 
                    <td>{{ $order->payment_method }}</td>
                    <td>{{ $order->status }}</td>
                    <td>{{ $order->created_at ? $order->created_at->format('Y-m-d') : 'No Date' }}</td>
                    <td>{{ $order->destination_id}}</td>  
                    <td>
                        <div class="d-flex gap-2">
                            <a href="#editOrder{{ $order->id }}" data-bs-toggle="modal" data-bs-target="#editOrderModal{{ $order->id }}" class="btn btn-warning btn-sm">Edit</a>
                            <a href="{{ route('orders.delete', $order->id) }}" onclick="return confirm('Are you sure you want to delete this order?')" class="btn btn-danger btn-sm">Delete</a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination">
        {{ $orders->links() }}
    </div>
</div>
@endsection
