<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Advertisement;
use App\Http\Controllers\Controller;

class AdminlistingController extends Controller
{
    public function index()
    {
        $ads = Advertisement::latest()->paginate(50);
        return view('admin.listing.index',compact('ads'));
    }
}
