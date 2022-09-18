<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Advertisement;

class MenuController extends Controller
{
    public function menu(){
        // $category = Advertisement::categoryCarId();
        $category = Category::where('name', 'cars')->first();
        $firstAds = Advertisement::where('category_id',$category->id)->orderByDesc('id')->take(3)->get();
        // dd($firstAds);
        $secondsAds = Advertisement::where('category_id', $category->id)
        ->whereNotIn('id',$firstAds->pluck('id')->toArray())
         ->take(3)->get();

         $categoryElectronic = Category::CategoryElectronic();
         $firstAdsForElectronics = Advertisement::FirstFourAdsInCauroselForElectronic($categoryElectronic->id);
         $secondsAdsForElectronics = Advertisement::SecondFourAdsInCauroselForElectronic($categoryElectronic->id);
         // get all categories
         $categories = Category::get();
         $secondsAdsForElectronics = Advertisement::secondFourAdsInCauroselForElectronic(
             $categoryElectronic->id
         );
         $advertisements = Advertisement::latest()->paginate(10);

       return view('index',compact('firstAds','secondsAds','category','categoryElectronic','firstAdsForElectronics','secondsAdsForElectronics',
                    'advertisements',
                    'categories'
                    ));
        // return view('index');
    }
}
