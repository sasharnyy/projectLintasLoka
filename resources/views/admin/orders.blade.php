@extends('layouts.admin')

@section('content')
<div class="order-content">
    <h1>Orders</h1>

    @if(session('success'))
        <div class="alert alert-success" style="background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 10px; margin-bottom: 20px; border-radius: 5px;">
            {{ session('success') }}
        </div>
    @endif

    <table class="table" style="width: 100%; border-collapse: collapse; margin-top: 20px;">
        <thead style="background-color: #f8f9fa; text-align: left;">
            <tr>
                <th style="border: 1px solid #ddd; padding: 10px;">Order ID</th>
                <th style="border: 1px solid #ddd; padding: 10px;">User</th>
                <th style="border: 1px solid #ddd; padding: 10px;">Total Amount</th>
                <th style="border: 1px solid #ddd; padding: 10px;">Status</th>
                <th style="border: 1px solid #ddd; padding: 10px;">Date</th>
                <th style="border: 1px solid #ddd; padding: 10px;">Destination</th>
                <th style="border: 1px solid #ddd; padding: 10px;">Quantity</th>
                <th style="border: 1px solid #ddd; padding: 10px;">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td style="border: 1px solid #ddd; padding: 10px;">{{ $order->id }}</td>
                    <td style="border: 1px solid #ddd; padding: 10px;">{{ $order->customer_name }}</td>
                    <td style="border: 1px solid #ddd; padding: 10px;">${{ number_format($order->total_amount, 2) }}</td>
                    <td style="border: 1px solid #ddd; padding: 10px;">{{ $order->status }}</td>
                    <td style="border: 1px solid #ddd; padding: 10px;">
                        {{ $order->created_at ? $order->created_at->format('Y-m-d') : 'No Date' }}
                    </td>
                    <td style="border: 1px solid #ddd; padding: 10px;">{{ $order->destination }}</td>
                    <td style="border: 1px solid #ddd; padding: 10px;">{{ $order->quantity }}</td>
                    <td style="border: 1px solid #ddd; padding: 10px;">
                        <div class="d-flex gap-2">
                            <a href="#editOrder{{ $order->id }}" data-bs-toggle="modal" data-bs-target="#editOrderModal{{ $order->id }}" class="btn btn-warning btn-sm">Edit</a>
                            <a href="{{ route('orders.delete', $order->id) }}" onclick="return confirm('Are you sure you want to delete this order?')" class="btn btn-danger btn-sm">Delete</a>
                        </div>
                    </td>
                </tr>

                <!-- Modal Edit Form -->
                <div class="modal fade" id="editOrderModal{{ $order->id }}" tabindex="-1" aria-labelledby="editOrderModalLabel{{ $order->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editOrderModalLabel{{ $order->id }}">Edit Order</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('orders.update', $order->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="mb-3">
                                        <label for="customer_name" class="form-label">Customer Name</label>
                                        <input type="text" class="form-control" name="customer_name" value="{{ $order->customer_name }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="total_amount" class="form-label">Total Amount</label>
                                        <input type="number" class="form-control" name="total_amount" value="{{ $order->total_amount }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select name="status" class="form-control" required>
                                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="destination" class="form-label">Destination</label>
                                        <input type="text" class="form-control" name="destination" value="{{ $order->destination }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="quantity" class="form-label">Quantity</label>
                                        <input type="number" class="form-control" name="quantity" value="{{ $order->quantity }}" required>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
