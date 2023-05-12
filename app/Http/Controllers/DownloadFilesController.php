<?php

#Este controlador de encarga de descargar los archivos al pulsar el botón verde de descarga

namespace App\Http\Controllers;

use Debugbar;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class DownloadFilesController extends Controller {
   public function downloadfiles(Request $request) {
     #En esta función, pasándole el request del nombre del archivo y su ruta, descarga usando la función response()->downlaod().

        $file = $request->input('file');
        $path = $request->input('path');
        $filePath = $path . '/' . $file;
        return response()->download($filePath);

   } 
}
