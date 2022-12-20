<?php

namespace App\Http\Controllers\Lots;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lots\CreateLotRequest;
use App\Http\Requests\Lots\EditLotRequest;
use App\Mail\LotCreate;
use App\Models\Filters\Lot\LotSearch;
use App\Models\Lot;
use App\Services\Lots\ImageService;
use App\Services\Lots\LotsService;
use App\Services\MessageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class LotResourceController extends Controller
{

    private MessageService $messageService;
    private LotsService $lotsService;
    private ImageService $imageService;

    public function __construct
    (
        MessageService $messageService,
        LotsService $lotsService,
        ImageService $imageService
    )
    {

        $this->messageService = $messageService;
        $this->lotsService = $lotsService;
        $this->imageService = $imageService;
        //$this->authorizeResource(Lot::class, 'lot');

    }


    public function index(Request $request, LotSearch $lotSearch)
    {

        $lots = $lotSearch
            ->apply($request)
            ->where('user_id', Auth::user()->id)
            ->latest()
            ->paginate(20)
            ->appends(request()->input());
        $selectedStatus =$request->input('status');
        $search = $request->input('search');
        return view('lots.user.index', compact('lots', 'selectedStatus', 'search'));
    }


    public function create()
    {
        return view('lots.user.create');
    }


    public function store(CreateLotRequest $request)
    {
        $data = array_filter($request->all());
        $data['user_id'] = Auth::user()->id;
        $lot = Lot::create($data);

       $imagesArr = $this->imageService->saveImages($request->file('images'), $lot->id);
       $lot->image_id = $imagesArr[0]->id;
       $lot->save();
       $this->messageService->createLotMessage($lot);

       return redirect()->route('lots.index');

    }


    public function show(Lot $lot)
    {
        return redirect()->route('public.lots.show', $lot);
    }


    public function edit(Lot $lot)
    {
        $this->authorize('update', $lot);
        return view('lots.user.edit', compact('lot'));
    }


    public function update(EditLotRequest $request, Lot $lot)
    {
        $this->authorize('update', $lot);
        $data = array_filter($request->all());
        $lot->update($data);
        $this->messageService->updateLotMessage($lot);
        return redirect()->route('public.lots.show', $lot);
    }


    public function destroy(Lot $lot)
    {
        $this->authorize('update', $lot);
        $this->lotsService->deleteMessages($lot);
        $lot->delete();
        return redirect()->route('lots.index');
    }
}
