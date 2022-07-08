<?php

namespace App\View\Components\Organisms;

use Illuminate\View\Component;

class Category extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

     public $dataCategory;

    public function __construct($dataCategory)
    {
        $this->dataCategory = $dataCategory;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('client.components.organisms.category');
    }
}
