<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Seguidor;
class SeguidorController extends Controller
{
    //
public function seguir(Request $request ,Seguidor $obj_seguidor){

    
    //aca validamos si la persona que ingreso esta siguiendolo y si esta siguiendolo eliminamos de la db seguidores el registro ya que dio dejar de seguir
    $es_seguidor=count($obj_seguidor->esSeguidor($request->seguidor,$request->seguido));

    
    //tire en directo el contador de la consulta ya que solo nececitamos saber si es mayor a 1 es por que ya lo sigue
    if($es_seguidor>0){
       
       $dejar_de_seguir= $obj_seguidor->noSeguir($request->seguidor,$request->seguido);
       return back()->withInput();
    }else{
    
     Seguidor::create([
        'seguido_id'=>$request->seguido,
        'seguidor_id'=>$request->seguidor,
    ]);

    return back()->withInput();
}
}
}
