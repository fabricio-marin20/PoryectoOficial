<?php

require_once("baseDomain.php");

/**
 * @author ChGari
 * Date Last  modification: Tue Jul 07 16:42:51 CST 2020
 * Comment: It was created
 *
 */
class Facturación extends BaseDomain implements \JsonSerializable{

    //attributes
    private $PK_factura;
    private $Viaje_PK_Viaje;
    private $Monto;
    private $Km;
    private $Fecha;

    

    //constructors
    public function __construct() {
        parent::__construct();
    }

    public static function createNullFacturación() {
        $instance = new self();
        return $instance;
    }

    public static function createFacturación($PK_factura, $Viaje_PK_Viaje, $Monto, $Km, $Fecha) {
        $instance = new self();
        $instance->PK_factura        = $PK_factura;
        $instance->Viaje_PK_Viaje          = $Viaje_PK_Viaje;
        $instance->Monto       = $Monto;
        $instance->Km        = $Km;
        $instance->Fecha   = $Fecha;

        
        return $instance;
    }

    /****************************************************************************/
    //properties
    /****************************************************************************/
    public function getPK_factura() {
        return $this->PK_factura;
    }

    public function setPK_factura($PK_factura) {
        $this->PK_factura = $PK_factura;
    }

    /****************************************************************************/

    public function getViaje_PK_Viaje() {
        return $this->Viaje_PK_Viaje;
    }

    public function setViaje_PK_Viaje($Viaje_PK_Viaje) {
        $this->Viaje_PK_Viaje = $Viaje_PK_Viaje;
    }

    /****************************************************************************/

    public function getMonto() {
        return $this->Monto;
    }

    public function setMonto($Monto) {
        $this->Monto = $Monto;
    }

    /****************************************************************************/

    public function getKm() {
        return $this->Km;
    }

    public function setKm($Km) {
        $this->Km = $Km;
    }

    /****************************************************************************/

    public function getFecha() {
        return $this->Fecha;
    }

    public function setFecha($Fecha) {
        $this->Fecha = $Fecha;
    }

    /****************************************************************************/


    //Convertir el obj a JSON
    /****************************************************************************/
    

    public function jsonSerialize() {
        return get_object_vars($this);
    }

}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

