<?php

namespace App\Http\Livewire;
use App\Models\Like;
use Livewire\Component;

class Likess extends Component
{

public $tiene_like_por_usuario;
public $color;
public $idpost;
public $total_likes_por_user;
//esta es la que viene desde la vista normal y que vienen del controlador  la pasamos al este componete por parametro
public $total_me_gusta_post;



public function mount(Like $like){
$this->total_likes_por_user=$like->tieneMegusta(auth()->user()->id,$this->idpost);
if($this->total_likes_por_user>0){
$this->total_likes_por_user;
$this->color="red";

$this->total_me_gusta_post=$like->totalMeGusta($this->idpost);

}else{
    $this->color="white";
    $this->total_likes_por_user;
    $this->total_me_gusta_post;
    $this->total_me_gusta_post=$like->totalMeGusta($this->idpost);
}
}

public function like(Like $like){
    $this->total_likes_por_user=$like->tieneMegusta(auth()->user()->id,$this->idpost);
    if($this->total_likes_por_user>0){
     //eliminamos el dato de la tabla para que ya no quede el me gusta
     $like->eliminarLike(auth()->user()->id,$this->idpost);
    $this->color="white";
    $this->total_me_gusta_post=$like->totalMeGusta($this->idpost);
    }else{
        //si no tiene me gusta lo creamos y le pintamos rojo
        Like::create(
            [
              'user_id'=>auth()->user()->id,
              'post_id'=>$this->idpost
            ]);
        $this->color="red";
        $this->total_me_gusta_post=$like->totalMeGusta($this->idpost);
    }
   
}
    public function render()
    {
        return view('livewire.likess');
    }
}
