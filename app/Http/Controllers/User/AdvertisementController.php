<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Advertisement;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdsFormRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\AdsFormUpdateRequest;

class AdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ads = Advertisement::latest()->where('user_id', auth()->user()->id)->paginate(10);
        return view('user.ads.view',compact('ads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = Category::with('subcategories')->get();
        return view('user.ads.create',compact('menus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdsFormRequest $request)
    {
        $data = $request->all();
        $featureImage = $request->file('feature_image')->store('public/category');
        $firstImage = $request->file('first_image')->store('public/category');
        $secondImage = $request->file('second_image')->store('public/category');
        $data['feature_image'] =  $featureImage;
        $data['first_image'] =  $firstImage;
        $data['second_image'] =  $secondImage;
        $data['slug'] =  Str::slug($request->name);
        $data['user_id'] = auth()->user()->id;

        Advertisement::create($data);
        return redirect()->route('user.ads.view')->with('message','Your ad was created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ad = Advertisement::find($id);
        $this->authorize('edit-ad',$ad);
        return view('user.ads.edit',compact('ad'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdsFormUpdateRequest $request, $id)
    {
        $ad = Advertisement::find($id);
        $featureImage = $ad->feature_image;
        $firstImage = $ad->first_image;
        $secondImage = $ad->second_image;
        $data = $request->all();
        if ($request->hasFile('feature_image')) {
            $featureImage = $request->file('feature_image')->store('public/category');
        }
        if ($request->hasFile('first_image')) {
            $firstImage = $request->file('first_image')->store('public/category');
        }
        if ($request->hasFile('second_image')) {
            $secondImage = $request->file('second_image')->store('public/category');
        }
        $data['feature_image'] = $featureImage;
        $data['first_image'] = $firstImage;
        $data['second_image'] = $secondImage;

        $ad->update($data);
        return redirect()->route('user.ads.view')->with('success','Your ad was updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ad = Advertisement::find($id);
        $ad->delete();
        return redirect()->back()->with('success','Listing deleted successfully');
    }
    public function pendingAds()
    {
        $ads = Advertisement::where('user_id',auth()->user()->id)->where('published',0)->get();
        return view('user.ads.pending', compact('ads'));
    }
    public function viewUserAds($id)
    {
        $advertisements = Advertisement::latest()->where('user_id',$id)->paginate(20);
        $user = User::find($id);
        return view('seller.ads',compact('advertisements','user'));
    }
}
