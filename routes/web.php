<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadFileController;
use App\Http\Controllers\DownloadFilesController;
use App\Http\Controllers\FilesController;

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

Route::get('/','App\Http\Controllers\UploadFileController@firstDir');

Route::get('/{path}','App\Http\Controllers\UploadFileController@showFiles');

Route::post("", 'App\Http\Controllers\UploadFileController@showUploadFileVacio');

Route::post("/{path}", 'App\Http\Controllers\UploadFileController@showUploadFile');

Route::resource('files', 'App\Http\Controllers\FilesController');

Route::post('/deletefiles/a', 'App\Http\Controllers\DeleteFilesController@deletefiles');

Route::post('/downloadfiles/a', 'App\Http\Controllers\DownloadFilesController@downloadfiles');
