@extends('layouts.backend',['title'=>$title])
@section('content')
<div id="edit-lyric" title="{{ $title }}" endpoint="{{ route('lyrics.showEdit',$lyric) }}"></div>
@endsection