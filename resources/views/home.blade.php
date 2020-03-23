@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-body">
                    <x-post-modal></x-post-modal>
                </div>
            </div>

            @foreach($posts as $post)
                <div class="card mt-3">
                    <div class="card-header">{{ $post->title }}</div>

                    <div class="card-body">

                        {{ $post->text }}

                    </div>

                    <div class="card-footer">
                        @if($post->is_liked)
                            <a href="{{ route('post.unlike', compact('post')) }}" class="btn btn-danger">Unlike</a>
                        @else
                            <a href="{{ route('post.like', compact('post')) }}" class="btn btn-primary">Like</a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
