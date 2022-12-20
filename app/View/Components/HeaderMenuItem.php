<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class HeaderMenuItem extends Component
{
    public $title;
    public $routeName;
    public $isActive = false;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $routeName)
    {
        $this->title = $title;
        $this->routeName = $routeName;
        if(Route::currentRouteName() == $routeName){
            $this->isActive = true;
        }
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.header-menu-item');
    }
}
