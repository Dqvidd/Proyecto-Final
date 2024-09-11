<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class FileController extends Controller
{
    // Hacer que $path sea opcional asignándole un valor por defecto
    public function show($path = null): JsonResponse
    {
        // Definir la ruta predeterminada desde la variable de entorno
        $pathusuario = env('PATHUSUARIO');

        // Si se proporciona un path, concatenarlo con el path predeterminado
        if ($path) {
            $pathusuario .= $path;
            $pathusuario = str_replace("+", "/", $pathusuario);
        }

        // Listar directorios y archivos
        $listDirectories = "ls -d " . escapeshellarg($pathusuario) . "/*/ | rev | cut -d'/' -f 2 | rev";
        $listFiles = "ls -p " . escapeshellarg($pathusuario) . " | grep -v /";

        $files = [];
        $directories = [];

        // Ejecutar los comandos y llenar los arrays
        exec($listDirectories, $directories);
        exec($listFiles, $files);

        // Retornar los archivos, directorios y la ruta actual como JSON
        return response()->json([
            'files' => $files,
            'directories' => $directories,
            'path' => $pathusuario,
        ]);
    }
}
