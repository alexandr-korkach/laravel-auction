<?php

namespace App\Http\Livewire;

use App\Models\Lot;
use Livewire\Component;

class LotPrice extends Component
{
    public Lot $lot;
    public $messages;
    public $price;
    public $value;

    public function render()
    {
        $this->getPrice();
        $this->getMessage();
        return view('livewire.lot-price');
    }

    private function getPrice(){
        if($this->lot->lastBid){
            $this->price = $this->lot->lastBid->value;

        }else{
            $this->price = $this->lot->starting_price;
        }
        $this->value = $this->price + $this->lot->min_bid;
    }

    private function getMessage(){
        $this->messages = $this->lot->messages()->orderBy('id', 'DESC')->get();
    }

}
