@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Posts List
                        @if(!Auth::user()->isAdmin())
                            <a href="{{ route('posts.create') }}" class="btn btn-outline-primary float-right">Add Post</a>
                        @endif
                    </div>

                    <div class="card-body">
                        <table class="table table-hover w-100">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User Name</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th class="w-25">Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allPosts as $post)
                                    <tr>
                                        <td>{{ $post->id }}</td>
                                        <td>{{ $post->user->name }}</td>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ $post->description }}</td>
                                        <td><img src="{{ \App\Helpers\ImgHelper::getImgName($post->image) }}" alt="" class="w-100"></td>
                                        <td class="row justify-content-center">
                                            <a href="{{ route('posts.show', $post->id)  }}" class=" btn text-primary px-1"><i class="fa fa-eye fa-lg" aria-hidden="true"></i></a>
                                            @if(Auth::user()->isAdmin() || $post->user_id == Auth::user()->id)
                                                <a href="{{ route('posts.edit', $post->id)  }}" class=" btn text-warning px-1"><i class="fa fa-edit fa-lg" aria-hidden="true"></i></a>
                                                <form action="{{ route('posts.destroy', $post->id) }}" class="form-inline" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="btn text-danger px-1"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $allPosts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
