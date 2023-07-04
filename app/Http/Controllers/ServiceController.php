<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ServiceController extends Controller
{
    // show service post
    public static function index(){
        
        return view('manage.services',[
            'services'=>service::all()
            
        ]);

    }
    // open create page
    public static function create(){
        $url="/services";
                return view('forms.services',[
                'url'=>$url, 
            ]);
    }
    //store services
    public static function store(Request $request){
        $fromFields=$request->validate([
            'title'=>['required', Rule::unique('services','title')],
            'body'=>'required',
            'image'=>'required',
        ]);
        if ($request->hasFile('image')) {
            $uploadedFile = $request->file('image');
            $imageName = $uploadedFile->getClientOriginalName(); // Get the original image name
            $fromFields['image'] = $imageName;
            $uploadedFile->storeAs('public/images', $imageName); // Save the image with its original name in the 'public/images' folder
        }
            $fromFields['created_by']=auth()->user()->id;
            $fromFields['updated_by']=auth()->user()->id;
      service::create($fromFields);

      return redirect('/manage/services');
    }
    // show edit page
    public static function edit(service $service){
        $url = '/service/' . $service->id;
        $title="title";
        $image="image";
        $body="body";
        
        return view('forms.services', ['service'=>$service,
        'url'=>$url,
        'title'=>$title,
         'image'=>$image, 
         'body'=>$body, ]);
       
    }
    //update edited service
    public static function update(Request $request, service $service){
        
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
      $service->update($fromFields);
      return redirect('/manage/services');

    }
    public static function destroy(service $service){
        $service->delete();
        return redirect()->back();

    }
}
