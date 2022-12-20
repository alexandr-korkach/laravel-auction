<?php

namespace App\Models;

use App\Enums\LotStatus;
use App\Services\MessageService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lot extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'title',
        'description',
        'starting_price',
        'min_bid',
        'redemption_price',
        'starting_at',
        'user_id'
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function image(){
        return $this->hasOne(Image::class, 'id', 'image_id');
    }

    public function images(){
        return $this->hasMany(Image::class);
    }

    public function bids(){
        return $this->hasMany(Bid::class);
    }
    public function lastBid(){
        return $this->hasOne(Bid::class)->latest();
    }

    public function favorites(){
        return $this->belongsToMany(User::class, 'favorites_lot', 'lot_id', 'user_id');
    }
    public function messages(){
        return $this->hasMany(Message::class);
    }


    protected $casts = [
        'starting_at' => 'datetime',
        'status' => LotStatus::class
    ];

    public function getEndingAtAttribute()
    {
        return $this->starting_at->add(1, 'day');
    }


    public function scopeGetPublicLots($query, $limit = false){
        $result = $query
                    ->with('image')
                    ->where('status', LotStatus::InProgress)
                    ->orWhere('status', LotStatus::Created)
                    ->orderBy('status', 'DESC')
                    ->orderBy('starting_at', 'DESC');
        if($limit){
            $result = $result->limit($limit);
        }
        return $result;
    }



    public function endAuction()
    {
        $this->status = LotStatus::Success;
        $this->save();
        (new MessageService())->endAuction($this);
    }

    public function startAuction()
    {
        $this->status = LotStatus::InProgress;
        $this->save();
        (new MessageService())->startAuction($this);
    }


}
