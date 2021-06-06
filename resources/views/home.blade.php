@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @foreach ($bands as $band)
        <div class="col-md-4">
            <div class="card mb-4">
                <img style="object-fit:cover; object-position:center" src="{{ $band->picture }}" alt="{{ $band->name }}"
                    class="card-img-top" height="230px">
                <div class="card-body">
                    <a href="{{ route('bands.show',$band) }}">
                        {{ $band->name }}
                    </a>
                    <div>
                        {{ $band->album->name }}
                    </div>
                </div>

            </div>

        </div>
        @endforeach
    </div>
    {{ $bands->links() }}
</div>
@endsection