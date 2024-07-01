<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;

class PerfilController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [new Middleware('auth')];
    }
    //
    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {
        // modify the request
        // pre-add a modified username so the validate method can handle repeated usernames
        $request->request->add([
            'username' => Str::slug($request->username),
        ]);

        $request->validate([
            'username' => ['required', 'unique:users,username,' . auth()->id(), 'min:3', 'max:20', 'not_in:twitter,editar-perfil'],
        ]);

        if ($request->imagen) {
            $imagen = $request->file('imagen');
            $nombreImagen = Str::uuid() . '.' . $imagen->extension();

            $manager = ImageManager::gd();

            $imagenServidor = $manager->read($imagen);
            $imagenServidor->cover(1000, 1000);

            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;

            $imagenServidor->save($imagenPath);
        }

        // save changes
        $usuario = User::find(auth()->id());
        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
        $usuario->save();

        return redirect()->route('posts.index', $usuario->username);
    }
}
