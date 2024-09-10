<?php

#Este controlador se encarga de mostrar tanto los archivos y directorios en pantalla, llamando al view, como subir archivos a la web.

namespace App\Http\Controllers;

use Debugbar;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use function config;

global $pathusuario; 
$pathusuario = $_ENV['PATHUSUARIO'];


function show($path){
   #Esta función devuelve, dada una ruta, un array con los archivos y directorios en orden. 

   global $pathusuario; 
   $pathusuario .= $path;
   $pathusuario = str_replace("+","/", $pathusuario);
   $listDirectories = "ls -d ".$pathusuario."/*/ | rev | cut -d'/' -f 2 | rev";
   $listFiles = "ls -p ".$pathusuario." | grep -v /";
   $files = array();
   $directories = array();
   exec($listDirectories, $directories);
   exec($listFiles, $files);
   return array($files, $directories, $pathusuario);
}

class UploadFileController extends Controller {
   public function showFiles(Request $request) {
      #Esta función muestra los archivos y directorios llamando al view.

      $path = "";
      $path .= $request->path();
      $path = substr($path, 1);
      $result = show($path);
      $files = $result[0];
      $directories = $result[1];
      $path = $result[2];
      
      return view('uploadfile', compact('files', 'directories', 'path'));
   }
   public function showUploadFile(Request $request) {
      #Esta función permite subir archivos a la web. Recibe el archivo, que lo almacena en la ruta deseada, y devuelve la misma página para que se actualice contenido

      global $pathusuario;
      $path = "/";
      $path .= $request->path();
      $pathusuario .= $path;
      $pathusuario = str_replace("+","/", $pathusuario);
      $file = $request->file('archivo')->storeAs(
        $pathusuario,
        $request->file('archivo')->getClientOriginalName(),
        'public'
    );
      return redirect($path);
   }

   public function showUploadFileVacio(Request $request){
     #Esta función permite subir el archivo si te encuentras en la ruta / de la web.  

      global $pathusuario;
      $file = $request->file('archivo')->storeAs(
        $pathusuario,
        $request->file('archivo')->getClientOriginalName(),
        'public'
    );
      return redirect("/");
   }

   public function firstDir(Request $request){ 
      #Esta función permite visualizar los archivos y directorios si te encuentras en la ruta / de la web.  

      $result = show("");
      $files = $result[0];
      $directories = $result[1];
      $path = $result[2];
      return view('uploadfile', compact('files', 'directories', 'path'));
   }
   
}
