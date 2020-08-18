
<?php

require_once("baseDomain.php");

/**
 * @author ChGari
 * Date Last  modification: Tue Jul 07 16:42:51 CST 2020
 * Comment: It was created
 *
 */
class InfAuto extends BaseDomain implements \JsonSerializable{

    //attributes
    private $placa;
    private $Personas_PK_cedula;
    private $modelo;
    private $ColAut;

    

    //constructors
    public function __construct() {
        parent::__construct();
    }

    public static function createNullInfAuto() {
        $instance = new self();
        return $instance;
    }

    public static function createPersonas($placa, $Personas_PK_cedula, $modelo, $ColAut) {
        $instance = new self();
        $instance->placa                        = $placa;
        $instance->Personas_PK_cedula           = $Personas_PK_cedula;
        $instance->modelo                       = $modelo;
        $instance->ColAut                       = $ColAut;

        
        return $instance;
    }

    /****************************************************************************/
    //properties
    /****************************************************************************/
    public function getplaca() {
        return $this->placa;
    }

    public function setplaca($placa) {
        $this->placa = $placa;
    }

    /****************************************************************************/

    public function getPersonas_PK_cedula() {
        return $this->Personas_PK_cedula;
    }

    public function setPersonas_PK_cedula($Personas_PK_cedula) {
        $this->Personas_PK_cedula = $Personas_PK_cedula;
    }

    /****************************************************************************/

    public function getmodelo() {
        return $this->modelo;
    }

    public function setmodelo($modelo) {
        $this->modelo = $modelo;
    }

    /****************************************************************************/

    public function getColAut() {
        return $this->ColAut;
    }

    public function setColAut($ColAut) {
        $this->ColAut = $ColAut;
    }

    //Convertir el obj a JSON
    /****************************************************************************/
    

    public function jsonSerialize() {
        return get_object_vars($this);
    }

}
