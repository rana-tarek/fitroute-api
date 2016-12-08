<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Subcategory;
use App\Category;
use App\Facility;
use Validator;

class SubcategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories = Subcategory::get();
        return view('admin.subcategory.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        $facilities = Facility::get();
        return view('admin.subcategory.create', compact('categories', 'facilities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
        'name' => 'required|unique:subcategories|max:255',
        'category_id' => 'required',
        'facilities' => 'required'
        ]);

        if ($v->fails())
        {
            return redirect()->back()->withInput($request->input())->withErrors($v->errors());
        }
        $inputs = $request->all();

        $subcategory = new Subcategory($inputs);
        $subcategory->save();

        if(count($inputs['facilities']))
            $subcategory->facilities()->attach($inputs['facilities']);
        
        session()->flash('flash_message', 'Subcategory Added!');
        return redirect('subcategories');
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
        $subcategory = Subcategory::findOrFail($id);
        $categories = Category::get();
        $facilities = Facility::lists('name', 'id');
        return view('admin.subcategory.edit', compact('subcategory', 'categories', 'facilities'));
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
        $v = Validator::make($request->all(), [
        'name' => 'required|max:255',
        'category_id' => 'required',
        'facilities' => 'required'
        ]);

        if ($v->fails())
        {
            return redirect()->back()->withInput($request->input())->withErrors($v->errors());
        }
        $subcategory = Subcategory::findOrFail($id);
        $inputs = $request->all();
        $subcategory->update($inputs);
        if(isset($inputs['facilities']) && count($inputs['facilities'])){
            $db_facilities = $subcategory->facilities->lists('id')->toArray();

            foreach ($inputs['facilities'] as $facility) {
                if(in_array($facility, $db_facilities))
                    unset($db_facilities[array_search($facility, $db_facilities)]);
                else
                    $subcategory->facilities()->attach($facility);
            }

            if(!empty($db_facilities))
                $subcategory->facilities()->detach($db_facilities);
        }
        session()->flash('flash_message', 'Subcategory updated!');
        return redirect('subcategories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subcategory = Subcategory::find($id);   
        $subcategory->delete();
        session()->flash('flash_message', 'Subcategory deleted!');
        return redirect('subcategories');
    }

}
