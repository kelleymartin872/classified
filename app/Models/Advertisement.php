<?php

namespace App\Models;

use App\Models\City;
use App\Models\User;
use App\Models\State;
use App\Models\Country;
use App\Models\Childcategory;
use Illuminate\Support\Facades\DB;
use Cohensive\OEmbed\Facades\OEmbed;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Advertisement extends Model
{
    use HasFactory;
    // protected $fillable = ['user_id','feature_image','first_image','second_image','category_id','subcategory_id','childcategory_id','name','slug','description','price','price_status','product_condition','listing_location','country_id','state_id','city_id','phone_number','published','link'];
    protected $guarded=[];

    // https://github.com/KaneCohen/oembed
    // public function displayVideoFromLink()
    // {
    //     $embed = $embed = OEmbed::get($this->link);
    //     if(!$embed){
    //         return;
    //     }
    //     // $embed->setAttribute(['width' => 500]);
    //      $embed->html(['width' => 500]);
    //     return $embed->getHtml();
    // }

    public function childcategory()
    {
        return $this->hasOne(Childcategory::class,'id','childcategory_id');
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function state()
    {
        return $this->belongsTo(State::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // save ads
    public function userads()
    {
        return $this->belongsToMany(User::class);
    }
    public function didUserSavedAd()
    {
        return DB::table('advertisement_user')
        ->where('user_id',auth()->user()->id)
        ->where('advertisement_id',$this->id)
        ->first();
    }
    
   public function scopeFirstFourAdsInCaurosel($query,$categoryId)
   {
       return $query->where('category_id', $categoryId)
       ->orderByDesc('id')->take(3)->get();
   }

   public function scopeSecondFourAdsInCaurosel($query,$categoryId)
   {
       $firstAds = $this->scopeFirstFourAdsInCaurosel($query,$categoryId);
       return $query->where('category_id', $categoryId)
       ->whereNotIn('id',$firstAds->pluck('id')->toArray())
        ->take(3)->get();
   }

   //scope method for category electronic

   public function scopeFirstFourAdsInCauroselForElectronic($query,$categoryId)
   {
       return $query->where('category_id', $categoryId)
       ->orderByDesc('id')->take(3)->get();
   }

   public function scopeSecondFourAdsInCauroselForElectronic($query,$categoryId)
   {
       $firstAds = $this->scopeFirstFourAdsInCaurosel($query,$categoryId);
       return $query->where('category_id', $categoryId)
       ->whereNotIn('id',$firstAds->pluck('id')->toArray())
        ->take(3)->get();
   }

 
}

