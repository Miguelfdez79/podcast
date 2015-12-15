<?php

require "/clases/AutoCarga.php";
$array = array("Mike" => "mike", "Clint" => "Clint", "Mengano" => "Mengano", "Raphael" => "Raphael", "admin" => "admin");


$usuario = Request::post("usuario");
$pass = Request::post("password");
$avatar = "mp3/usuarios/$usuario/*.jpeg";
$sesion = new Session();
$user = new Usuario();
$user->setNombre($usuario);
$user->setClave($pass);
$user->setAvatar($avatar);


if ($usuario == "admin" && $pass == "admin") { 
    $sesion->setUser($user);
    if (!is_dir("mp3/usuarios/$usuario/")) {
        mkdir("mp3/usuarios/$usuario/");
        mkdir("mp3/usuarios/$usuario/private");
        mkdir("mp3/usuarios/$usuario/public");
    }
    
    $sesion->sendRedirect("user.php"); // cambiar por admin
} else {
    if (isset($array[$usuario]) && $array[$usuario] == $pass) {
        $sesion->setUser($user);
        if (!is_dir("mp3/usuarios/$usuario/")) {
            mkdir("mp3/usuarios/$usuario/");
            mkdir("mp3/usuarios/$usuario/private");
            mkdir("mp3/usuarios/$usuario/public");
        }
        $sesion->sendRedirect("user.php");
        // header("Localtion:user.php");
    } else {
        $sesion->destroy();
        $sesion->sendRedirect("Location:index.php");
    }
}


