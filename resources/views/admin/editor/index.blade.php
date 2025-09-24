@extends('admin.app.layout')

@section('body')
<div class="container">
    <h2>All Editors</h2>
    <table class="table">
        <thead>
            <tr>
                <th>#</th><th>Name</th><th>Email</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($editors as $editor)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $editor->name }}</td>
                <td>{{ $editor->email }}</td>
                <td>
                    <a href="{{ route('editors.show', $editor->id) }}" class="btn btn-info btn-sm">Show</a>
                    <a href="{{ route('editors.edit', $editor->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('editors.delete', $editor->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('editors.create') }}" class="btn btn-primary mt-3">+ Add Editor</a>
</div>
@endsection
