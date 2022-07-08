<?php

namespace App\View\Components\Molecules;

use Illuminate\View\Component;

class ProductCard extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

     public $image, $category, $title, $price;

    public function __construct($image, $category, $title, $price)
    {
        $this->image = $image;
        $this->category = $category;
        $this->title = $title;
        $this->price = $price;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('client.components.molecules.product-card');
    }
}
