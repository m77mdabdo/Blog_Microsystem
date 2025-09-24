@extends('admin.app.layout')

@section('body')
    <div class="container">
        <h2>Post Details</h2>

        <div class="card mb-3">
            <div class="card-header">
                <strong>{{ is_array($post->title) ? json_encode($post->title) : $post->title }}</strong>
            </div>
            <div class="card-body">
                <p><strong>Status:</strong> {{ ucfirst($post->status) }}</p>
                <p><strong>Content:</strong> {{ $post->content }}</p>
                <p><strong>Editor:</strong>
                    <a href="{{ route('editors.show', $post->user->id) }}">
                        {{ $post->user->name }}
                    </a>
                </p>

                <p><strong>Payment Status:</strong>
                    @if ($post->is_paid)
                        <span class="badge bg-success">Paid</span>
                    @else
                        <span class="badge bg-danger">Unpaid</span>
                    @endif
                </p>

                @if ($post->payment)
                    <hr>
                    <h5>Payment Details</h5>
                    <p><strong>Amount:</strong> {{ $post->payment->amount ?? '-' }}</p>
                    <p><strong>Payment Date:</strong> {{ $post->payment->created_at ?? '-' }}</p>
                    <p><strong>Status:</strong> {{ $post->payment->status ?? '-' }}</p>
                @endif

                <a href="{{ route('posts.index') }}" class="btn btn-secondary mt-3">Back to Posts</a>
            </div>
        </div>
    </div>
@endsection
