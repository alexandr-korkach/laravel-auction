<?php

namespace App\Http\Livewire;

use App\Models\Lot;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FavoritsButton extends Component
{
    public Lot $lot;

    public function render()
    {
        return view('livewire.favorits-button');
    }

    public function toggle(){
        Auth::user()->favorites()->toggle($this->lot->id);
    }
}
