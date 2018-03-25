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

Route::get('/', function () {
    return view('pages.index');
})->name('pages.index');

Route::group(['prefix' => 'players'], function () {
    Route::get('', [
        'uses' => 'PlayerController@getPlayersIndex',
        'as' => 'players.index'
    ]);

    Route::get('view/{id}', [
        'uses' => 'PlayerController@getPlayersView',
        'as' => 'players.view'
    ]);

    Route::post('view/{id}', [
        'uses' => 'PlayerController@postPlayersView',
        'as' => 'players.view'
    ]);
});

Route::group(['prefix' => 'teams'], function () {
    Route::get('', [
        'uses' => 'TeamController@getTeamsIndex',
        'as' => 'teams.index'
    ]);

    Route::post('add', [
        'uses' => 'TeamController@postTeamsAdd',
        'as' => 'teams.add'
    ]);

    Route::post('delete', [
        'uses' => 'TeamController@postTeamsDelete',
        'as' => 'teams.delete'
    ]);

    Route::post('playerdelete', [
        'uses' => 'TeamController@postTeamPlayerDelete',
        'as' => 'teams.playerdelete'
    ]);

    Route::get('view/{id}', [
        'uses' => 'TeamController@getTeamsView',
        'as' => 'teams.view'
    ]);
});