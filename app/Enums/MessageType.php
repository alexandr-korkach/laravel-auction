<?php

namespace App\Enums;

enum MessageType :int
{
    case LotCreated = 1;
    case LotUpdated = 3;
    case LotChangeStatus = 5;
    case UserBid = 10;
    case UserRedeemedLot = 15;
    case AuctionEnd = 20;
    case AuctionStart = 25;

    public function textForHtml(): string {
        return match($this) {
            MessageType::LotCreated, MessageType::LotUpdated, MessageType::LotChangeStatus => 'info',
            MessageType::UserBid => 'warning',
            MessageType::AuctionStart => 'primary',
            MessageType::UserRedeemedLot, MessageType::AuctionEnd => 'success',


        };
    }


}
