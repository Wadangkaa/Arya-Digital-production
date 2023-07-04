<?php

namespace App\Http\Controllers;

use auth;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BlogController extends Controller
{
    // show blog post
    public static function index(){
        
        return view('manage.blogs',[
            'blogs'=>blog::all()
            
        ]);

    }
    // open create page
    public static function create(){
        $url="/blogs";
                return view('forms.blogs',[
                'url'=>$url, 
            ]);
    }
    //store blogs
    public static function store(Request $request){
        $fromFields=$request->validate([
            'title'=>['required', Rule::unique('blogs','title')],
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
      Blog::create($fromFields);

    return redirect('/manage/blogs');
    }
    // show edit page
    public static function edit(Blog $blog){
        $url = '/blog/' . $blog->id;
        $title="title";
        $image="image";
        $body="body";
        
        return view('forms.blogs', ['blog'=>$blog,
        'url'=>$url,
        'title'=>$title,
         'image'=>$image, 
         'body'=>$body, ]);
       
    }
    //update edited blog
    public static function update(Request $request, Blog $blog){
        
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
      $blog->update($fromFields);
      return redirect('/manage/blogs');

    }
    public static function destroy(Blog $blog){
        $blog->delete();
        return redirect()->back();

    }

}
