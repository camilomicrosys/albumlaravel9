<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PruebaController extends Controller
{
    public function pruebaSlot(){
        $nombres=['camilo','cristina','ana','gildardo'];
        $data=[
            'nombres'=>$nombres
        ];
        return view('cualquiera',$data);
}
}