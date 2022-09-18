<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaveAdController extends Controller
{
    public function saveAd(Request $request)
    {
        $ad = Advertisement::find($request->adId);
        $ad->userads()->syncWithOutDetaching($request->userId);

    }
    public function getMyads()
    {
        $advertisementId = DB::table('advertisement_user')
        ->where('user_id',auth()->user()->id)
        ->pluck('advertisement_id');
        $ads = Advertisement::whereIn('id', $advertisementId)->get();
        return view('seller.saved-ads',compact('ads'));
    }
    public function removeAd(Request $request)
    {
        DB::table('advertisement_user')->where('user_id',auth()->id())
		->where('advertisement_id',$request->adId)->delete();
		return back()->with('success','Ad removed form the save list');
    }
}
