<?php

namespace App\Http\Controllers\Lots;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lots\AddImageRequest;
use App\Models\Image;
use App\Models\Lot;
use App\Services\Lots\ImageService;
use App\Services\Lots\LotsService;
use App\Services\MessageService;
use Illuminate\Http\Request;

class ImageController extends Controller
{

    private ImageService $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }



    public function store(AddImageRequest $request, Lot $lot){
        $this->imageService->saveImages($request->file('images'), $lot->id);
        return redirect()->back();
    }

    public function delete(Request $request, Lot $lot, Image $image){
        $image->delete();
        return redirect()->back();

    }

    public function makeMain(Request $request, Lot $lot, Image $image){

        $lot->image_id = $image->id;
        $lot->save();
        return redirect()->back();
    }


}
