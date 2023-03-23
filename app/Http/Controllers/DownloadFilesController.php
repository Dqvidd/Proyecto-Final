<?php

namespace App\Http\Controllers;

use Debugbar;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;



class DownloadFilesController extends Controller {
   public function downloadfiles(Request $request) {

        $file = $request->input('file');
        $path = $request->input('path');
        $filePath = $path . '/' . $file;
        return response()->download($filePath);


   }


   
}
