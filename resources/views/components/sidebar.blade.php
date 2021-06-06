<div class="list-group mb-3">
    <a href="/dashboard" class="list-group-item list-group-item-action">Dashboard</a>
    <a href="{{ route('home') }}" class="list-group-item list-group-item-action">Home</a>

</div>
<div class="mb-3">
    <small class="text-secondary d-block mb-2 text-uppercase">Band</small>
    <div class="list-group">
        <a href="{{ route('bands.create') }}" class="list-group-item list-group-item-action">Create</a>
        <a href="{{ route('bands.table') }}" class="list-group-item list-group-item-action">Table</a>

    </div>
</div>
<div class="mb-3">
    <small class="text-secondary d-block mb-2 text-uppercase">Album</small>
    <div class="list-group">
        <a href="{{ route('albums.create') }}" class="list-group-item list-group-item-action">Create</a>
        <a href="{{ route('albums.table') }}" class="list-group-item list-group-item-action">Table</a>

    </div>
</div>
<div class="mb-3">
    <small class="text-secondary d-block mb-2 text-uppercase">Genre</small>
    <div class="list-group">
        <a href="{{ route('genres.create') }}" class="list-group-item list-group-item-action">Create</a>
        <a href="{{ route('genres.table') }}" class="list-group-item list-group-item-action">Table</a>

    </div>
</div>
<div class="mb-3">
    <small class="text-secondary d-block mb-2 text-uppercase">Lyric</small>
    <div class="list-group">
        <a href="{{ route('lyrics.create') }}" class="list-group-item list-group-item-action">Create</a>
        <a href="{{ route('lyrics.table') }}" class="list-group-item list-group-item-action">Table</a>

    </div>
</div>