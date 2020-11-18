<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('start');
});

Route::get('/info', function () {
    return view('info');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('hobby', 'App\Http\Controllers\HobbyController');

Route::resource('tag', 'App\Http\Controllers\TagController');

Route::resource('user', 'App\Http\Controllers\UserController');

Route::get('/hobby/tag/{tag_id}', [App\Http\Controllers\HobbyTagController::class, 'getFilteredHobbies'])->name('hobby_tag');

Route::get('/hobby/{hobby_id}/tag/{tag_id}/attach', [App\Http\Controllers\HobbyTagController::class, 'attachTag'])->name('attach_tag');
Route::get('/hobby/{hobby_id}/tag/{tag_id}/detach', [App\Http\Controllers\HobbyTagController::class, 'detachTag'])->name('detach_tag');
Route::get('/hobby/{hobby_id}/delete-image', [App\Http\Controllers\HobbyController::class, 'deleteImages'])->name('delete_image');
