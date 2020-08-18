<?php

require_once("baseDomain.php");

/**
 * @author ChGari
 * Date Last  modification: Tue Jul 07 16:42:51 CST 2020
 * Comment: It was created
 *
 */
class Direcciones extends BaseDomain implements \JsonSerializable{

    //attributes
    private $PKA_idDireccion;
    private $Personas_PK_cedula;
    private $latitud;
    private $longitud;

    

    //constructors
    public function __construct() {
        parent::__construct();
    }

    public static function createNullDirecciones() {
        $instance = new self();
        return $instance;
    }

    public static function createDirecciones($PKA_idDireccion, $Personas_PK_cedula, $latitud, $longitud) {
        $instance = new self();
        $instance->PKA_idDireccion        = $PKA_idDireccion;
        $instance->Personas_PK_cedula       = $Personas_PK_cedula;
        $instance->latitud    = $latitud;
        $instance->longitud       = $longitud;

        return $instance;
    }

    /****************************************************************************/
    //properties
    /****************************************************************************/
    public function getPKA_idDireccion() {
        return $this->PKA_idDireccion;
    }

    public function setPKA_idDireccion($PKA_idDireccion) {
        $this->PKA_idDireccion= $PKA_idDireccion;
    }

    /****************************************************************************/

    public function getPersonas_PK_cedula() {
        return $this->Personas_PK_cedula;
    }

    public function setPersonas_PK_cedula($Personas_PK_cedula) {
        $this->Personas_PK_cedula = $Personas_PK_cedula;
    }

    /****************************************************************************/

    public function getlatitud() {
        return $this->latitud;
    }

    public function setlatitud($latitud) {
        $this->latitud= $latitud;
    }

    /****************************************************************************/

    public function getlongitud() {
        return $this->longitud;
    }

    public function setlongitud($longitud) {
        $this->longitud = $longitud;
    }


    /****************************************************************************/
    //Convertir el obj a JSON
    /****************************************************************************/
    

    public function jsonSerialize() {
        return get_object_vars($this);
    }

}