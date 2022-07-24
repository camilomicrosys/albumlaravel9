<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
       return view('autenticacion/login');
    }

    public function store(Request $resquest)
    {
     
      
       $this->validate($resquest,[
        'email'=>'required|email|max:60',
        'password'=>'required'

       ]);

 
//rememeber es por si viene con la palomita de recordar contraseña quede recordandola
  if(!auth()->attempt($resquest->only('email','password'),$resquest->remember)){
    //redireccionar y podemos pasar el nombre de la ruta
    return back()->with('mensaje','Credenciales Incorrectas');
  }else{
    return redirect()->route('muro',auth()->user()->username);
  }
   
    }

    public function cerrarSesion(){
        auth()->logout();
        return redirect()->route('login');
    }
}
