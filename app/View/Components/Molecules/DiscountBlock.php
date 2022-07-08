<?php

namespace App\View\Components\Molecules;

use Illuminate\View\Component;

class DiscountBlock extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

     public $background, $discount, $item, $image;

    public function __construct($background, $discount, $item, $image)
    {
        $this->background = $background;
        $this->discount = $discount;
        $this->item = $item;
        $this->image = $image;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('client.components.molecules.discount-block');
    }
}
