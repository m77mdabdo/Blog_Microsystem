@extends('admin.app.layout')

@section('body')

<div class="container-fluid">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th colspan="3" class="text-center">Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($admins as $admin)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $admin->name }}</td>
                    <td class="text-right">{{ $admin->email }}</td>
                    <td class="text-right">{{ $admin->role }}</td>

                    <td>
                        <a href="{{ route('admins.show', $admin->id) }}" class="btn btn-primary btn-sm">
                            Show
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('admins.edit', $admin->id) }}" class="btn btn-warning btn-sm">
                            Update
                        </a>
                    </td>
                    <td>
                        <form action="{{ route('admins.delete', $admin->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- pagination --}}
    {{ $admins->links() }}

    <a href="{{ route('admins.create') }}" class="btn btn-primary mt-3">
        + Create New
    </a>
</div>

@endsection
