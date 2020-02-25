<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Tag;
use Illuminate\Http\Request;
use App\Post;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use illuminate\Support\Str;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', ['posts' => $posts]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories= Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', [
            'categories' => $categories,
            'tags' => $tags
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // utilizzo la funzione validate:
        $request->$this->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'content' => 'required',
            'cover_img_file' => 'image'
        ]);

        //recupero tutti i dati:
        $data = $request->all();
        $post = new Post();

        // recupero l'immagine proveniente dal form, la devo recuperare a parte
        if (!empty($data['cover_image'])) {
            $cover_image = $data['cover_image'];
            $cover_image_path = Storage::put('uploads', $cover_image);
            $post->cover_image = $cover_image_path;
        }
        $post->fill($data);
        $post->slug = Str::slug($data['title']);
        $post->save();

        if (!empty($data['tag_id'])) {
            $post->tags()->sync($data['tag_id']);
        }

        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit', [
            'post' => $post,
            'categories' => $categories,
            'tags' => $tags
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

        $request->$this->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'content' => 'required',
            'cover_img_file' => 'image'
        ]);

        $data = $request->all();

        if (!empty($data['cover_image'])) {
            $cover_image = $data['cover_image'];
            $cover_image_path = Storage::put('uploads', $cover_image);
            $post->cover_image = $cover_image_path;
        }

        $post->update($data);

        if (!empty($data['tag_id'])) {
            $post->tags()->sync($data['tag_id']);
        }

        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // inserisco il controllo per poter cancellare l'immagine
        $post_image = $post->cover_image;
        if (!empty($post_image)) {
            Storage::delete($post_image);
        }
        // controllo se nella collection dei tag c'è qualcosa, e solo in seguito eseguo la delete
        if ($post->tags->isNotEmpty()) {
            $post->tags()->sync([]);
        }
        $post->delete();
        return redirect()->route('admin.posts.index');
    }
}
