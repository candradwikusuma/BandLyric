@extends('layouts.base')
@section('baseStyles')
<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection
@section('baseScripts')
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
@endsection
@section('body')
<x-navbar></x-navbar>
<div class="mt-4">
    @yield('content')
</div>
<footer class=" static-bottom mt-5 border-top ">
    <div class="container py-3">
        Lorem ipsum dolor sit amet.
    </div>

</footer>
@endsection