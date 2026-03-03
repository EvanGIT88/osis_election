<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\OsisCandidatesController;
use App\Http\Controllers\OsisCandidateTeamsController;
use App\Http\Controllers\VotesController;

Route::get('/', function () {
    return view('welcome');
});
require __DIR__.'/auth.php';
Route::get('/abort', function () {
    return view('abort');
});

Route::middleware(["auth"])->group(function () {
Route::controller(UsersController::class)->group(function () {
    Route::get('/users/index', 'index');
    Route::get('/users/create-page', 'createPage');
    Route::get('/users/update-page/{user}', 'updatePage');
    Route::post('/users/create', 'create');
    Route::delete('/users/delete/{id}', 'delete');
    Route::put('/users/update/{id}', 'update');
});
Route::controller(OsisCandidatesController::class)->group(function () {
    Route::get('/osis-candidates/index', 'index');
    Route::get('/osis-candidates/create-page', 'createPage');
    Route::get('/osis-candidates/update-page/{osisCandidate}', 'updatePage');
    Route::post('/osis-candidates/create', 'create');
    Route::delete('/osis-candidates/delete/{id}', 'delete');
    Route::put('/osis-candidates/update/{id}', 'update');
});
Route::controller(OsisCandidateTeamsController::class)->group(function () {
    Route::get('/osis-candidate-teams/index', 'index');
    Route::get('/osis-candidate-teams/create-page', 'createPage');
    Route::get('/osis-candidate-teams/update-page/{osisCandidateTeam}', 'updatePage');
    Route::post('/osis-candidate-teams/create', 'create');
    Route::delete('/osis-candidate-teams/delete/{id}', 'delete');
    Route::put('/osis-candidate-teams/update/{id}', 'update');
});
Route::controller(VotesController::class)->group(function () {
    Route::get('/votes/index', 'index');
    Route::get('/votes/create-page', 'createPage');
    Route::get('/votes/update-page/{vote}', 'updatePage');
    Route::post('/votes/create ', 'create');
    Route::delete('/votes/delete/{id}', 'delete');
    Route::put('/votes/update/{id}', 'update');

    //user's functions
    Route::get('/pick-page', 'pickPage')->name("pick-page");
     Route::post('/pick/{teamId}', 'pick');

         //statitic's functions
    Route::get('/statistics', 'statisticsPage');
});
});