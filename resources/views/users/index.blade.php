@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Users List
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('users.create') }}" class="btn btn-outline-primary float-right">Add User</a>
                    @endif
                </div>

                <div class="card-body">
                    <table class=" table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allUsers as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td class="row justify-content-center">
                                        <a href="{{ route('users.show', $user->id)  }}" class=" btn text-primary px-1"><i class="fa fa-eye fa-lg" aria-hidden="true"></i></a>
                                        @if(Auth::user()->isAdmin())
                                            <a href="{{ route('users.edit', $user->id)  }}" class=" btn text-warning px-1"><i class="fa fa-edit fa-lg" aria-hidden="true"></i></a>
                                            @if(Auth::user()->id != $user->id)
                                                <form action="{{ route('users.destroy', $user->id) }}" class="form-inline" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="btn text-danger px-1"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></button>
                                                </form>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $allUsers->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
