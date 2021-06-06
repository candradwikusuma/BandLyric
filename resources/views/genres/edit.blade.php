@extends('layouts.backend')

@section('content')
@include('alert')
<div class="card">
    <div class="card-header">Edit Genre</div>
    <div class="card-body">
        <form action="{{ route('genres.edit',$genre) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            @include('genres.partials.form-control')
        </form>
    </div>
</div>

@endsection