@extends('layouts.admin')

@section('content')
<div class="admin-list-content">
    <h1>Admin List</h1>
    @if(session('success'))
        <div class="alert alert-success" style="background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 10px; margin-bottom: 20px; border-radius: 5px;">
            {{ session('success') }}
        </div>
    @endif

    <table class="table" style="width: 100%; border-collapse: collapse; margin-top: 20px;">
        <thead style="background-color: #f8f9fa; text-align: left;">
            <tr>
                <th style="border: 1px solid #ddd; padding: 10px;">Admin ID</th>
                <th style="border: 1px solid #ddd; padding: 10px;">Username</th>
                <th style="border: 1px solid #ddd; padding: 10px;">Email</th>
                <th style="border: 1px solid #ddd; padding: 10px;">Registered Date</th>
                <th style="border: 1px solid #ddd; padding: 10px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($admins as $admin)
                <tr>
                    <td style="border: 1px solid #ddd; padding: 10px;">{{ $admin->id }}</td>
                    <td style="border: 1px solid #ddd; padding: 10px;">{{ $admin->username }}</td>
                    <td style="border: 1px solid #ddd; padding: 10px;">{{ $admin->email }}</td>
                    <td style="border: 1px solid #ddd; padding: 10px;">{{ $admin->created_at->format('Y-m-d') }}</td>
                    <td style="border: 1px solid #ddd; padding: 10px; display: flex; gap: 5px;">
                        <a href="#editAdmin{{ $admin->id }}" class="btn btn-warning btn-sm" data-bs-toggle="collapse">Edit</a>
                        <form action="{{ route('admin.delete', $admin->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this admin?');" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                <tr id="editAdmin{{ $admin->id }}" class="collapse">
                    <td colspan="5">
                        <form action="{{ route('admin.update', $admin->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row g-2">
                                <div class="col-md-4">
                                    <label for="username{{ $admin->id }}" class="form-label">Username</label>
                                    <input type="text" name="username" id="username{{ $admin->id }}" class="form-control" value="{{ $admin->username }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="email{{ $admin->id }}" class="form-label">Email</label>
                                    <input type="email" name="email" id="email{{ $admin->id }}" class="form-control" value="{{ $admin->email }}" required>
                                </div>
                                <div class="col-md-4 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary btn-sm w-100">Update</button>
                                </div>
                            </div>
                        </form>
                        <a href="#editAdmin{{ $admin->id }}" class="btn btn-secondary btn-sm w-100 mt-2" data-bs-toggle="collapse">Cancel</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
