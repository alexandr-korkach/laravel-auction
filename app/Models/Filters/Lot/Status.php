<?php


namespace App\Models\Filters\Lot;


use App\Enums\LotStatus;
use App\Services\Filters\Filterable;
use Illuminate\Database\Eloquent\Builder;

class Status implements Filterable
{

    public static function apply(Builder $builder, $value)
    {
        if(array_key_exists($value, LotStatus::VALUES )){
            return $builder->where('status', LotStatus::from(LotStatus::VALUES[$value]));
        }

        return $builder;

    }
}
