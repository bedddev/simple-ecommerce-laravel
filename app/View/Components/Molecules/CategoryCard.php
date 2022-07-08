<?php

namespace App\View\Components\Molecules;

use Illuminate\View\Component;

class CategoryCard extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

     public $path, $name, $width;

    public function __construct($path, $name, $width = null)
    {
        $this->path = $path;
        $this->name = $name;
        $this->width = $width ?? "100%";
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('client.components.molecules.category-card');
    }
}
