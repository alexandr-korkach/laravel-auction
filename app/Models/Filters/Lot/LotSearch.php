<?php


namespace App\Models\Filters\Lot;


use App\Models\Lot;
use App\Services\Filters\BaseSearch;
use App\Services\Filters\Searchable;

class LotSearch implements Searchable
{
    const MODEL = Lot::class;
    use BaseSearch;
}
