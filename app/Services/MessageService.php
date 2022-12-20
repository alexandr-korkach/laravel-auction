<?php

namespace App\Services;

use App\Mail\AuctionEnd;
use App\Mail\AuctionStart;
use App\Mail\AuctionWinner;
use App\Mail\BetPlaced;
use App\Mail\LotCreate;
use App\Models\Bid;
use App\Models\Lot;
use App\Enums\MessageType;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MessageService
{
    private function saveMessage(Lot $lot, MessageType $type, string $text){

        $message = new Message();
        $message->type = $type;
        $message->text = $text;
        $message->lot_id = $lot->id;
        $message->save();

    }

    public function createLotMessage(Lot $lot){
        $dt = $lot->starting_at->format('d.m.Y'). " at " . $lot->starting_at->format('h:i');
        $text = "User " . $lot->user->name . " create lot <a href=\"" . route('public.lots.show', $lot) . "\">". $lot->title ."</a>.
                Starting price - " . ($lot->starting_price ?? 1) . ". Auction will start on $dt.";
        Mail::to(Auth::user())->send(new LotCreate($lot));
        $this->saveMessage($lot, MessageType::LotCreated, $text);

    }
    public function updateLotMessage(Lot $lot){
        $dt = $lot->starting_at->format('d.m.Y'). " at " . $lot->starting_at->format('h:i');
        $text = "User " . $lot->user->name . " update lot <a href=\"" . route('public.lots.show', $lot) . "\">". $lot->title ."</a>.
                Starting price - " . ($lot->starting_price ?? 1) . ". Auction will start on $dt.";

        $this->saveMessage($lot, MessageType::LotUpdated, $text);

    }



    public function createBidMessage(Lot $lot, Bid $bid){

        $text = "User " . $bid->user->name . " bid - ". $bid->value ."$ to lot <a href=\"" . route('public.lots.show', $lot) . "\">". $lot->title ."</a>.";
        Mail::to(Auth::user())->send(new BetPlaced($lot));

        $this->saveMessage($lot, MessageType::UserBid, $text);

    }

    public function endAuction(Lot $lot){

        if(count($lot->bids)){
            $text = "The auction  <a href=\"" . route('public.lots.show', $lot) . "\">". $lot->title ."</a> has ended. Residual price of the lot - " . $lot->lastBid->value;
            Mail::to($lot->lastBid->user)->send(new AuctionWinner($lot));
        }else{
            $text = "The auction  <a href=\"" . route('public.lots.show', $lot) . "\">". $lot->title ."</a> has ended without buyer";
        }

        Mail::to($lot->user)->send(new AuctionEnd($lot));
        $this->saveMessage($lot, MessageType::AuctionEnd, $text);

    }

    public function startAuction(Lot $lot){
        $text = "Auction  <a href=\"" . route('public.lots.show', $lot) . "\">". $lot->title ."</a> has started";
        $this->saveMessage($lot, MessageType::AuctionStart, $text);
        Mail::to($lot->user)->send(new AuctionStart($lot));


    }




}



