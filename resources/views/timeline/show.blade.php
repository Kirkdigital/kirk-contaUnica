@extends('layouts.baseminimal')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="p-5 card">
                    <div class="post-thumb-gallery">
                        <figure class="post-thumb img-popup">
                            <a href="{{ $post->image }}">
                                <img src="{{ $post->image }}" alt="post image">
                            </a>
                        </figure>
                    </div>
                    <div>{{ $post->body }}</div>

                    {{ $comments }}
                </div>
            </div>
        </div>
    </div>
@endsection