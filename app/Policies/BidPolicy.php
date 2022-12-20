<?php

namespace App\Policies;

use App\Enums\LotStatus;
use App\Models\Lot;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BidPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    public function create(?User $user, Lot $lot){
        return $user && $user->id !== $lot->user_id && $lot->status === LotStatus::InProgress;
    }
}
