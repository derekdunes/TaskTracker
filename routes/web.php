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

// Route::get('/', function () {
	
// 	return view('welcome');

// 	$user = Auth::user();	
// 	if($user){ 
// 		return redirect('home');
// 	}else{
// 		return view('welcome');
// 	}

// });

Route::get('/', 'HomeController@welcome');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home'); 
Route::post('/home', 'HomeController@addTask');
Route::post('/SearchBy', 'HomeController@findTask');
Route::get('/view/{id}', 'HomeController@viewTask');
Route::get('/edit/{id}', 'HomeController@editTask');
Route::get('/delete/{id}', 'HomeController@deleteTask');
Route::post('/updateTask/{id}', 'HomeController@UpdateTask');
Route::get('/createTask', 'HomeController@createNewTask');
Route::post('/creatingTask', 'HomeController@creatingTask');
Route::get('/sortby/pending','HomeController@sortByPending');
Route::get('/sortby/progress','HomeController@sortByProgress');
Route::get('/sortby/completed','HomeController@sortByCompleted');
Route::get('/sortby/lastmodified','HomeController@sortByModified');
Route::get('/get/client/agents/{clientCode}', 'AjaxController@getclientAgents');