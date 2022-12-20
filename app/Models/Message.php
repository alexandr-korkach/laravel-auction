<?php

namespace App\Models;

use App\Enums\MessageType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
       'type' => MessageType::class,
    ];

    public function lot(){
        return $this->belongsTo(Lot::class);
    }
    public function bid(){
        return $this->belongsTo(Bid::class);
    }
}
