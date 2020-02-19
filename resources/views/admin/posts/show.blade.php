@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6 offset-3">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h4 class="card-title"> {{$post->title}}</h4>
                        <a class="btn btn-dark" href="{{route('admin.posts.index')}}">Torna indietro</a>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Contenuto: <br> {{$post->content}}</li>
                            <li class="list-group-item">Autore: <br> {{$post->author}}</li>
                            <li class="list-group-item">Slug: <br> {{$post->slug}}</li>
                            <li class="list-group-item">Creato il: <br> {{$post->created_at}}</li>
                            <li class="list-group-item">Aggiornato il: <br> {{$post->updated_at}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
