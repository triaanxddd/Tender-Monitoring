<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function demandedGoods(){
        return $this->hasMany(DemandedGoods::class);
    }


    public function user(){
        return $this->belongsToThrough(User::class, DemandedGoods::class);
    }
}
