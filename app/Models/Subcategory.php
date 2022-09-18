<?php

namespace App\Models;

use App\Models\Childcategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subcategory extends Model
{
    use HasFactory;
    protected $fillable = ['name','category_id','slug'];
    
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function childcategories()
    {
        return $this->hasMany(Childcategory::class);
    }
    public function ads()
    {
        return $this->hasMany(Advertisement::class);
    }

}
