<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Upload
 *
 * @author Miguel
 */
class Upload {
   // Atributos de la clase
  private $mostrarerror = TRUE;
  private $error = '';
  private $ruta = '/imagenes/';
  private $nombre = 'file.txt';
  private $tamaño = '100000';
  private $extensiones = array('imagen/jpeg','imagen/png','image/gif'); 

 
 // Metodos para hacer cambios en los atributos de las clases
  
   private function setMostrarError($valor) {
    $this->mostrarerror = $valor;
  }
  private function setTamaño($nuevotamaño) {
    $this->tamaño = $nuevotamaño;
  }
  
  private function setRuta($nuevaruta) {
    $this->ruta = $nuevaruta;
  }
  private function setNombre($nuevonombre) {
    $this->nombre = $nuevonombre;
  }
 
  private function setExtensionesValidas($nuevaextension) {
    if (is_array($nuevaextension)) {
      $this->extensiones = $nuevaextension;
    }
    else {
      $this->extensiones = array($nuevaextension);
    }
  }
 
  
  //funcion especifica para subir el archivo
    static function upload($archivo) {
 
    $this->validar($archivo);
    if ($this->error) {
      if ($this->mostrarerror)
          {
      print $this->error;
      
          }
    }
    else {
      // esta funcion es la encargada en php de mover el archivo especificado  
      move_uploaded_file($archivo['tmp_name'][0], $this->ruta.$this->nombre);
    }
  }

 
  // Para validar el archivo
  private function validate($archivo) {
    $error = '';
    if (empty($archivo['name'][0])) $error .= 'No file found.<br />';
    if (!in_array($this->getExtension($file),$this->allowedExtensions)) $error .= 'Extension invalida.';
    if ($archivo['size'][0] > $this->maxSize) $error .= 'Maximo excedido';
 
    $this->error = $error;
  }

 
}
