<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    //
    public function store(Request $request, User $user, Post $post)
    {
        $request->validate([
            'comentario' => 'required|max:255',
        ]);

        // we cant use User from the route because the user is the owner of the post not the author of the comment
        Comentario::create([
            'post_id' => $post->id,
            'user_id' => auth()->id(),
            'comentario' => $request->comentario,
        ]);

        return back()->with('mensaje', 'Comentario realizado correctamente');
    }
}
