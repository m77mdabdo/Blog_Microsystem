@extends('admin.app.layout')

@section('body')
<div class="container">
    <h2>Edit Post</h2>
    <form action="{{ route('posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Title EN --}}
        <div class="mb-3">
            <label for="title_en" class="form-label">Title (English)</label>
            <input
                type="text"
                id="title_en"
                name="title[en]"
                class="form-control @error('title.en') is-invalid @enderror"
                value="{{ old('title.en', $post->title['en'] ?? '') }}"
                {{ auth()->user()->role === 'editor' ? '' : '' }}>
            @error('title.en')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Title AR --}}
        <div class="mb-3">
            <label for="title_ar" class="form-label">Title (Arabic)</label>
            <input
                type="text"
                id="title_ar"
                name="title[ar]"
                class="form-control @error('title.ar') is-invalid @enderror"
                value="{{ old('title.ar', $post->title['ar'] ?? '') }}">
            @error('title.ar')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Content --}}
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea
                id="content"
                name="content"
                class="form-control @error('content') is-invalid @enderror"
                rows="5">{{ old('content', $post->content) }}</textarea>
            @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Status --}}
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select
                id="status"
                name="status"
                class="form-control @error('status') is-invalid @enderror">
                <option value="draft" {{ old('status', $post->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="published" {{ old('status', $post->status) == 'published' ? 'selected' : '' }}>Published</option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- لو Admin فقط --}}
        @if(auth()->user()->role === 'admin')
            {{-- Paid --}}
            <div class="mb-3">
                <label for="is_paid" class="form-label">Payment Status</label>
                <select id="is_paid" name="is_paid" class="form-control @error('is_paid') is-invalid @enderror">
                    <option value="0" {{ old('is_paid', $post->is_paid) == false ? 'selected' : '' }}>Unpaid</option>
                    <option value="1" {{ old('is_paid', $post->is_paid) == true ? 'selected' : '' }}>Paid</option>
                </select>
                @error('is_paid')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Payment Details (read only) --}}
            @if ($post->payment)
                <div class="mb-3">
                    <label>Payment Details</label>
                    <p><strong>Amount:</strong> {{ $post->payment->amount ?? '-' }}</p>
                    <p><strong>Payment Date:</strong> {{ $post->payment->created_at ?? '-' }}</p>
                    <p><strong>Status:</strong> {{ $post->payment->status ?? '-' }}</p>
                </div>
            @endif
        @endif

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
