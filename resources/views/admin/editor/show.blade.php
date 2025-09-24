@extends('admin.app.layout')

@section('body')
    <div class="container">
        <h2>Editor Details</h2>
        <div class="card">
            <div class="card-body">
                <p><strong>ID:</strong> {{ $editor->id }}</p>
                <p><strong>Name:</strong> {{ $editor->name }}</p>
                <p><strong>Email:</strong> {{ $editor->email }}</p>
                <p><strong>Role:</strong> {{ ucfirst($editor->role) }}</p>
            </div>
        </div>

         <a href="{{ route('editors.edit', $editor->id) }}" class="btn btn-warning btn-sm">Edit</a>
        <form action="{{ route('editors.delete', $editor->id) }}" method="POST" class="d-inline">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
        </form>
         <br>
         <a href="{{ route('editors.index') }}" class="btn btn-secondary mt-3">Back</a>

    </div>
@endsection
