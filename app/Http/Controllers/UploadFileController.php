<?php

namespace App\Http\Controllers;

use Debugbar;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

function show($request){
   $path = "/";
   if ($request != "root"){
      $path .= $request->path();
   } else {
      $path = "/root";
   }
   $path = str_replace("+","/", $path);
   $listDirectories = "ls -d ".$path."/*/ | rev | cut -d'/' -f 2 | rev";
   $listFiles = "ls -p ".$path." | grep -v /";
   $files = array();
   $directories = array();
   exec($listDirectories, $directories);
   exec($listFiles, $files);
   return array($files, $directories, $path);
}

class UploadFileController extends Controller {
   public function showFiles(Request $request) {
      $result = show($request);
      $files = $result[0];
      $directories = $result[1];
      $path = $result[2];
      
      // return view('uploadfilePrueba', ['output' => $output]);
      return view('uploadfilePrueba', compact('files', 'directories', 'path'));
   }
   public function showUploadFile(Request $request) {

      $result = show($request);
      $files = $result[0];
      $directories = $result[1];
      $path = $result[2];
      $file = $request->file('archivo')->storeAs(
        $path,
        $request->file('archivo')->getClientOriginalName(),
        'public'
    );
      
      //return view('uploadfilePrueba', compact('output', 'path'));
      $url = session('url');
      $url = str_replace("/","+", $url);
      $url = "/" . substr($url, 1); // Borrar el primer "-" y transformarlo a "/"

        return redirect($url);

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

   public function firstDir(Request $request){
      $result = show("root");
      $files = $result[0];
      $directories = $result[1];
      $path = $result[2];
      
      // return view('uploadfilePrueba', ['output' => $output]);
      return view('uploadfilePrueba', compact('files', 'directories', 'path'));
   }
   
}
