@extends('layouts.backend')
@push('scripts')
<script>
    $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
</script>
@endpush
@section('content')
@include('alert')
<div class="card">
    <div class="card-header">New Band</div>
    <div class="card-body">
        <form action="{{ route('bands.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @include('bands.partials.form-control')
        </form>
    </div>
</div>

@endsection