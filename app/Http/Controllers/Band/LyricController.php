<?php

namespace App\Http\Controllers\Band;

use App\Models\Band;
use App\Models\Album;
use App\Models\Lyric;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\LyricResource;

class LyricController extends Controller
{
    public function create(){
        return view('lyrics.create',['title' => 'New Lyric']);
    }
    public function store(){
        request()->validate([
            'album'=>'required',
            'band'=>'required',
            'body'=>'required',
            'title'=>'required'
        ]);
        $band=Band::find(request('band'));
        $band->lyrics()->create([
            'title'=>request('title'),
            'slug'=>Str::slug(request('title')),
            'album_id'=>request('album'),
            'body'=>request('body'),
        ]);
       return response()->json(['message'=>'The Lyric was created into band '.$band->name]);
    }
    public function table(){
        return view('lyrics.table',['title'=>'Lyrics']);
    }
    public function dataTable(){
        $bandId=\request('band_id') ;
        $albumId=\request('album_id') ;
        if($bandId && !$albumId){
            $lyrics=Lyric::with('band','album')->where('band_id',$bandId)->latest()->paginate(2);

        }elseif($bandId&&$albumId){
            $lyrics=Lyric::with('band','album')->where('band_id',$bandId)
            ->where('album_id',$albumId)
            ->latest()->paginate(2); 
        }else{
            
            $lyrics=Lyric::with('band','album')->latest()->paginate(10);
        }
        // $lyrics=DB::table('lyrics')
        // ->join('albums','lyrics.album_id','=','albums.id')
        // ->join('bands','lyrics.band_id','=','bands.id');

        return LyricResource::collection($lyrics); 
    }
    public function showEdit(Lyric $lyric){
        return $lyric;
    }
     public function show(Band $band,Lyric $lyric){
        $album=Album::find($lyric->album_id);
        $lyrics=$album->lyrics()->where('id','!=',$lyric->id)->get();
         return view('lyrics.show',compact('lyric','band','lyrics'),['title'=>"{$band->name} - {$lyric->title}"]);
     }
     public function edit(Lyric $lyric){
        return view('lyrics.edit',compact('lyric'),['title'=>"Edit Lyric: {$lyric->title}"]);
    }  
    public function update(Lyric $lyric){
        request()->validate([
            'album'=>'required',
            'band'=>'required',
            'body'=>'required',
            'title'=>'required'
        ]);
        $band=Band::find(request('band'));
        $lyric->update([
            'band_id'=>request('band'),
            'title'=>request('title'),
            'slug'=>Str::slug(request('title')),
            'album_id'=>request('album'),
            'body'=>request('body'),
        ]);
       return response()->json(['message'=>'The Lyric was updated into band '.$band->name]);
    }
    public function destroy(Lyric $lyric){
        $lyric->delete();
        // return response()->json(['message'=>'The lyric was deleted']); 
    }
}
