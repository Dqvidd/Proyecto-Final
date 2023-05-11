<?php

namespace App\Http\Controllers;

use Debugbar;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use function config;

global $pathusuario; 
$pathusuario = $_ENV['PATHUSUARIO'];


function show($path){
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
      $path = "/";
      $path .= $request->path();
      $result = show($path);
      $files = $result[0];
      $directories = $result[1];
      $path = $result[2];
      
      // return view('uploadfilePrueba', ['output' => $output]);
      return view('uploadfilePrueba', compact('files', 'directories', 'path'));
   }
   public function showUploadFile(Request $request) {
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

      //Display File Name
/*       echo 'File Name: '.$file->getClientOriginalName();
      echo '<br>';
   
      //Display File Extension
      echo 'File Extension: '.$file->getClientOriginalExtension();
      echo '<br>';
   
      //Display File Real Path
      echo 'File Real Path: '.$file->getRealPath();
      echo '<br>';
   
      //Display File Size
      echo 'File Size: '.$file->getSize();
      echo '<br>';
   
      //Display File Mime Type
      echo 'File Mime Type: '.$file->getMimeType(); */
   
      //Move Uploaded File
      // $destinationPath = '/root';
      //Antiguo upload $file->move($destinationPath,$file->getClientOriginalName());
   }

   public function showUploadFileVacio(Request $request){
      global $pathusuario;
      $file = $request->file('archivo')->storeAs(
        $pathusuario,
        $request->file('archivo')->getClientOriginalName(),
        'public'
    );
      return redirect("/");
   }

   public function firstDir(Request $request){ 
      $result = show("/");
      $files = $result[0];
      $directories = $result[1];
      $path = $result[2];
      
      // return view('uploadfilePrueba', ['output' => $output]);
      return view('uploadfilePrueba', compact('files', 'directories', 'path'));
   }
   
}
