<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\Comentario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function index()
    {
        return view('autenticacion/registrar');
    }
    public function inicioApp()
    {

        $posts = DB::table('posts') ->orderBy('posts.created_at', 'desc')->paginate(8);


        $data = [
            'posts' => $posts

        ];

        return view('principal', $data);
    }



    public function agregarUsuario(Request $request)
    {
        //validar formulario
        $this->validate($request, [
            'name' => 'required|min:5',
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed'
        ]);

        //agregando el usuario despues de validar

        User::create([
            'name' => $request->name,
            'username' => Str::lower($request->username),
            'email' => $request->email,
            'password' => Hash::make($request->password)

        ]);
        //Autenticamos al usuario inmediatamente lo creamos para enviarlo al muro
        /*
     auth()->attempt([
        'email'=>$request->email,
        'password'=>$request->password
     ]);
     */
        auth()->attempt($request->only('email', 'password'));
        //redireccionar y podemos pasar el nombre de la ruta
        return redirect()->route('muro', auth()->user()->username);
    }
}
