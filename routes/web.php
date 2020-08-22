<?php

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

// Route::resource('soal','User\SoalController');
// Route::get('/','User\SoalController@index');
// Route::resource('soal','User\SoalController');

// Route::group(['prefix' => 'soal'], function () {
// });

Route::livewire('/', 'user.index')->name('user.soal.index');
Route::livewire('/soal/create', 'user.create')->name('user.soal.create');
Route::livewire('/soal/edit/{kode}', 'user.edit')->name('user.edit');

Route::livewire('/soal/create-soal', 'user.soal-component')->name('user.create_soal');

// Route::livewire('/create', 'user.create')->name('user.create');
// Route::livewire('/edit/{id}', 'user.edit')->name('user.edit');
