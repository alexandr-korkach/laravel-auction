<?php

namespace App\Services\Lots;

use App\Models\Image;
use App\Models\Lot;

class LotsService
{



    public function deleteMessages(Lot $lot): void
    {
        foreach ($lot->messages as $message){
            $message->delete();
        }
    }
}
