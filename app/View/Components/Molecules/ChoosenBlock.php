<?php

namespace App\View\Components\Molecules;

use Illuminate\View\Component;

class ChoosenBlock extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

     public $icon, $title, $desc, $bg;

    public function __construct($icon, $title, $desc, $bg)
    {
        $this->icon = $icon;
        $this->title = $title;
        $this->desc = $desc;
        $this->bg = $bg;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('client.components.molecules.choosen-block');
    }
}
