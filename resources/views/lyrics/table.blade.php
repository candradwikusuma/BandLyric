@extends('layouts.backend',['title'=>$title])
@section('content')
<div id="table-of-lyric" title="{{ $title }}" endpoint="{{ route('lyrics.dataTable') }}"></div>
@endsection