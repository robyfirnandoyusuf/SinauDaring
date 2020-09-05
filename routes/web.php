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


/*SOAL ROUTES*/
Route::livewire('/', 'user.soal.index')->name('user.soal.index');
Route::livewire('/soal/delete/{kode}', 'user.index')->name('user.delete');
Route::livewire('/soal/create', 'user.soal.create')->name('user.soal.create');
Route::livewire('/soal/edit/{kode}', 'user.soal.edit')->name('user.edit');
Route::livewire('/soal/create-soal', 'user.soal.soal-component')->name('user.create_soal');

/*SCORE ROUTES*/
Route::livewire('/analisis/nilai','user.analysis.index')->name('user.analysis.score');