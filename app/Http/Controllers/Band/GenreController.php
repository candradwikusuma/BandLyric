<?php

namespace App\Http\Controllers\Band;

use App\Models\Genre;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Band\GenreRequest;

class GenreController extends Controller
{
    public function table(){
        $genres=Genre::withCount('bands')->latest()->paginate(5);
        return view('genres.table',compact('genres'));
    }
    public function show(Genre $genre){
        $bands=$genre->bands()->latest()->paginate(10);
        return view('genres.show',compact('genre','bands'),['title'=>"{$genre->name}"]);
    }
    public function create(){
        $genre =new Genre;
        return view('genres.create',compact('genre'),['submitLabel'=>'Create']);
    }
    public function store(GenreRequest $request){
        Genre::create([
            'name'=> request('name'),
            'slug'=> Str::slug(request('name'))
        ]);

        return back()->with('success','Genre was created');
    }
    public function edit(Genre $genre){
        return view('genres.edit',compact('genre'),['submitLabel'=>'update']);
    }
    public function update(Genre $genre,GenreRequest $request){
        $genre->update([
            'name'=>request('name'),
            'slug'=>Str::slug(request('name')),
            ]);
            return redirect()->route('genres.table')->with('success','Genre was updated');
    }
    public function destroy(Genre $genre){
        $genre->delete();
    }
    
}
