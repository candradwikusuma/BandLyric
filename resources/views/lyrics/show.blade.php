@extends('layouts.app')
@section('content')
<div class="container">
    <img class="w-100 rounded-lg mb-3" height="500" style="object-fit: cover; object-position: top"
        src="{{ $band->picture }}" alt="{{ $band->name }}">
    <div class="row">
        <div class="col-md-8">
            <h3 class="mb-4">{{ $band->name }} - <span class="text-secondary">{{ $lyric->title }}</span></h3>
            <div>{!! nl2br($lyric->body) !!}</div>
        </div>
        <div class="col-md-4">
            <h3 class="mb-4">The same albums </h3>
            @foreach ($lyrics as $item)
            <a href="{{ route('lyrics.show',[$band,$item]) }}" class="d-block">{{ $item->title }}</a>
            @endforeach
        </div>
    </div>
</div>
@endsection