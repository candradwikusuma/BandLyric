@extends('layouts.backend')
@section('content')
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>image</th>
            <th>Genres</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($bands as $index=>$band)
        <tr>
            <td>{{ $bands->count() *($bands->currentPage()-1)+$loop->iteration}}</td>
            <td>{{ $band->name }}</td>
            <td><img src="{{ asset('/storage/'.$band->thumbnail) }}" alt="" width="100" height="65"></td>
            {{-- cara implode php --}}
            <td>{{ $band->genres()->get()->implode('name',', ') }}</td>
            {{-- <td>
                @foreach ($band->genres as $item)
                {{ $item->name }},
            @endforeach
            </td> --}}
            <td>
                <a href="{{ route('bands.edit',$band) }}" class="btn btn-warning btn-sm">Edit</a>
                <div endpoint="{{ route('bands.destroy',$band) }}" class="delete d-inline"></div>
            </td>

        </tr>
        @endforeach
    </tbody>
</table>
{{ $bands->links() }}
@endsection