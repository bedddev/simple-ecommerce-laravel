<?php

namespace App\View\Components\Organisms;

use Illuminate\View\Component;

class Footer extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

     public $shop;

    public function __construct($shop)
    {
        $this->shop = $shop;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('client.components.organisms.footer');
    }
}
