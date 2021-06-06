@extends('layouts.app' )

@section('content')
<div class="container">
    <img src="{{ $band->picture }}" alt="" class="w-100 rounded-lg mb-4" height="550px"
        style="object-fit: cover ; object-position: center">
    <h3>{{ $band->name }}</h3>
    <div class="mb-4">
        @foreach ($band->genres as $genre)
        <a href="{{ route('genres.show',$genre) }}"><span
                class="badge bg-secondary text-white">{{ $genre->name }}</span></a>
        @endforeach
    </div>
    @foreach ($band->albums()->withCount('lyrics')->with('lyrics','lyrics.band')->latest()->get() as $album)
    {{-- @if ($album->lyrics()->count()) --}}
    @if ($album->lyrics_count)
    <div class="card mb-3">
        <div class="card-header">{{ $album->name }} - {{ $album->year }}</div>
        <div class="card-body">
            @foreach ($album->lyrics as $lyric)
            <a href="{{ route('lyrics.show',[$lyric->band,$lyric]) }}" class="d-block">{{ $lyric->title }}</a>
            @endforeach
        </div>
    </div>
    @endif
    @endforeach
</div>
@endsection