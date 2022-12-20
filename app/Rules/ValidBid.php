<?php

namespace App\Rules;

use App\Models\Lot;
use Illuminate\Contracts\Validation\Rule;

class ValidBid implements Rule
{

    private Lot $lot;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Lot $lot)
    {
        $this->lot = $lot;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if(count($this->lot->bids)){
            $minBid = $this->lot->lastBid->value + $this->lot->min_bid;
            return $value >= $minBid;
        }
        return $value >= $this->lot->starting_price + $this->lot->min_bid;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The bid is to low';
    }


}
