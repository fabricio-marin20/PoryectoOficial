<?php

require_once("baseDomain.php");

/**
 * @author ChGari
 * Date Last  modification: Tue Jul 07 16:42:51 CST 2020
 * Comment: It was created
 *
 */
class Personas extends BaseDomain implements \JsonSerializable{

    //attributes
    private $PK_cedula;
    private $nombre;
    private $apellido1;
    private $apellido2;
    private $fecNacimiento;
    private $Correo;
    private $Usu;
    private $Contrasena;
    private $tel;
    private $TipoUsuario;
    

    //constructors
    public function __construct() {
        parent::__construct();
    }

    public static function createNullPersonas() {
        $instance = new self();
        return $instance;
    }

    public static function createPersonas($PK_cedula, $nombre, $apellido1, $apellido2, $fecNacimiento, $Correo, $Usu, $Contrasena, $tel, $TipoUsuario) {
        $instance = new self();
        $instance->PK_cedula        = $PK_cedula;
        $instance->nombre           = $nombre;
        $instance->apellido1        = $apellido1;
        $instance->apellido2        = $apellido2;
        $instance->fecNacimiento    = $fecNacimiento;
        $instance->Correo           = $Correo;
        $instance->Usu              = $Usu;
        $instance->Contrasena       = $Contrasena;
        $instance->tel              = $tel;
        $instance->TipoUsuario      = $TipoUsuario;
        
        return $instance;
    }

    /****************************************************************************/
    //properties
    /****************************************************************************/
    public function getPK_cedula() {
        return $this->PK_cedula;
    }

    public function setPK_cedula($PK_cedula) {
        $this->PK_cedula = $PK_cedula;
    }

    /****************************************************************************/

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    /****************************************************************************/

    public function getApellido1() {
        return $this->apellido1;
    }

    public function setApellido1($apellido1) {
        $this->apellido1 = $apellido1;
    }

    /****************************************************************************/

    public function getApellido2() {
        return $this->apellido2;
    }

    public function setApellido2($apellido2) {
        $this->apellido2 = $apellido2;
    }

    /****************************************************************************/

    public function getFecNacimiento() {
        return $this->fecNacimiento;
    }

    public function setFecNacimiento($fecNacimiento) {
        $this->fecNacimiento = $fecNacimiento;
    }

    /****************************************************************************/

    public function getCorreo() {
        return $this->Correo;
    }

    public function setCorreo($Correo) {
        $this->Correo = $Correo;
    }

    /****************************************************************************/

    public function getUsu() {
        return $this->Usu;
    }

    public function setUsu($Usu) {
        $this->Usu = $Usu;
    }

    /****************************************************************************/

    public function getContrasena() {
        return $this->Contrasena;
    }

    public function setContrasena($Contrasena) {
        $this->Contrasena = $Contrasena;
    }

    /****************************************************************************/

    public function getTel() {
        return $this->tel;
    }

    public function setTel($tel) {
        $this->tel = $tel;
    }
/****************************************************************************/

    public function getTipoUsuario() {
        return $this->TipoUsuario;
    }

    public function setTipoUsuario($TipoUsuario) {
        $this->TipoUsuario= $TipoUsuario;
    }


    /****************************************************************************/
    //Convertir el obj a JSON
    /****************************************************************************/
    

    public function jsonSerialize() {
        return get_object_vars($this);
    }

}