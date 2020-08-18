
<?php

require_once("baseDomain.php");

/**
 * @author ChGari
 * Date Last  modification: Tue Jul 07 16:42:51 CST 2020
 * Comment: It was created
 *
 */
class Viaje extends BaseDomain implements \JsonSerializable{

    //attributes
    private $PK_Viaje;
    private $Personas_PK_cedula;
    private $Chofer;
    private $Pasejero;
    private $Km;
    private $LonIni;
    private $LatIni;
    private $LonFin;
    private $LatFin;
   
    

    //constructors
    public function __construct() {
        parent::__construct();
    }

    public static function createNullViaje() {
        $instance = new self();
        return $instance;
    }

    public static function createPersonas($PK_Viaje, $Personas_PK_cedula, $Chofer, $Pasejero, $Km, $LonIni, $LatIni, $LonFin, $LatFin) {
        $instance = new self();
        $instance->PK_Viaje                     = $PK_Viaje;
        $instance->Personas_PK_cedula           = $Personas_PK_cedula;
        $instance->Chofer                       = $Chofer;
        $instance->Pasejero                     = $Pasejero;
        $instance->Km                           = $Km;
        $instance->LonIni                       = $LonIni;
        $instance->LatIni                       = $LatIni;
        $instance->LonFin                       = $LonFin;
        $instance->LatFin                       = $LatFin;
   
        
        return $instance;
    }

    /****************************************************************************/
    //properties
    /****************************************************************************/
    public function getPK_Viaje() {
        return $this->PK_Viaje;
    }

    public function setPK_Viaje($PK_Viaje) {
        $this->PK_Viaje = $PK_Viaje;
    }

    /****************************************************************************/

    public function getPersonas_PK_cedula() {
        return $this->Personas_PK_cedula;
    }

    public function setPersonas_PK_cedula($Personas_PK_cedula) {
        $this->Personas_PK_cedula = $Personas_PK_cedula;
    }

    /****************************************************************************/

    public function getChofer() {
        return $this->Chofer;
    }

    public function setChofer($Chofer) {
        $this->Chofer = $Chofer;
    }

    /****************************************************************************/

    public function getPasejero() {
        return $this->Pasejero;
    }

    public function setPasejero($Pasejero) {
        $this->Pasejero = $Pasejero;
    }

    /****************************************************************************/

    public function getKm() {
        return $this->Km;
    }

    public function setKm($Km) {
        $this->Km = $Km;
    }

    /****************************************************************************/

    public function getLonIni() {
        return $this->LonIni;
    }

    public function setLonIni($LonIni) {
        $this->LonIni = $LonIni;
    }

    /****************************************************************************/

    public function getLatIni() {
        return $this->LatIni;
    }

    public function setLatIni($LatIni) {
        $this->LatIni = $LatIni;
    }

    /****************************************************************************/

    public function getLonFin() {
        return $this->LonFin;
    }

    public function setLonFin($LonFin) {
        $this->LonFin = $LonFin;
    }

    /****************************************************************************/

    public function getLatFin() {
        return $this->LatFin;
    }

    public function setLatFin($LatFin) {
        $this->LatFin = $LatFin;
    }
/****************************************************************************/

    //Convertir el obj a JSON
    /****************************************************************************/
    

    public function jsonSerialize() {
        return get_object_vars($this);
    }

}