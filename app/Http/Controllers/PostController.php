<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() {
        $posts = Post::all();
        return view('posts', ['posts' => $posts]);

    }

    public function show($slug) {
        $post = Post::where('slug', $slug)->first();
        return view('singlepost', ['post' => $post]);
    }

    public function postCategoria($slug) {
        $categoria = Category::where('slug', $slug)->first();
      if (!empty($categoria)) {
          $post_categoria = $categoria->posts;
          return view('single-category', [
              'category' => $categoria,
              'posts' => $post_categoria
          ]);
      }


    }
}
