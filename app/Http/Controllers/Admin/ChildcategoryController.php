<?php

namespace App\Http\Controllers\Admin;

use App\Models\Subcategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Childcategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChildcategoryFormRequest;

class ChildcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $childcategories = Childcategory::latest()->orderBy('subcategory_id')->paginate(10);
        return view('admin.childcategory.view',compact('childcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subcategories = Subcategory::latest()->get();
        return view('admin.childcategory.create',compact('subcategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ChildcategoryFormRequest $request)
    {
        $slug = Str::slug($request->name);
        Childcategory::create([
            'subcategory_id'=>$request->subcategory_id,
            'name'=>$request->name,
            'slug'=>$slug,
        ]);
        return redirect()->back()->with('success','Childcategory created successfully');
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
        $childcategory = Childcategory::find($id);
        $subcategories = Subcategory::latest()->get();
        return view('admin.childcategory.edit',compact('childcategory','subcategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required|unique:childcategories,name,'.$id,
            'subcategory_id'=>'required',
        ]);
        Childcategory::find($id)->update([
            'name'=>$request->name,
            'subcategory_id'=>$request->subcategory_id,
        ]);
        return redirect()->route('childcategory.view')->with('success','Childcategory updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Childcategory::find($id)->delete();
        return redirect()->back()->with('success','Childcategory deleted successfully');
    }
}
