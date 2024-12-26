@extends('layouts.admin')

@section('content')
<h1>Total Sales</h1>

@php
    $period = $period ?? 'daily';
@endphp

<!-- Dropdown untuk memilih periode sales -->
<div class="mb-3">
    <form method="GET" action="{{ url('/admin/calculate') }}">
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
                <td style="border: 1px solid #ddd; padding: 10px;">
                    @for($i = 1; $i <= 10; $i++)
                    <p>Number: {{ $i }}</p>
                @endfor
                </td>
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
                <td style="border: 1px solid #ddd; padding: 10px;">
                    <div class="d-flex gap-2">
                        <a href="#editSale{{ $sale->id }}" data-bs-toggle="modal" data-bs-target="#editSaleModal{{ $sale->id }}" class="btn btn-warning btn-sm">Edit</a>
                        <a href="http://your-app/admin/sales/delete/123" onclick="return confirm('Are you sure you want to delete this sale?')" class="btn btn-danger btn-sm">Delete</a>
                    </div>
                </td>
            </tr>

        @endforeach
    </tbody>
</table>
@endsection