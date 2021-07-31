@extends('layouts.baseminimal')
    <!-- Scripts -->
    <script src="{{ mix('js/app.js', 'themes/reactions') }}" defer></script>
        <!-- Styles -->
        <link href="{{ mix('css/app.css', 'themes/reactions') }}" rel="stylesheet">
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Posts') }}</div>

                    <div class="card-body">
                        @foreach ($posts as $post)
                            <div class="mb-3 border-bottom">
                                <h2><a href="{{ route('timeline.show', $post) }}">{{ $post->title }}</a></h2>
                                <p>{{ $post->description }}</p>
                            </div>
                        @endforeach

                        {{ $posts->links("pagination::bootstrap-4") }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection