<?php

#Este controlador de encarga de descargar los archivos al pulsar el botón verde de descarga

namespace App\Http\Controllers;

use Debugbar;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

global $pathusuario; 
$pathusuario = $_ENV['PATHUSUARIO'];

function pathcorrect($path, $file, $validpath){
   #Esta función comprueba primero si la ruta del archivo coincide con la ruta especificada en el archivo .env (para evitar modificaciones en el html y por lo tanto que se puedan borrar archivos) 
   #La función espera la path entera, el nombre del archivo i la path indicada en el .env. Devuelve si, después de las comprobaciones, todo es correcto.

   $realpath = False;
   $realpath = substr($path, 0, strlen($validpath)) === $validpath && strpos($path, '..') === false; //Comprueba si la ruta és parte de la ruta absoluta definida (para evitar acceder a rutas no permitidas)

   if($realpath == True){
       $realpath = file_exists("$path/$file"); //Comprobamos si el archivo existe (Por si decide borrar otro archivo)
   }
  
   return $realpath;
}

class DownloadFilesController extends Controller {
   public function downloadfiles(Request $request) {
     #En esta función, pasándole el request del nombre del archivo y su ruta, descarga usando la función response()->downlaod().
        global $pathusuario;
        $file = $request->input('file');
        $path = $request->input('path');
        $filePath = $path . '/' . $file;

        $pathcorrect = pathcorrect($path, $file, $pathusuario);
        if ($pathcorrect == True){
         return response()->download($filePath);
        }
        return redirect("/");
   } 
}
?>
