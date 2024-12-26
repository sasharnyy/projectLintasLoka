@extends('layouts.admin')

@section('content')
<h1>Total Sales</h1>

@php
    $period = $period ?? 'daily';
@endphp

<!-- Dropdown untuk memilih periode sales -->
<div class="mb-3">
    <form method="GET" action="{{ url('/admin/sales') }}">
        <label for="period" class="form-label">Select Sales Period</label>
        <select class="form-control" name="period" id="period" onchange="this.form.submit()">
        <option value="daily" {{ request('period') == 'daily' ? 'selected' : '' }}>Daily</option>
        <option value="monthly" {{ request('period') == 'monthly' ? 'selected' : '' }}>Monthly</option>
        <option value="yearly" {{ request('period') == 'yearly' ? 'selected' : '' }}>Yearly</option>
        </select>
    </form>
</div>

<table class="table" style="width: 100%; border-collapse: collapse; margin-top: 20px;">
    <thead style="background-color: #f8f9fa; text-align: left;">
        <tr>
            <th style="border: 1px solid #ddd; padding: 10px;">Sale ID</th>
            <th style="border: 1px solid #ddd; padding: 10px;">Total Amount</th>
            <th style="border: 1px solid #ddd; padding: 10px;">Sale Date</th>
            <th style="border: 1px solid #ddd; padding: 10px;">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($sales as $sale)
            <tr>
                @if ($period == 'monthly' || $period == 'yearly')
                <td style="border: 1px solid #ddd; padding: 10px;">
                    @php
                    $i = $i ?? 1;
                    echo $i++;
                @endphp
                </td>    
                @else
                <td style="border: 1px solid #ddd; padding: 10px;">{{ $sale->id }}</td>
                @endif
                <td style="border: 1px solid #ddd; padding: 10px;">${{ number_format($sale->total_amount, 2) }}</td>
                <td style="border: 1px solid #ddd; padding: 10px;">
                    @if($period == 'monthly')
                        {{ \Carbon\Carbon::createFromDate($sale->year, $sale->month, 1)->format('F Y') }}
                    @elseif($period == 'yearly')
                        {{ $sale->year }}
                    @else
                        {{ \Carbon\Carbon::parse($sale->sale_date)->format('Y-m-d') }}
                    @endif
                </td>

                @if ($period == 'monthly' || $period == 'yearly')
                <td style="border: 1px solid #ddd; padding: 10px;">
                    <div class="d-flex gap-2">
                        <button  class="btn btn-warning btn-sm"  disabled>Edit</button>
                        <button  class="btn btn-danger btn-sm"  disabled>Delete</button>
                    </div>
                </td>
                @else
                <td style="border: 1px solid #ddd; padding: 10px;">
                    <div class="d-flex gap-2">
                        <a href="#editSale{{ $sale->id }}" data-bs-toggle="modal" data-bs-target="#editSaleModal{{ $sale->id }}" class="btn btn-warning btn-sm">Edit</a>
                        <a href="http://your-app/admin/sales/delete/123" onclick="return confirm('Are you sure you want to delete this sale?')" class="btn btn-danger btn-sm">Delete</a>
                    </div>
                </td>
                @endif
            </tr>

            @if ($period == 'daily')
                <!-- Modal Edit Form -->
            <div class="modal fade" id="editSaleModal{{ $sale->id }}" tabindex="-1" aria-labelledby="editSaleModalLabel{{ $sale->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editSaleModalLabel{{ $sale->id }}">Edit Sale</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('sales.update', $sale->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="total_amount" class="form-label">Total Amount</label>
                                    <input type="number" class="form-control" name="total_amount" value="{{ $sale->total_amount }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="sale_date" class="form-label">Sale Date</label>
                                    <input type="date" class="form-control" name="sale_date" value="{{ \Carbon\Carbon::parse($sale->sale_date)->format('Y-m-d') }}" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        @endforeach
    </tbody>
</table>
@endsection