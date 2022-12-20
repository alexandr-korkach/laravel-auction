<?php

namespace App\Http\Controllers\Lots;

use App\Http\Controllers\Controller;
use App\Models\Filters\Lot\LotSearch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritesController extends Controller
{
    public function index(Request $request, LotSearch $lotSearch)
    {

        $lots = $lotSearch
            ->apply($request)
            ->whereHas('favorites', function($q){
                $q->where('id', '=', Auth::user()->id);
            })
            ->latest()
            ->paginate(20)
            ->appends(request()->input());
        $selectedStatus =$request->input('status');
        $search = $request->input('search');
        return view('lots.user.favorites', compact('lots', 'selectedStatus', 'search'));
    }
}
