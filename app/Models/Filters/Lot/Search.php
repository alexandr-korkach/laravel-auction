<?php
/**
 * Created by PhpStorm.
 * User: note
 * Date: 01.02.2021
 * Time: 22:49
 */

namespace App\Models\Filters\Lot;

use App\Services\Filters\Filterable;
use Illuminate\Database\Eloquent\Builder;

class Search implements Filterable
{

    public static function apply(Builder $builder, $value)
    {
        return $builder->where(function ($query) use ($value) {
            $query->where('title', 'like', '%' . $value . '%');

        });
    }
}
