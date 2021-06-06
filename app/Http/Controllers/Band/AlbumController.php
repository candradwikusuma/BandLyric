<?php

namespace App\Http\Controllers\Band;

use Illuminate\Support\Str;
use App\Models\{Band,Album};
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Band\AlbumRequest;

class AlbumController extends Controller
{
    public function table(){
        $albums=Album::with('band')->latest()->paginate(10);
        


        // $albums=DB::table('albums')->get();
        // $albums=DB::table('albums')->join('bands','albums.band_id','=','bands.id')->paginate(2);
         return view('albums.table',compact('albums'));
    }
    public function create(){
        $bands =Band::get();
        $album= New Album;
        return view('albums.create',compact('bands','album'),['title'=>'new Album','submitLabel'=>'create']);
    }
    public function store(AlbumRequest $request){
    
            $band=Band::find(\request('band'));
        Album::create([
            'name'=>\request('name'),
            'slug'=>Str::slug(request('name')),
            'year'=>\request('year'),
            'band_id'=>\request('band'),
        ]);
       return back()->with('status','Album was created into '.$band->name);
    }
    public function edit(Album $album){
        $bands=Band::get();
        return view('albums.edit',compact('album','bands'),['title'=>"Edit Album: {$album->name}",'submitLabel'=>'Update']);
    }
    public function update(Album $album,AlbumRequest $request){
            
            $album->update([
            'name'=>\request('name'),
            'slug'=>Str::slug(request('name')),
            'year'=>\request('year'),
            'band_id'=>\request('band'),
        ]);
       return redirect()->route('albums.table')->with('success','Album was updated');
    }
    public function getAlbumsByBandId(Band $band){
            return $band->albums;
    }
    public function destroy(Album $album){
          $album->delete();
    }
}
