<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'post_id',
        'comentario'
        
       
    ];
    public function eliminarComentario($id_comentario){
        $deleted = DB::table('comentarios')->where('id', '=',$id_comentario)->delete();
    }
//esta funcion es cuando tienen comentarios y posts ya que son iner join de 3 tablas
    public function mostrarInfoPostComentariosUser($id_post){
        $info_post = DB::table('users')
        ->join('posts', 'posts.user_id', '=', 'users.id')
        ->join('comentarios', 'comentarios.post_id', '=', 'posts.id')
        ->join('users as users_dos', 'comentarios.user_id', '=', 'users_dos.id')
        ->select('users.username as dueno_post','users_dos.username as dueno_comentario','posts.titulo','posts.descricion','posts.imagen','posts.titulo','posts.id as id_post','posts.user_id as posts_user_id',
        'posts.created_at as f_creacion_post','comentarios.id as identificador_comentario','comentarios.comentario', 'comentarios.user_id as comentario_user_id','comentarios.post_id as comentario_post_id','comentarios.created_at as f_creacion_comentario'
        )
        ->where('posts.id', '=', $id_post)
        ->get();

        return $info_post; 


    }
    
    //esta funcion es solo cuando el usuario tiene post pero no hay comentario es inner join usuarios y posts
    public function  mostrarInfoPostUser($id_post){
        $info_post = DB::table('users')
        ->join('posts', 'posts.user_id', '=', 'users.id')
        ->select('users.username as dueno_post','posts.titulo','posts.descricion','posts.imagen','posts.titulo','posts.id as id_post','posts.user_id as posts_user_id',
        'posts.created_at as f_creacion_post'
        )
        ->where('posts.id', '=', $id_post)
        ->get();
        return $info_post;
    }
}
