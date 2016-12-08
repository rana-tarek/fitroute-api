<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Place;
use App\Category;
use App\Subcategory;
use App\Facility;
use App\Gallery;
use Validator;
use Image;
use File;

class PlacesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $places = Place::get();
        return view('admin.place.index', compact('places'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        $subcategories = Subcategory::get();
        $facilities = Facility::get();
        return view('admin.place.create', compact('categories', 'subcategories', 'facilities'));
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
        'name' => 'required|unique:places|max:255',
        'rate' => 'required',
        'address' => 'required',
        'working_from' => 'required',
        'working_to' => 'required',
        'subcategory_id' => 'required',
        'facilities' => 'required',
        'latitude' => 'required',
        'longitude' => 'required',
        ]);

        if ($v->fails())
        {
            return redirect()->back()->withInput($request->input())->withErrors($v->errors());
        }
        $inputs = $request->all();
        //dd($inputs);
        $place = new Place($inputs);
        if ($request->hasFile('thumbnail'))
        {
            $place['thumbnail'] = $this->upload($inputs['thumbnail'], $request->file('thumbnail'), 'uploads/places/', 'thumbnail');
        }
        $place->save();
        if ($request->hasFile('gallery'))
        {
            $gallery = $request->file('gallery');
            foreach ($gallery as $image) {
                $image = $this->upload($image, $image, 'uploads/places/', 'gallery');
                $file = new Gallery([
                                    'place_id' => $place->id,
                                    'image' => $image,
                                ]);
                $file->save();
            }
        }
        

        if(count($inputs['facilities']))
            $place->facilities()->attach($inputs['facilities']);
        
        session()->flash('flash_message', 'Place Added!');
        return redirect('places');
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
        $place = Place::findOrFail($id);
        $categories = Category::get();
        $subcategories = Subcategory::get();
        $facilities = Facility::lists('name', 'id');
        return view('admin.place.edit', compact('place', 'categories', 'subcategories', 'facilities'));
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
        'rate' => 'required',
        'address' => 'required',
        'working_from' => 'required',
        'working_to' => 'required',
        'subcategory_id' => 'required',
        'facilities' => 'required',
        'latitude' => 'required',
        'longitude' => 'required'
        ]);

        if ($v->fails())
        {
            return redirect()->back()->withInput($request->input())->withErrors($v->errors());
        }
        
        $place = Place::findOrFail($id);
        $inputs = $request->all();
        
        if ($request->hasFile('thumbnail')) {
                $dir = 'uploads/places/';
                File::delete($dir.$place->thumb);
                $inputs['thumbnail'] = $this->upload($request, $dir);
            }
        $place->update($inputs);
        if(isset($inputs['facilities']) && count($inputs['facilities'])){
            $db_facilities = $place->facilities->lists('id')->toArray();

            foreach ($inputs['facilities'] as $facility) {
                if(in_array($facility, $db_facilities))
                    unset($db_facilities[array_search($facility, $db_facilities)]);
                else
                    $place->facilities()->attach($facility);
            }

            if(!empty($db_facilities))
                $place->facilities()->detach($db_facilities);
        }
        
        session()->flash('flash_message', 'Place updated!');
        return redirect('places');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($id){
            $place = Place::find($id); 
            $dir = 'uploads/places/';
            File::delete($dir.$place->thumbnail);
            $place->delete();
            session()->flash('flash_message', 'Place deleted!');
            return redirect('places');
        }
    }

    // public function upload($request, $dir)
    // {
    //     $inputs = $request->all();
    //     $file_name = date('YmdHis').'.'.$request->file('thumbnail')->getClientOriginalExtension();
    //     $image = Image::make($inputs['thumbnail']->getRealPath());
    //     $image->save($dir.$file_name);
    //     return $file_name;
    // }

    public function upload($image, $file, $dir, $type)
    {
        $file_name = date('YmdHis').'.'.$file->getClientOriginalExtension();
        $image = Image::make($image->getRealPath());
        if($type == 'gallery')
            $image->fit(1000, 560) ->save($dir.'gallery-'.$file_name);
        if($type == 'thumbnail')
            $image->fit(700, 1000) ->save($dir.'thumb-'.$file_name);
        return $file_name;
    }

}
