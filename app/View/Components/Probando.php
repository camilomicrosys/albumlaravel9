<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Probando extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

     public $nombres;
    public function __construct($nombres)
    {
        //
        $this->nombres=$nombres;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.probando');
    }
}
