@extends('admin.app.layout')

@section('body')
    <div class="container">
        <h2>Edit Admin</h2>
        <form action="{{ route('admins.update', $admin->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $admin->name) }}">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $admin->email) }}">
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            {{-- role --}}
            <div class="mb-3">
                <label>Role</label>
                <select name="role" class="form-control">
                    <option value="admin" {{ old('role', $admin->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="editor" {{ old('role', $admin->role) == 'editor' ? 'selected' : '' }}>Editor</option>
                    
                </select>
                @error('role')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
@endsection
