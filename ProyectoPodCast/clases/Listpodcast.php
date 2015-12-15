<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Listpodcast
 *
 * @author Miguel
 */
class Listpodcast {
    
    //Funcion para volcar canciones en lista según seas admin o usuario normal
    static function listar($usuario, $categoria, $privacidad, $nombre = null, $avatar = null) {
        $string = "";
        $cont = 0;
        if ($nombre == null) {

            $folder = "mp3/usuarios/" . $usuario . "/" . $privacidad . "/" . $categoria . "/";
            if (file_exists($folder)) {
                $directorio = opendir($folder);
                while ($archivo = readdir($directorio)) {
                    if (!is_dir($archivo)) {
                        $string = $string . "<li><a href=user.php?song=mp3/usuarios/" . $usuario . "/" . $privacidad . "/" . $categoria . "/" . $archivo . ">$archivo" . '</a></li>';
                    }
                }
                return $string;
            }
        } else {
            if ($usuario == "admin") {
                $folder = "mp3/usuarios/" . $nombre . "/" . $privacidad . "/" . $categoria . "/";
                if (file_exists($folder)) {
                    $directorio = opendir($folder);
                    while ($archivo = readdir($directorio)) {
                        if (!is_dir($archivo)) {
                            $string = $string . "<li><a href=user.php?song=mp3/usuarios/" . $nombre . "/" . $privacidad . "/" . $categoria . "/" . $archivo . ">$archivo" . '</a></li>';
                        }
                    }
                    return $string;
                }
            } else {
                if ($privacidad == "public") {
                    $folder = "mp3/usuarios/" . $nombre . "/" . $privacidad . "/" . $categoria . "/";
                    if (file_exists($folder)) {
                        $directorio = opendir($folder);
                        while (false !== ($archivo = readdir($directorio))) {
                            if (!is_dir($archivo)) {
                                $string = $string . "<li><a href=user.php?song=mp3/usuarios/" . $nombre . "/public/" . $categoria . "/" . $archivo . ">$archivo" . '</a></li>';
                            }
                        }
                        return $string;
                    }
                }
            }
        }
    }
    

    //Mostrar ususarios en la lista de la derecha de user.php. Al usar scandir en vez de opendir
    // los ordenaremos directamente.
    static function mostrarusuarios($usuario) {
        $folder = "mp3/usuarios/";
        $string = "";
        $array = scandir($folder);
        for ($index = 2; $index < count($array); $index++) {
            if ($array[$index] != "admin" && $array[$index] != $usuario) {
                $string = $string . "<li><a href=users.php?nombre=" . $array[$index] . ">" . $array[$index] . '</a></li>';
            }
        }
        return $string;
    }

    // Metodo para contar las canciones de cada usuario.
    //  Lo suyo hubiera sido usar recursividad y leer directorios, subdirectorios y archivos
    // de una sola vez.
    static function CountFiles($usuario) {
        $filecount = 0;
        $arrayregulero = array(1 => "mp3/usuarios/$usuario/private/Rock/",
            2 => "mp3/usuarios/$usuario/private/Heavy/",
            3 => "mp3/usuarios/$usuario/private/Pop/",
            4 => "mp3/usuarios/$usuario/private/Soul/",
            5 => "mp3/usuarios/$usuario/private/Jazz/",
            6 => "mp3/usuarios/$usuario/public/Heavy/",
            7 => "mp3/usuarios/$usuario/public/Pop/",
            8 => "mp3/usuarios/$usuario/public/Rock/",
            9 => "mp3/usuarios/$usuario/public/Soul/",
            10 => "mp3/usuarios/$usuario/public/Jazz/"
        );


        foreach ($arrayregulero as $key => $value) {
            if (glob($value . "*.mp3") != false) {
                $filecount += count(glob($value . "*.mp3"));
            }
        }
        return $filecount;
    }

   static function listarCanciones($usuario, $categoria, $privacidad, $nombre = null, $avatar = null){
        $string="";
        $folder = "mp3/usuarios/" . $usuario . "/" . $privacidad . "/" . $categoria . "/";
            if(file_exists($folder)){
                $carpeta=  opendir($folder);
                while($archivo=  readdir($carpeta)){
                    if(!is_dir($archivo)){
                      $string = $string . "<li><a href=?src=mp3/usuarios/" . $usuario . "/" . $privacidad . "/" . $categoria . "/" . $archivo . ">$archivo" . '</a></li>';
                    }
                    
                }
                return $string;
            }
        
    }
    
    
  

}
