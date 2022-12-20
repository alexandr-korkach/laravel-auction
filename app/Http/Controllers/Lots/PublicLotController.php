<?php

namespace App\Http\Controllers\Lots;

use App\Enums\LotStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\PublicSearchRequest;
use App\Models\Filters\Lot\Search;
use App\Models\Lot;
use App\Models\Message;
use Illuminate\Http\Request;

class PublicLotController extends Controller
{
    public function index(){

        $lots = Lot::getPublicLots(12)->get();
        return view('public.index', compact('lots'));
    }

    public function all(){

        $lots = Lot::getPublicLots()->paginate(20);
        return view('public.all-lots', compact('lots'));
    }


    public function show(Lot $lot){

        return view('public.lot', compact('lot'));
    }

    public function search(PublicSearchRequest $request){
        $search = $request->input('search');
        $lots = Lot::getPublicLots()
            ->where('title', 'like', '%' . $search . '%')
            ->paginate(20)
            ->appends(request()->input());;
        return view('public.search', compact('lots', 'search'));
    }


}
