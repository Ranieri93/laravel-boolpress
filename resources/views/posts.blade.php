@extends('layouts.public')
@section('content')
    <div class="container">
        <div class="row">
            <div class="offset-3 col-6">
                <h1 class="text-center">Lista di tutti i post</h1>
                <ul class="list-group">
                    @forelse ($posts as $post)
                        <li class="list-group-item text-center">
                            <a href="{{ route('blog.show', ['slug' => $post->slug]) }}">
                                {{ $post->title }}
                            </a>
                        </li>
                    @empty
                        <li class="list-group-item">Non ci sono ancora post</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
@endsection
