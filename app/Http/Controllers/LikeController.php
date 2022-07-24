<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
class LikeController extends Controller
{
//creamos el constructor para proteger las rutas al poner esto si tratan de ingresar a una ruta sin autenticar lo devuelve al login
public function __construct(){
    $this->middleware('auth');
 }
    public function meGustas(Request $request,Like $like)
    {
    //este es el id del post
   $id_post=$request->id;
   //este es el id del user autenticado que da me gusta
   $id_usuario_autenticado=auth()->user()->id;
   //aca no hay que aplicar el count ya que viene desde la db alla hice el count y esta me da un int
  $total_me_gusta_del_user=$like->tieneMegusta($id_usuario_autenticado,$id_post);
//si el user tiene me gusta le quitamos el me gusta
if($total_me_gusta_del_user>0){
   $like->eliminarLike($id_usuario_autenticado,$id_post);
   return back()->with('mensaje','');
}else{
    Like::create(
        [
          'user_id'=>$id_usuario_autenticado,
          'post_id'=>$id_post
        ]);
        return back()->with('mensaje','');
}
  
   
    

  
    }
}
