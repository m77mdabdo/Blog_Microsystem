@extends('admin.app.layout')

@section('body')
<div class="container">
    <h2>Admin Details</h2>
    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $admin->id }}</p>
            <p><strong>Name:</strong> {{ $admin->name }}</p>
            <p><strong>Email:</strong> {{ $admin->email }}</p>
            <p><strong>Role:</strong> {{ ucfirst($admin->role) }}</p>
            <p><strong>Created At:</strong> {{ $admin->created_at->format('Y-m-d H:i') }}</p>
            <p><strong>Updated At:</strong> {{ $admin->updated_at->format('Y-m-d H:i') }}</p>
        </div>
    </div>

    <a href="{{ route('admins.index') }}" class="btn btn-secondary mt-3">Back</a>
    <a href="{{ route('admins.edit', $admin->id) }}" class="btn btn-warning mt-3">Edit</a>
    <form action="{{ route('admins.delete', $admin->id) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger mt-3">Delete</button>
    </form>
</div>
@endsection
