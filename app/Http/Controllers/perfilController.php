<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Models\User;
use Illuminate\Support\Facades\File;

class perfilController extends Controller
{
   //creamos el constructor para proteger las rutas al poner esto si tratan de ingresar a una ruta sin autenticar lo devuelve al login
public function __construct(){
    $this->middleware('auth');
 }
 public function editarUsuario(Request $request){
   $id_user=$request->id;
   return view('perfil/editar');

 }
 public function actualizarUsuario(Request $request,User $user){
   $this->validate($request,[
     'username'=>['required','unique:users,username,'.auth()->user()->id,'min:3','max:20','not_in:camis,edita'],
     'email'=>['required','unique:users,email,'.auth()->user()->id]
   ]);
 
   
if($request->imagen){
   
   //esto guarda la foto la sube a la carpeta en el proyecto si tiene imagen
   $imagen=$request->file('imagen');
   $nombre_imagen=Str::uuid().".".$imagen->extension();
   $imagen_servidor=Image::make($imagen);
   $imagen_servidor->fit(1000,1000);
   $imagenPath=public_path('foto_perfil').'/'.$nombre_imagen;
   $imagen_servidor->save($imagenPath);
//si viene por aca es por que tiene imagen y debemos borrar la fisica del proyecto para que no se 
//acumulen
$nombre_imagen_en_db=auth()->user()->imagen; 

$imagen_path=public_path('foto_perfil/'.$nombre_imagen_en_db);


//decimos con funcion propia de laravel si existe archivo ejecuta el siguiente codigo esto empezo a generar problema por que ese path apunta a un diretori fotoperfil/ y decia error es dir entnces le dije que debe ser obligatorio que no sea un directorio para que entre a borrar fotos y funciona melo
if(File::exists($imagen_path)&& is_dir($imagen_path)==false){
  unlink($imagen_path);

}

  }

  //actualizamos el usuario en la db
 $user=User::find(auth()->user()->id);
 $user->email=$request->email??auth()->user()->email;
 $user->username=$request->username;
 $user->imagen=$nombre_imagen?? auth()->user()->imagen ??null;
 
$user->save();
return redirect()->route('muro',$user->username);

}
}
