<?php

namespace App\View\Components\Molecules\ProductDetail;

use Illuminate\View\Component;

class ProductImages extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $dataProductimages;
    public function __construct($dataProductimages)
    {
        $this->dataProductimages = $dataProductimages;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('client.components.molecules.product-detail.product-images');
    }
}
