<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 *
 * @author Miguel
 */
class Usuario {
    private $nombre, $clave, $avatar;
    
       function _construct($nombre = null, $clave = null, $avatar=null ){
        $this->clave =$clave;
        $this->nombre= $nombre;
        $this->avatar=$avatar;
    }
    function getAvatar() {
        return $this->avatar;
    }
    function setAvatar($avatar) {
        $this->avatar = $avatar;
    }

    public function __toString() {
        return $this->nombre;
    }
    
    public function getNombre() {
        return $this->nombre;
    }

     public function getClave() {
        return $this->clave;
    }
    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setClave($clave) {
        $this->clave = $clave;
    }
    



}
