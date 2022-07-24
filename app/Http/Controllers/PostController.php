<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comentario;
use App\Models\Like;
use App\Models\Seguidor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
//creamos el constructor para proteger las rutas al poner esto si tratan de ingresar a una ruta sin autenticar lo devuelve al login
public function __construct(){
   $this->middleware('auth');
}

public function index(User $user,Seguidor $seguidor){
//para pasar los post del usuario autenticado a la vista
$posts=Post::where('user_id',$user->id)->paginate(4);

//aca es independientemente si el user esta autenticado o no es a quien se visita ya que el muro manda el nombre del usuario y aca sacamos el id del user independientemente de autenticado o no y sacamos los que sigue y los que lo siguen con el inner join en la db
$seguidores=$seguidor->seguidores($user->id);
$total_seguidores=(count($seguidores));
$siguiendo= $seguidor->siguiendo($user->id);
$total_siguiendo=count($siguiendo);
//validamos si el user auth sigue a este usuario 
  //aca validamos si la persona que ingreso esta siguiendolo y si esta siguiendolo eliminamos de la db seguidores el registro ya que dio dejar de seguir
  $usuario_auth_sigue_este_user=count($seguidor->esSeguidor(auth()->user()->id,$user->id));
  //tire en directo el contador de la consulta ya que solo nececitamos saber si es mayor a 1 es por que ya lo sigues_seguidor>0){
   

  return view('dashboard',[
    'user'=>$user,
    'posts'=>$posts,
    'seguidores'=>$seguidores,
    'siguiendos'=>$siguiendo,
    'total_seguidores'=>$total_seguidores,
    'total_siguiendo'=>$total_siguiendo,
    'usuario_auth_sigue_este_user'=>$usuario_auth_sigue_este_user
  ]);
}
public function crearPost(){

  return view('posts/create');
}
public function insertarImagenDb(Request $request){
  $this->validate($request,[
  'titulo'=>'required|max:255',
  'descripcion'=>'required|min:2',
  'imagen'=>'required'

  ]);

  Post::create(
    [
      'titulo'=>$request->titulo,
      'descricion'=>$request->descripcion,
      'imagen'=>$request->imagen,
      'user_id'=>auth()->user()->id
    ]
  );

  return redirect()->route('muro',auth()->user()->username);
}
public function mostrar(Post $post,Comentario $comentario,Like $like){

 $id_post=$post->id;
//consultamos si el usuario tiene likes esta variable me entrega numero
$tiene_like=$like->tieneMegusta(auth()->user()->id,$id_post);
$total_me_gusta_del_post=$like->totalMeGusta($id_post);


//hacemos inner join  contra tabla de usarios post y comentarios sacando la data contra el id del comentario
$info_post = $comentario-> mostrarInfoPostComentariosUser($id_post);
   

     if(count($info_post) !=0){
     //es por   que si hay post y comentarios asociados a este usuario
     $tiene_comentarios="si";
     }else{
      $info_post =$comentario->mostrarInfoPostUser($id_post);

       $tiene_comentarios="no";
     }

 
$data=[
  'info_post'=>$info_post,
  'tiene_comentarios'=>$tiene_comentarios,
  'tiene_like_por_usuario'=>$tiene_like,
  'total_me_gusta_post'=>$total_me_gusta_del_post
  
];

  return view('posts/mostrar',$data);
}

public function eliminarPost(Request $request,Post $post){
  $id_post=$request->id;
  //consultamos la db para traer los datos de este post
  $posts=$post->mostrarPostId($id_post);
$nombre_imagen_en_db=$posts->{'imagen'};
$imagen_path=public_path('uploads/'.$nombre_imagen_en_db);
//decimos con funcion propia de laravel si existe archivo ejecuta el siguiente codigo
if(File::exists($imagen_path)){
  unlink($imagen_path);
  $post->deletePost($id_post);
}
return back()->with('mensaje','Post eliminado corectamente¡¡');
}

}
