<?php

namespace App\Http\Controllers;
use \Crypt;

use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $keyword = $request->get('keyword') ? $request->get('keyword') : '';
        $events = \App\Event::with('categories')->where("name", "LIKE", "%$keyword%")->paginate(10);


        return view('events.index', ['events' => $events]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = \Validator::make($request->all(),[
            
            "name" => "required",
            "description" => "required",
            "time" => "required",
            "location" => "required",
            "link" => "required",
            "date" => "required",
            "stock" => "required",
            "cover" => "required",
        ])->validate();

        $new_event = new \App\Event;
        $new_event->name = $request->get('name');
        $new_event->description = $request->get('description');
        $new_event->time = $request->get('time');
        $new_event->location = $request->get('location');
        $new_event->link = $request->get('link');
        $new_event->date = $request->get('date');
        $new_event->stock = $request->get('stock');
        $new_event->created_by = \Auth::user()->id;

        $cover = $request->file('cover');

        if($cover){
          $cover_path = $cover->store('event-covers', 'public');

          $new_event->cover = $cover_path;
        }

        $new_event->save();
        $new_event->categories()->attach($request->get('categories'));
        return redirect()
        ->route('events.create')->with('status', 'Event successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = \Crypt::decrypt($id);
        $event = \App\Event::findOrFail($id);
        return view('events.show', ['event' => $event]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = \Crypt::decrypt($id);
        $event = \App\Event::findOrFail($id);
        return view('events.edit', ['event' => $event]);
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
        $id = \Crypt::decrypt($id);
        $event = \App\Event::findOrFail($id);
        $event->name = $request->get('name');
        $event->location = $request->get('location');
        $event->link = $request->get('link');
        $event->description = $request->get('description');
        $event->date = $request->get('date');
        $event->time = $request->get('time');
        $event->stock = $request->get('stock');
        $new_cover = $request->file('cover');
        if($new_cover){
            if($event->cover && file_exists(storage_path('app/public/' . $event->cover))){
                \Storage::delete('public/'. $event->cover);
            }
            $new_cover_path = $new_cover->store('event-covers', 'public');
            $event->cover = $new_cover_path;
        }
        $event->updated_by = \Auth::user()->id;
        $event->save();
        $event->categories()->sync($request->get('categories'));
        return redirect()->route('events.edit', ['id'=>Crypt::encrypt($event->id)])->with('status', 'Event successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = \App\Event::findOrFail($id);
        $event->delete();
        return redirect()->route('events.index')->with('status', 'Event moved to trash');
    }
    public function trash(){
        $events = \App\Event::onlyTrashed()->paginate(10);
        return view('events.trash', ['events' => $events]);
    }
    public function restore($id){
        $event = \App\Event::withTrashed()->findOrFail($id);

        if($event->trashed()){
            $event->restore();
            return redirect()->route('events.trash')->with('status', 'Event successfully restored');
        } else {
            return redirect()->route('events.trash')->with('status', 'Event is not in trash');
        }
    }
    public function deletePermanent($id){
        $event = \App\Event::withTrashed()->findOrFail($id);

        if(!$event->trashed()){
          return redirect()->route('events.trash')->with('status', 'Event is not in trash!')->with('status_type', 'alert');
        } else {
          $event->categories()->detach();
          $event->forceDelete();

          return redirect()->route('events.trash')->with('status', 'Event permanently deleted!');
        }
    }
}
