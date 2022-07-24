<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'titulo',
        'descricion',
        'imagen',
        'user_id'
       
    ];

    public function user(){
        //aca decimos que un post pertenece a un usuario
        return  $this->belongsTo(User::class)->select(['name','username']);
    }
    public function mostrarPostId($id_post){
        $post = Post::find($id_post);
        return $post;
    }

    public function deletePost($id_post){
     $deleted = DB::table('posts')->where('id', '=',$id_post)->delete();
        
    }
}
