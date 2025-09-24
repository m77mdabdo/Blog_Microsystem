@extends('admin.app.layout')

@section('body')
    <div class="container">
        <h2>Editor Details</h2>
        <div class="card mb-3">
            <div class="card-body">
                <p><strong>ID:</strong> {{ $editor->id }}</p>
                <p><strong>Name:</strong> {{ $editor->name }}</p>
                <p><strong>Email:</strong> {{ $editor->email }}</p>
                <p><strong>Role:</strong> {{ ucfirst($editor->role) }}</p>
            </div>
        </div>

        <h3>Posts by {{ $editor->name }}</h3>
        @if ($posts->count() > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Payment Status</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            {{-- Title as link --}}
                            <td>
                                <a href="{{ route('posts.show', $post->id) }}">
                                    {{ Str::limit($post->title['en'] ?? $post->title['ar'] ?? 'Untitled', 30) }}
                                </a>
                            </td>

                            {{-- Status --}}
                            <td>{{ $post->status ?? $post->status }}</td>
                            <td> {{$post->is_paid ? 'Paid' : 'Unpaid' }} </td>

                            {{-- Created At --}}
                            <td>{{ $post->created_at->format('Y-m-d') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No posts found for this editor.</p>
        @endif

        <a href="{{ route('editors.edit', $editor->id) }}" class="btn btn-warning btn-sm">Edit</a>
        <form action="{{ route('editors.delete', $editor->id) }}" method="POST" class="d-inline">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
        </form>
        <br>
        <a href="{{ route('editors.index') }}" class="btn btn-secondary mt-3">Back</a>
    </div>
@endsection
