@extends('admin.app.layout')

@section('body')
    <div class="container">
        <h2>Edit Editor</h2>
        <form action="{{ route('editors.update', $editor->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $editor->name) }}">
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $editor->email) }}">
            </div>

             <div class="mb-3">
                <label>Role</label>
                <select name="role" class="form-control">
                    <option value="admin" {{ old('role', $editor->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="editor" {{ old('role', $editor->role) == 'editor' ? 'selected' : '' }}>Editor</option>

                </select>
                @error('role')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Status --}}
            {{-- <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select id="status" name="status" class="form-control @error('status') is-invalid @enderror">
                    <option value="draft" {{ old('status', $editor->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ old('status', $editor->status) == 'published' ? 'selected' : '' }}>Published</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div> --}}

            {{-- Paid --}}
            {{-- <div class="mb-3">
                <label for="is_paid" class="form-label">Payment Status</label>
                <select id="is_paid" name="is_paid" class="form-control @error('is_paid') is-invalid @enderror">
                    <option value="0" {{ old('is_paid', $editor->is_paid) == 0 ? 'selected' : '' }}>Unpaid</option>
                    <option value="1" {{ old('is_paid', $editor->is_paid) == 1 ? 'selected' : '' }}>Paid</option>
                </select>
                @error('is_paid')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div> --}}

            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
@endsection
