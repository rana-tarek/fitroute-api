<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Event;
use App\Movie;
use Validator;
use Image;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::get();
        return view('admin.event.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $movies = Movie::where('archived', '=', 0)->get();
        return view('admin.event.create', compact('movies'));
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
        'name' => 'required|unique:events|max:255',
        'name_ar' => 'required|unique:events|max:255',
        'image' => 'required',
        'description_en' => 'required',
        'description_ar' => 'required',
        'start_date' => 'required',
        'end_date' => 'required'
        ]);

        if ($v->fails())
        {
            return redirect()->back()->withInput($request->input())->withErrors($v->errors());
        }
        $inputs = $request->all(); 
        $event = new Event($inputs);
        
        if ($request->hasFile('image'))
        {
            $event['image'] = $this->upload($request, 'uploads/events/');
            $event->save();
        }
        else
            $event->save();

        if(count($inputs['movies']))
            $event->movies()->attach($inputs['movies']);

        session()->flash('flash_message', 'Event Added!');
        return redirect('events');
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
        if($id) {
            $event = Event::where('events.id', $id)->with('movies')->first();
            $movies = Movie::select('movies.id', 'movies.title')->where('archived', '=', 0)->get();
            return view('admin.event.edit', compact('event', 'movies'));
        }
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
        'name_ar' => 'required|max:255',
        'description_en' => 'required',
        'description_ar' => 'required',
        'start_date' => 'required',
        'end_date' => 'required'
        ]);

        if ($v->fails())
        {
            return redirect()->back()->withInput($request->input())->withErrors($v->errors());
        }
        
        if($id) {
            $inputs = $request->all();
            $event = Event::findOrFail($id);
            $db_movies = $event->movies->lists('id')->toArray();
            if(isset($inputs['movies']) && count($inputs['movies'])){

                foreach ($inputs['movies'] as $movie) {
                    if(in_array($movie, $db_movies))
                        unset($db_movies[array_search($movie, $db_movies)]);
                    else
                        $event->movies()->attach($movie);
                }

                if(!empty($db_movies))
                    $event->movies()->detach($db_movies);
            }
            else
                $event->movies()->detach($db_movies);

            if ($request->hasFile('image')) {
                $dir = 'uploads/events/';
                File::delete($dir.$event->image);
                File::delete($dir.'image-'.$event->image);
                $inputs['image'] = $this->upload($request, $dir);
            }
            $event->update($inputs);

            session()->flash('flash_message', 'Event updated!');
            return redirect('events');
        }
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
            $event = Event::find($id); 
            $dir = 'uploads/events/';
            File::delete($dir.$event->image);
            File::delete($dir.'image-'.$event->image);
            $event->delete();
            session()->flash('flash_message', 'Event deleted!');
            return redirect('events');
        }
    }

    public function upload($request, $dir)
    {
        $inputs = $request->all();
        $file_name = date('YmdHis').'.'.$request->file('image')->getClientOriginalExtension();
        $image = Image::make($inputs['image']->getRealPath());
        $image->save($dir.$file_name)
            ->fit(700, 1000)
            ->save($dir.'image-'.$file_name);
        return $file_name;
    }
}
