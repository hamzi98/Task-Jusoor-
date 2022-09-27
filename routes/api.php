<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;



Route::post('/login',[AdminController::class,'login']);
Route::post('/register',[AdminController::class,'register']);

Route::group(['controller'=>AdminController::class,'prefix'=>'admin','middleware'=>('auth:api')],function(){
  
    Route::get('/logout', 'logout');
    Route::get('/manage', 'quiz');
    Route::get('/fetch', 'fetch_quiz');
    Route::get('/fetch/{id}', 'fetch_quiz_id');
    Route::post('/AddQuiz', 'storeQuiz');
    Route::post('/EditeQuiz', 'updateQuiz');
    Route::DELETE('/delete/{id}', 'destroyQuiz');
    Route::get('/AddQuestion/{id}', 'fetch_question');
    Route::post('/storeQuestion', 'storeQuestion');
    Route::DELETE('/delete-question/{id}', 'destroyQuestion');
    
});


// Guest 
Route::group(['controller'=>GuestController::class,'prefix'=>'guest',],function(){
    Route::get('/show', 'index');
    Route::get('/show/question/{id}', 'question');
    Route::post('/answer/question/{id}', 'answer');
    
});