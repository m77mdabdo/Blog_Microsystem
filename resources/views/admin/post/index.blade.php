@extends('admin.app.layout')

@section('body')

<div class="container-fluid">
    <h2 class="mb-3">All Posts</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Status</th>
                <th>Author</th>
                <th>Payment Status</th>
                <th colspan="3" class="text-center">Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ is_array($post->title) ? json_encode($post->title) : $post->title }}</td>
                    <td>{{ ucfirst($post->status) }}</td>
                    <td>{{ $post->user ? $post->user->name : 'N/A' }}</td>
                    <td class="text-center">
                        @if($post->is_paid)
                            <span class="badge bg-success">Paid</span>
                        @else
                            <span class="badge bg-danger">Unpaid</span>
                        @endif
                    </td>

                    <td class="text-center">
                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-info btn-sm w-100">Show</a>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-sm w-100">Update</a>
                    </td>
                    <td class="text-center">
                        <form action="{{ route('posts.delete', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm w-100">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


    {{ $posts->links() }}

    <a href="{{ route('posts.create') }}" class="btn btn-primary mt-3">
        + Create New Post
    </a>
</div>

@endsection
