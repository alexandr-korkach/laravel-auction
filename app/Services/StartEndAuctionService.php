<?php

namespace App\Services;

use App\Enums\LotStatus;
use App\Models\Lot;
use Carbon\Carbon;

class StartEndAuctionService
{


    public function __invoke(): void
    {


        $lotsToStart = Lot::query()
            ->where('status', LotStatus::Created)
            ->where('starting_at', '<=', Carbon::now() )
            ->get();

        $lotsToEnd = Lot::query()
            ->where('status', LotStatus::InProgress)
            ->where('starting_at', '<=', Carbon::now()->add(-1, 'day') )
            ->get();

        foreach($lotsToStart as $lot){
            $lot->startAuction($lot);
        }
        foreach($lotsToEnd as $lot){
            $lot->endAuction($lot);
        }

    }








}


