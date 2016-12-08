<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;
use Validator;
use DB;
use Image;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get();

        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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
        'name' => 'required|unique:categories|max:255',
        'icon' => 'required',
        'description' => 'required',
        ]);

        if ($v->fails())
        {
            return redirect()->back()->withInput($request->input())->withErrors($v->errors());
        }
        $inputs = $request->all();

        $category = new Category($inputs);
        $category->save();

        session()->flash('flash_message', 'Category Added!');
        return redirect('categories');
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
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
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
        'description' => 'required'
        ]);

        if ($v->fails())
        {
            return redirect()->back()->withInput($request->input())->withErrors($v->errors());
        }
        $category = Category::findOrFail($id);
        $inputs = $request->all();
        // if ($request->hasFile('icon')) {
        //         $dir = 'uploads/categories/';
        //         File::delete($dir.$category->icon);
        //         $inputs['icon'] = $this->upload($request, $dir);
        //     }
        $inputs['icon'] = $inputs['name'];
        $category->update($inputs);
        session()->flash('flash_message', 'Category updated!');
        return redirect('categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id); 
        $dir = 'uploads/categories/';
            File::delete($dir.$category->image);
        $category->delete();
        session()->flash('flash_message', 'Category deleted!');
        return redirect('categories');
    }

    public function upload($request, $dir)
    {
        $inputs = $request->all();
        $file_name = date('YmdHis').'.'.$request->file('icon')->getClientOriginalExtension();
        $image = Image::make($inputs['icon']->getRealPath());
        $image->save($dir.$file_name);
        return $file_name;
    }

}
