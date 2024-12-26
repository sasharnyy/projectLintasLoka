@extends('layouts.admin')

@section('content')
    <h1>Reviews</h1>
    <table class="table" style="width: 100%; border-collapse: collapse; margin-top: 20px;">
        <thead style="background-color: #f8f9fa; text-align: left;">
            <tr>
                <th style="border: 1px solid #ddd; padding: 10px;">Review ID</th>
                <th style="border: 1px solid #ddd; padding: 10px;">Destination</th>
                <th style="border: 1px solid #ddd; padding: 10px;">Rating</th>
                <th style="border: 1px solid #ddd; padding: 10px;">Reviewer</th>
                <th style="border: 1px solid #ddd; padding: 10px;">Review</th>
                <th style="border: 1px solid #ddd; padding: 10px;">Date</th>
                <th style="border: 1px solid #ddd; padding: 10px;">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reviews as $review)
                <tr>
                    <td style="border: 1px solid #ddd; padding: 10px;">{{ $review->id }}</td>
                    <td style="border: 1px solid #ddd; padding: 10px;">{{ $review->destination->name ?? 'Unknown Destination' }}</td>
                    <td style="border: 1px solid #ddd; padding: 10px;">{{ $review->rating }}</td>
                    <td style="border: 1px solid #ddd; padding: 10px;">{{ $review->user->username ?? 'Unknown User' }}</td>
                    <td style="border: 1px solid #ddd; padding: 10px;">{{ $review->review_text }}</td>
                    <td style="border: 1px solid #ddd; padding: 10px;">{{ $review->created_at?->format('Y-m-d') }}</td>
                    <td style="border: 1px solid #ddd; padding: 10px;">
                        <a href="{{ route('reviews.delete', $review->id) }}" onclick="return confirm('Are you sure you want to delete this review?')" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
