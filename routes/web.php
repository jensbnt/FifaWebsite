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

Route::group(['prefix' => 'players', 'middleware' => 'auth'], function () {
    Route::get('', [
        'uses' => 'PlayerController@getPlayersIndex',
        'as' => 'players.index'
    ]);

    Route::get('view/{id}', [
        'uses' => 'PlayerController@getPlayersView',
        'as' => 'players.view'
    ]);

    Route::post('view/{id}', [
        'uses' => 'TeamController@postTeamPlayerAdd',
        'as' => 'players.view'
    ]);

    Route::get('add', [
        'uses' => 'PlayerController@getPlayersAdd',
        'as' => 'players.add'
    ]);

    Route::post('add', [
        'uses' => 'PlayerController@postPlayersAdd',
        'as' => 'players.add'
    ]);

    Route::get('addfile', [
        'uses' => 'PlayerController@getPlayersAddFile',
        'as' => 'players.addfile'
    ]);

    Route::post('addfile', [
        'uses' => 'PlayerController@postPlayersAddFile',
        'as' => 'players.addfile'
    ]);

    Route::get('edit/{id}', [
        'uses' => 'PlayerController@getPlayersEdit',
        'as' => 'players.edit'
    ]);

    Route::post('edit/{id}', [
        'uses' => 'PlayerController@postPlayersEdit',
        'as' => 'players.edit'
    ]);

    Route::get('delete/{id}', [
        'uses' => 'PlayerController@getPlayersDelete',
        'as' => 'players.delete'
    ]);

    Route::get('top', [
        'uses' => 'PlayerController@getPlayersTop',
        'as' => 'players.top'
    ]);
});

Route::group(['prefix' => 'teams', 'middleware' => 'auth'], function () {
    Route::get('', [
        'uses' => 'TeamController@getTeamsIndex',
        'as' => 'teams.index'
    ]);

    Route::get('view/{id}', [
        'uses' => 'TeamController@getTeamsView',
        'as' => 'teams.view'
    ]);

    Route::post('view/{id}', [
        'uses' => 'TeamController@postTeamsView',
        'as' => 'teams.view'
    ]);

    Route::get('add', [
        'uses' => 'TeamController@getTeamsAdd',
        'as' => 'teams.add'
    ]);

    Route::post('add', [
        'uses' => 'TeamController@postTeamsAdd',
        'as' => 'teams.add'
    ]);

    Route::get('edit/{id}', [
        'uses' => 'TeamController@getTeamsEdit',
        'as' => 'teams.edit'
    ]);

    Route::post('edit/{id}', [
        'uses' => 'TeamController@postTeamsEdit',
        'as' => 'teams.edit'
    ]);

    Route::get('delete/{id}', [
        'uses' => 'TeamController@getTeamsDelete',
        'as' => 'teams.delete'
    ]);

    Route::get('playerview/{id}', [
        'uses' => 'TeamController@getTeamsPlayerView',
        'as' => 'teams.playerview'
    ]);

    Route::post('playerview/{id}', [
        'uses' => 'TeamController@postTeamsPlayerView',
        'as' => 'teams.playerview'
    ]);

    Route::get('addgame/{id}', [
        'uses' => 'TeamController@getTeamsAddGame',
        'as' => 'teams.addgame'
    ]);

    Route::post('addgame/{id}', [
        'uses' => 'TeamController@postTeamsAddGame',
        'as' => 'teams.addgame'
    ]);
});

Auth::routes();

Route::get('login', [
    'uses' => 'SigninController@getLogin',
    'as' => 'auth.signin'
]);

Route::post('login', [
    'uses' => 'SigninController@postLogin',
    'as' => 'auth.signin'
]);

Route::get('register', [
    'uses' => 'SigninController@getRegister',
    'as' => 'auth.register'
]);

Route::post('register', [
    'uses' => 'SigninController@postRegister',
    'as' => 'auth.register'
]);
