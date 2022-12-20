<?php

namespace App\Services\Bids;


use App\Http\Requests\Auction\BidRequest;
use App\Mail\Outbid;
use App\Models\Bid;
use App\Models\Lot;
use App\Services\MessageService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class BidService
{

    private MessageService $messageService;

    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }


    public function bidCreate(BidRequest $request, Lot $lot)
    {

        if(count($lot->bids) && $lot->lastBid->user_id !== Auth::user()->id)
        {
            Mail::to($lot->lastBid->user)->send(new Outbid($lot));
        }

        $bid = new Bid();
        $bid->value = $request->value;
        $bid->lot_id = $lot->id;
        $bid->user_id = Auth::user()->id;
        $bid->save();
        $lot->refresh();
        $this->messageService->createBidMessage($lot, $bid);

        if($lot->redemption_price && $bid->value >= $lot->redemption_price){
            $lot->endAuction();
        }

    }


}
