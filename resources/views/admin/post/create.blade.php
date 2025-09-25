@extends('admin.app.layout')

@section('body')
<div class="container mt-4">
    <h2>Create New Post</h2>

    <form action="{{ route('posts.store') }}" method="POST">
        @csrf

        {{-- Title EN --}}
        <div class="mb-3">
            <label for="title_en" class="form-label">Title (English)</label>
            <input type="text" id="title_en" name="title[en]" class="form-control"
                   value="{{ old('title.en') }}" required>
            @error('title.en') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        {{-- Title AR --}}
        <div class="mb-3">
            <label for="title_ar" class="form-label">Title (Arabic)</label>
            <input type="text" id="title_ar" name="title[ar]" class="form-control"
                   value="{{ old('title.ar') }}">
            @error('title.ar') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        {{-- Content --}}
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea id="content" name="content" class="form-control" rows="5" required>{{ old('content') }}</textarea>
            @error('content') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        @if(auth()->user()->role === 'admin')
            {{-- Status --}}
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select id="status" name="status" class="form-control">
                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                </select>
                @error('status') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- Payment --}}
            <div class="mb-3">
                <label for="is_paid" class="form-label">Payment Status</label>
                <select id="is_paid" name="is_paid" class="form-control">
                    <option value="0" {{ old('is_paid') == 0 ? 'selected' : '' }}>Unpaid</option>
                    <option value="1" {{ old('is_paid') == 1 ? 'selected' : '' }}>Paid</option>
                </select>
                @error('is_paid') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        @endif

        <button type="submit" class="btn btn-success">Create Post</button>
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
