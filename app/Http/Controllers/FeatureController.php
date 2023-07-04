<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class FeatureController extends Controller
{
     // show feature post
     public static function index(){
        
        return view('manage.features',[
            'features'=>feature::all()
            
        ]);

    }
    // open create page
    public static function create(){
        $url="/features";
                return view('forms.features',[
                'url'=>$url, 
            ]);
    }
    //store features
    public static function store(Request $request){
        $fromFields=$request->validate([
            'title'=>['required', Rule::unique('features','title')],
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
      feature::create($fromFields);

      return redirect('/manage/features');
    }
    // show edit page
    public static function edit(feature $feature){
        $url = '/feature/' . $feature->id;
        $title="title";
        $image="image";
        $body="body";
        
        return view('forms.features', ['feature'=>$feature,
        'url'=>$url,
        'title'=>$title,
         'image'=>$image, 
         'body'=>$body, ]);
       
    }
    //update edited feature
    public static function update(Request $request, feature $feature){
        
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
      $feature->update($fromFields);
      return redirect('/manage/features');

    }
    public static function destroy(feature $feature){
        $feature->delete();
        return redirect()->back();

    }
}
