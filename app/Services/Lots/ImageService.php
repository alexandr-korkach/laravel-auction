<?php

namespace App\Services\Lots;

use App\Models\Image;

class ImageService
{
    public function saveImages(array $images, int $lotId) :array
    {
        $result = [];
        foreach ($images as $imageFile) {
            $image = new Image;
            $path = $imageFile->store('/img/lots/'.$lotId);
            $image->url = $path;
            $image->lot_id = $lotId;
            $image->save();
            $result[] = $image;
        }
        return $result;
    }

}
