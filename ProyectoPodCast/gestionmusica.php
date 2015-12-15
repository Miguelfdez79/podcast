<?php

require '/clases/Autocarga.php';
$sesion =  new Session();
$user = new Usuario();
$user = $sesion->getUser();
$categoria = Request::post("categorias");
$privacidad = Request::post("privacidad");
$subir = new UploadFile("archivo");
$subir->setNombre($subir->getNombre());
$subir->setPolitica(UploadFile::RENOMBRAR);
$subir->setDestino("mp3/usuarios/".$user->getNombre()."/".$privacidad ."/".$categoria."/");

 if(!is_dir("mp3/usuarios/".$user->getNombre()."/".$privacidad ."/".$categoria."/")){
        mkdir("mp3/usuarios/".$user->getNombre()."/".$privacidad ."/".$categoria."/");
    }



if($subir->upload()){
    echo "Archivo subido";
    $sesion->sendRedirect("user.php");
    
}else{
    echo "Archivo subido";
    $sesion->sendRedirect("errorpage.php");  
}

