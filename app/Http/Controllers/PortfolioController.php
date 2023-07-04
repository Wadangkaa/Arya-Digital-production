<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PortfolioController extends Controller
{
        // show portfolio post
        public static function index(){
        
            return view('manage.portfolios',[
                'portfolios'=>portfolio::all()
                
            ]);
    
        }
        // open create page
        public static function create(){
            $url="/portfolios";
                    return view('forms.portfolios',[
                    'url'=>$url, 
                ]);
        }
        //store portfolios
        public static function store(Request $request){
            $fromFields=$request->validate([
                'title'=>['required', Rule::unique('portfolios','title')],
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
          portfolio::create($fromFields);
    
          return redirect('/manage/portfolios');
        }
        // show edit page
        public static function edit(portfolio $portfolio){
            $url = '/portfolio/' . $portfolio->id;
            $title="title";
            $image="image";
            $body="body";
            
            return view('forms.portfolios', ['portfolio'=>$portfolio,
            'url'=>$url,
            'title'=>$title,
             'image'=>$image, 
             'body'=>$body, ]);
           
        }
        //update edited portfolio
        public static function update(Request $request, portfolio $portfolio){
            
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
          $portfolio->update($fromFields);
          return redirect('/manage/portfolios');
    
        }
        public static function destroy(portfolio $portfolio){
            $portfolio->delete();
            return redirect()->back();
    
        }
}
