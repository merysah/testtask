@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ $user->name }}</h3>
                        <div>{{ $user->email }}</div>
                    </div>

                    <div class="card-body">
                        <h5>Posts</h5>
                        <table class="table table-hover w-100">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th class="w-25">Image</th>
                                @if(Auth::user()->isAdmin() || $user->id == Auth::user()->id)
                                    <th>Action</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($user->posts as $post)
                                <tr>
                                    <td>{{ $post->id }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->description }}</td>
                                    <td><img src="{{ \App\Helpers\ImgHelper::getImgName($post->image) }}" alt="" class="w-100"></td>
                                    @if(Auth::user()->isAdmin() || $user->id == Auth::user()->id)
                                        <td class="row justify-content-center">
                                            <a href="{{ route('posts.edit', $post->id)  }}" class=" btn text-warning px-1"><i class="fa fa-edit fa-lg" aria-hidden="true"></i></a>
                                            <form action="{{ route('posts.destroy', $post->id) }}" class="form-inline" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn text-danger px-1"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
