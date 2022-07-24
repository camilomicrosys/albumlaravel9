<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Comentario;
use Illuminate\Http\Request;




class ComentarioController extends Controller
{
    public function crear(Post $post,Request $request){
  
    $id_post=$post->id;
    $id_user=auth()->user()->id;
    
    $this->validate($request,[
        'comentario'=>'required|max:255',
        
     ]);
     Comentario::create(
        [
          'user_id'=>$id_user,
          'post_id'=>$id_post,
          'comentario'=>$request->comentario,
          
        ]
      );
    
      return back()->with('mensaje','comentario agregado correctamente');


    }
   public function eliminarComentario(Request $request,Comentario $comentario){
    $id_comentario=$request->id;
    $delete=$comentario->eliminarComentario($id_comentario);
    return back()->with('mensaje','Comentario elimiando exitosamente¡¡¡');
   }

}
