<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auction\BidRequest;
use App\Models\Bid;
use App\Models\Lot;
use App\Services\Bids\BidService;


class BidController extends Controller
{

    private BidService $service;

    public function __construct(BidService $service)
    {
        $this->service = $service;
    }

    public function store(BidRequest $request, Lot $lot){
        $this->authorize('create', [Bid::class, $lot]);
        $this->service->bidCreate($request, $lot);

        return redirect()->back();

    }
}
