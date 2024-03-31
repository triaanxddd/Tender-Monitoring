<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Spatie\Activitylog\LogOptions;

class Task extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    //these commented code bellow is unusable
    //especially can't update attribute when Task model is created, updated, delete
    //this package is turn to be shit smh

    // protected static $logFillable = true;
    // protected static $logAttributes = ['name'];
    // protected static $logOnlyDirty = true;
    // protected static $logName = 'tasks';

    // public function getDescriptionForEvent(string $eventName): string
    // {
    //     return "This model has been {$eventName}";
    // }

    // public function getActivitylogOptions(): LogOptions
    // {
    //     return LogOptions::defaults();
    // }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function uraians(){
        return $this->hasMany(Uraian::class, 'task_id', 'id');
    }

    public function laporans(){
        return $this->hasMany(laporan::class, 'task_id', 'id');
    }

    public function penagihans(){
        return $this->hasMany(Penagihan::class, 'task_id', 'id');
    }

    public function pembuatans(){
        return $this->hasMany(Pembuatan::class, 'task_id', 'id');
    }

    public function pembayarans(){
        return $this->hasMany(Pembayaran::class, 'task_id', 'id');
    }

    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
