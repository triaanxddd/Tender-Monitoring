<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembuatan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function task(){
        return $this->belongsTo(Task::class);
    }

    public function deleteFile()
    {
        if ($this->file && Storage::exists($this->file)) {
            Storage::delete($this->file);
        }
    }
}
