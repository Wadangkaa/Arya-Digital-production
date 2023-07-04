<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EventController extends Controller
{
    // show event post
    public static function index(){
        
        return view('manage.events',[
            'events'=>event::all()
            
        ]);

    }
    // open create page
    public static function create(){
        $url="/events";
                return view('forms.events',[
                    'url'=>$url,
            ]);
    }
    //store events
    public static function store(Request $request, Event $event){
        
        $fromFields=$request->validate([
            'title'=>['required', Rule::unique('events','title')],
            'body'=>'required',
            'image'=>'required',
            'end_time'=>'required',
            'start_time'=>['required', 'date', 'before:end_time'],
            

        ]);


        if ($request->hasFile('image')) {
            $uploadedFile = $request->file('image');
            $imageName = $uploadedFile->getClientOriginalName(); // Get the original image name
            $fromFields['image'] = $imageName;
            $uploadedFile->storeAs('public/images', $imageName); // Save the image with its original name in the 'public/images' folder
        }
            $fromFields['created_by']=auth()->user()->id;
            $fromFields['updated_by']=auth()->user()->id;
      event::create($fromFields);

      return redirect('/manage/events');
    }
    // show edit page
    public static function edit(event $event){
        
        $url = '/event/' . $event->id;
        $title="title";
        $image="image";
        $body="body";
       
        
        
        return view('forms.events', ['event'=>$event,
        'url'=>$url,
        'title'=>$title,
         'image'=>$image, 
         'body'=>$body,
         ]);
       
    }
    //update edited event
    public static function update(Request $request, event $event){
        
        $fromFields=$request->validate([
            'title'=>'required',
            'body'=>'required',
           
        ]); 
        if ($request->hasFile('image')) {
            $uploadedFile = $request->file('image');
            $imageName = $uploadedFile->getClientOriginalName(); // Get the original image name
            $fromFields['image'] = $imageName;
            $uploadedFile->storeAs('public/images', $imageName); // Save the image with its original name in the 'public/images' folder
        }
            $fromFields['created_by']=auth()->user()->id;
            $fromFields['updated_by']=auth()->user()->id;
      $event->update($fromFields);
      return redirect('/manage/events');

    }
    public static function destroy(event $event){
        $event->delete();
        return redirect()->back();

    }
}
