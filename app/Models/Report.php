<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = ['target_id', 'message'];

    public function reporter()
    {
       return $this->belongsTo(User::class, 'reporter_id');
    }

    public function target()
    {
       return $this->belongsTo(User::class, 'target_id');
    }
}
