<?php

namespace App\Models;

use App\Models\Advertisement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fraud extends Model
{
    use HasFactory;
    protected $guarded=[]; 
    public function frauded()
    {
        return $this->belongsTo(Advertisement::class,'ad_id','id');
    }
}
