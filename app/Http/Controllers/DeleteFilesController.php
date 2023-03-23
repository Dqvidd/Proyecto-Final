<?php
namespace App\Http\Controllers;

use Debugbar;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;


function pathcorrect($path, $file){
    $url = "/root"; //PONER LA RUTA DEL .ENV QUE DEFINIRÉ MÁS TARDE
    $ruta_permitida = $url;
    $realpath = False;
    $realpath = substr($path, 0, strlen($ruta_permitida)) === $ruta_permitida && strpos($path, '..') === false; //Comprueba si la ruta és parte de la ruta absoluta definida (para evitar acceder a rutas no permitidas)

    if($realpath == True){
        $realpath = file_exists("$path/$file"); //Comprobamos si el archivo existe (Por si decide borrar otro archivo)
    }
    $file = escapeshellarg($file); //Saneamos la entrada añadiendo comillas que evitan una posible ejecución de comandos
    $path = escapeshellarg($path);
    
    return $realpath;
}

class DeleteFilesController extends Controller
{
    public function deletefiles(Request $request)
    {
        $file = $request->input('file');
        $path = $request->input('path');
        
        $realpath = pathcorrect($path, $file);

        $url = session('url');
        $url = str_replace("/","+", $url);
        $url = "/" . substr($url, 1); // Borrar el primer "-" y transformarlo a "/"

        if ($realpath == True){
            exec("rm $path/$file"); //Si todo es correcto, podemos ejecutar el comando
        }
        return redirect($url);

    }
}




?>