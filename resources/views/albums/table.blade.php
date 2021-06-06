@extends('layouts.backend')
@section('content')

<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Band</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($albums as $key=>$album)
        <tr>
            <td>{{ $albums->firstItem()+$key}}</td>
            <td>{{ $album->name }}</td>
            <td>{{ $album->band->name }}</td>
            {{-- <td>{{ $album->thumbnail }}</td> --}}
            <td>
                <a href="{{ route('albums.edit',$album) }}" class="btn btn-warning btn-sm">Edit</a>
                <div endpoint="{{ route('albums.destroy',$album) }}" class="delete d-inline"></div>
            </td>
        </tr>
        @endforeach
    </tbody>

</table>
{{ $albums->links() }}
@endsection