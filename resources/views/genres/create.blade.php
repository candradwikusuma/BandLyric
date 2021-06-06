@extends('layouts.backend')

@section('content')
<div class="card">
    <div class="card-header">New Genre</div>
    <div class="card-body">
        <form action="{{ route('genres.create') }}" method="post" enctype="multipart/form-data">
            @csrf
            @include('genres.partials.form-control')
        </form>
    </div>
</div>

@endsection