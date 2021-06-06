<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{HomeController,DashboardController};
use App\Http\Controllers\Band\{BandController,AlbumController,GenreController,LyricController,SearchController};



Auth::routes();

Route::get('/', HomeController::class)->name('home');
Route::get('search',SearchController::class);

Route::middleware('auth')->group(function(){
    Route::get('dashboard',DashboardController::class)->name('dashboard');
    Route::prefix('bands')->group(function(){
        Route::get('create',[BandController::class,'create'])->name('bands.create');
        Route::post('store',[BandController::class,'store'])->name('bands.store');
        Route::get('table',[BandController::class,'table'])->name('bands.table');
        Route::get('{band:slug}',[BandController::class,'show'])->name('bands.show')->withoutMiddleware('auth');
        Route::get('{band:slug}/edit',[BandController::class,'edit'])->name('bands.edit');
        Route::put('{band:slug}/edit',[BandController::class,'update']);
        Route::delete('{band:slug}/delete',[BandController::class,'destroy'])->name('bands.destroy');
    });
    Route::prefix('albums')->group(function(){
        Route::get('create',[AlbumController::class,'create'])->name('albums.create');
        Route::post('create',[AlbumController::class,'store']);
        Route::get('table',[AlbumController::class,'table'])->name('albums.table');
        Route::get('{album:slug}/edit',[AlbumController::class,'edit'])->name('albums.edit');
        Route::put('{album:slug}/edit',[AlbumController::class,'update']);
        Route::delete('{album:slug}/delete',[AlbumController::class,'destroy'])->name('albums.destroy');
        Route::get('/get-album-by-{band}',[AlbumController::class,'getAlbumsByBandId']);
    });
    Route::prefix('genres')->group(function(){
        Route::get('create',[GenreController::class,'create'])->name('genres.create');
        Route::post('create',[GenreController::class,'store']);
        Route::get('table',[GenreController::class,'table'])->name('genres.table');
        Route::get('{genre:slug}',[GenreController::class,'show'])->name('genres.show')->withoutMiddleware('auth');
        Route::get('{genre:slug}/edit',[GenreController::class,'edit'])->name('genres.edit');
        Route::put('{genre:slug}/edit',[GenreController::class,'update']);
        Route::delete('{genre:slug}/delete',[GenreController::class,'destroy'])->name('genres.destroy');
    });
    Route::prefix('lyrics')->group(function(){
        Route::get('create',[LyricController::class,'create'])->name('lyrics.create');
        Route::post('create',[LyricController::class,'store']);
        Route::get('table',[LyricCOntroller::class,'table'])->name('lyrics.table');
        Route::get('data-table',[LyricCOntroller::class,'dataTable'])->name('lyrics.dataTable');
        Route::get('{lyric:slug}',[LyricCOntroller::class,'showEdit'])->name('lyrics.showEdit');
        Route::get('{lyric:slug}/edit',[LyricCOntroller::class,'edit'])->name('lyrics.edit');
        Route::put('{lyric:slug}',[LyricCOntroller::class,'update']);
        Route::delete('{lyric:slug}/delete',[LyricController::class,'destroy'])->name('lyrics.destroy');

    }); 
    
});
Route::get('{band:slug}/{lyric:slug}',[LyricCOntroller::class,'show'])->name('lyrics.show');