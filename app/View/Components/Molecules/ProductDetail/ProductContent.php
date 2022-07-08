<?php

namespace App\View\Components\Molecules\ProductDetail;

use Illuminate\View\Component;

class ProductContent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $dataProductContent;
    public function __construct($dataProductContent)
    {
        $this->dataProductContent = $dataProductContent;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('client.components.molecules.product-detail.product-content');
    }
}
