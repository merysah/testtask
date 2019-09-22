@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ $post->title }}</h3>
                    </div>

                    <div class="card-body">
                        <div>{{ $post->description }}</div>
                        <div>
                            <img src="{{ \App\Helpers\ImgHelper::getImgName($post->image) }}" class="w-100 rounded" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
