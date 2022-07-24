<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seguidor extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'seguido_id',
        'seguidor_id'
         ];
//aca sacamos los seguidos y seguidores al visitar un perfil incluyendo el del autenticado ya que el muro se saca contra $user->id y no contra el id del autenticado asi que es indiferente estar autenticado o no
    public function seguidores($user_id){
        $users = DB::table('users')
            ->join('seguidors', 'seguidors.seguidor_id', '=', 'users.id')
            ->select('users.username','users.imagen')
            ->where('seguidors.seguido_id',$user_id)
            ->get();

            return $users;

    }

    public function siguiendo($user_id){
        $users = DB::table('users')
            ->join('seguidors', 'seguidors.seguido_id', '=', 'users.id')
            ->select('users.username','users.imagen')
            ->where('seguidors.seguidor_id',$user_id)
            ->get();

            return $users;

    }

    public function esSeguidor($user_aut,$user_id){
        $user=DB::table('seguidors')
        ->where(['seguido_id'=>$user_id,'seguidor_id'=>$user_aut])
         ->get();

   return $user;


    }

    public function noSeguir($user_aut,$user_id){
        $deleted = DB::table('seguidors')
        ->where(['seguido_id'=>$user_id,'seguidor_id'=>$user_aut])
        ->delete();
    }
}
