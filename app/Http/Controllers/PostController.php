<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Listado de posts
    public function index()
    {
        // Obtengo todos los posts
        $posts = Post::all();

        return inertia('Public/Posts', compact('posts'));
    }
    // Mostrar un post
    public function show(Post $post)
    {
        return inertia('Public/Post/PostDetails', compact('post'));
    }
}
