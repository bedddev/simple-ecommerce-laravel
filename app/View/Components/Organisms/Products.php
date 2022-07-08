<?php

namespace App\View\Components\Organisms;

use Illuminate\View\Component;

class Products extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

     public $dataProduct;

    public function __construct($dataProduct)
    {
        $this->dataProduct = $dataProduct;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('client.components.organisms.products');
    }
}
