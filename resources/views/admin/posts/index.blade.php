@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between">
                    <h1 class="text-uppercase">all post</h1>
                    <a class="btn btn-info align-self-center" href="{{route('admin.posts.create')}}"> Crea Nuovo</a>
                </div>

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Titolo</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Autore</th>
                        <th scope="col">Categorie</th>
                        <th scope="col">Tags</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($posts as $post)
                        <tr>
                            <th scope="row">{{ $post->id }}</th>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->slug }}</td>
                            <td>{{ $post->author }}</td>
                            <td>{{ $post->category ? $post->category->name : '-'}}</td>
                            <td>
                                @forelse($post->tags as $tag)
                                    {{$tag->name}} {{$loop->last ? '' : '-'}}
                                @empty
                                    -
                                @endforelse
                            </td>
                            <td class="d-flex justify-content-around">
                                <a class="btn btn-secondary" href="{{ route('admin.posts.show', ['post' => $post->id])}}">Details</a>
                                <a class="btn btn-warning" href="{{ route('admin.posts.edit', ['post' => $post->id])}}">Update</a>
                                <form method="post" action="{{ route('admin.posts.destroy', ['post' => $post->id])}}">
                                    @csrf
                                    @method('DELETE')
                                    <input class="btn btn-danger" type="submit" value="Delete">
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>non ci sono Post</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
