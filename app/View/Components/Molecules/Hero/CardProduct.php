<?php

namespace App\View\Components\Molecules\Hero;

use Illuminate\View\Component;

class CardProduct extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $title, $dataImage;
    public function __construct($title, $dataImage)
    {
        $this->title = $title;
        $this->dataImage = $dataImage;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('client.components.molecules.hero.card-product');
    }
}
