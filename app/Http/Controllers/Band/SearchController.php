<?php

namespace App\Http\Controllers\Band;

use App\Models\Lyric;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function __invoke(Request $request){
        $keyword=request('keyword');
        if(!$keyword){
            return redirect('/');
        }else{
            $lyrics=Lyric::where('title','like',"%{$keyword}%")
                    ->orWhereHas('band',function($q) use($keyword){
                        return $q->where('name','like',"%{$keyword}%");
                    })
                    ->orWhereHas('album',function($q) use($keyword){
                        return $q->where('name','like',"%{$keyword}%");
                    })                   
                    ->paginate(1);
        return view('search',compact('lyrics','keyword'));
        }
    }
}
