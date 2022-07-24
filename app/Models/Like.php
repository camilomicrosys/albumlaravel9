<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'post_id'
    ];
    

   public function tieneMegusta($id_usuario_autenticado,$post_id){
    $likes = DB::table('likes')
    ->where('user_id', '=', $id_usuario_autenticado)
    ->where('post_id', '=', $post_id)
    ->count();
   // ->get();
    return $likes;
   }
   public function totalMeGusta($id_post){
    $likes = DB::table('likes')
    ->where('post_id', '=', $id_post)
    ->count();
    return $likes;
   }

   public function eliminarLike($id_usuario_autenticado,$post_id){
    $deleted = DB::table('likes')->where('user_id', '=',$id_usuario_autenticado)
    ->where('post_id', '=',$post_id)
    ->delete();
   }
}
