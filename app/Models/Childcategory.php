<?php

namespace App\Models;

use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Childcategory extends Model
{
    use HasFactory;
    protected $fillable = ['name','subcategory_id','slug'];

    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class,'subcategory_id','id');
    }
    public function ads()
    {
        return $this->hasMany(Advertisement::class);
    }
}
