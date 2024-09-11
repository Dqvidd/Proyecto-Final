<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadFileController;
use App\Http\Controllers\DownloadFilesController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\Api\FileController;

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

Route::get('/{any}', function () {
    return view('app'); // Redirige todas las rutas a la vista principal
})->where('any', '.*');


Route::get('/api/{path?}', [FileController::class, 'show']);



# Route::get('/','App\Http\Controllers\UploadFileController@firstDir');

# Route::get('/{path}','App\Http\Controllers\UploadFileController@showFiles');

# Route::post("", 'App\Http\Controllers\UploadFileController@showUploadFileVacio');

# Route::post("/{path}", 'App\Http\Controllers\UploadFileController@showUploadFile');

# Route::post('/deletefiles/a', 'App\Http\Controllers\DeleteFilesController@deletefiles');

# Route::post('/downloadfiles/a', 'App\Http\Controllers\DownloadFilesController@downloadfiles');

# Auth::routes();

# Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
