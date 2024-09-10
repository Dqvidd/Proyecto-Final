<?php

#Este controlador se encarga de realizar el borrado de los archivos cuando en la página se pulsa el botón rojo de borrar.

namespace App\Http\Controllers;

use Debugbar;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;


function pathcorrect($path, $file, $validpath){
    #Esta función comprueba primero si la ruta del archivo coincide con la ruta especificada en el archivo .env (para evitar modificaciones en el html y por lo tanto que se puedan borrar archivos) 
    #Y también sanea la entrada para evitar cualquier tipo de inyección de código
    #La función espera la path entera, el nombre del archivo i la path indicada en el .env. Devuelve si, después de las comprobaciones, todo es correcto.

    $realpath = False;
    $realpath = substr($path, 0, strlen($validpath)) === $validpath && strpos($path, '..') === false; //Comprueba si la ruta és parte de la ruta absoluta definida (para evitar acceder a rutas no permitidas)

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
        #Esta función es la que se encarga de borra el archivo indicado y además redirigirte de nuevo a la página en la que estabas.
        #La función espera un request donde incluye la path entera y el nombre del archivo, y te devuelve a la página donde estabas.

        $pathusuario = $_ENV['PATHUSUARIO'];
        $file = $request->input('file');
        $path = $request->input('path');
        $realpath = pathcorrect($path, $file, $pathusuario);

         if ($realpath == True){
            exec("rm \"$path/$file\""); //Si todo es correcto, podemos ejecutar el comando
        }

        $url = substr($path, strlen($pathusuario)); //Resta la path global menos la path del .env, así obtiene la path relativa de la url
        if ($url != "/"){ //Para que cuando solo sea una / no añada +
            $url = "+" . $url;
        }
        
        $url = str_replace("/","+", $url);
        if ($url == "+"){ //Para cuando solo venga un "+" que lo vacíe así redigira a la raiz
            $url = "";
        }
        return redirect($url);

    }
}
?>