<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandedGoods extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function task(){
        return $this->belongsTo(Task::class, 'task_id', 'id');
    }

    public function goods(){
        return $this->belongsTo(Goods::class, 'goods_id', 'id');
    }

     public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');

    }
}
