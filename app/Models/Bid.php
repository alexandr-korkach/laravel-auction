<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;

    public function lot(){
        return $this->belongsTo(Lot::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
