<?php

namespace App\Http\Controllers\Band;

use App\Models\{Band,Genre};
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\Band\BandRequest;
use Illuminate\Support\Facades\Storage;

class BandController extends Controller
{
    public function table(){
        if(request()->expectsJson()){
            return Band::latest()->get(['id','name']);
        }
        $bands=Band::latest()->paginate(2);
        return view('bands.table',\compact('bands'));
    }
    public function show(Band $band){
        return view('bands.show',compact('band'),['title'=>$band->name]);
    }
    public function create(){
        $genres=Genre::get();
        $band =new Band;
        return view('bands.create',compact('genres','band'),['submitLabel'=>'Create']);
    }
    public function store(BandRequest $request){

        $band=Band::create([
            'name'=>request('name'),
            'slug'=>Str::slug(request('name')),
            'thumbnail'=>\request('thumbnail')?request()->file('thumbnail')->store('images/band'):null
        ]);
        $band->genres()->sync(request('genres'));

        return back()->with('success','band was created');
    }
    public function edit(Band $band){
        $genres=Genre::get();
        return view('bands.edit',compact(['band','genres']),['submitLabel'=>'Update']); 
    }
    
    public function update(Band $band,BandRequest $request){  
     if(request('thumbnail')){
         Storage::delete($band->thumbnail);
         $thumbnail=\request()->file('thumbnail')->store('images/band');
     }elseif($band->thumbnail){
        $thumbnail=$band->thumbnail;
     }else{
         $thumbnail=null;
     }
        $band->update([
            'name'=>request('name'),
            'slug'=>Str::slug(request('name')),
            'thumbnail'=>$thumbnail 
        ]);
        $band->genres()->sync(request('genres'));

        return redirect()->route('bands.table')->with('success','band was updated');
    }
    public function destroy(Band $band){
        Storage::delete($band->thumbnail);
        $band->genres()->detach();
        $band->albums()->delete();
        $band->delete();
    }
    
}
