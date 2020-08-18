<?php

require_once("baseDomain.php");

/**
 * @author ChGari
 * Date Last  modification: Tue Jul 07 16:42:51 CST 2020
 * Comment: It was created
 *
 */
class chofer extends BaseDomain implements \JsonSerializable{

    //attributes
    private $Pk_Chofer;
    private $Personas_PK_cedula;
    private $Vencimiento;
    private $licencia;

    

    //constructors
    public function __construct() {
        parent::__construct();
    }

    public static function createNullchofer() {
        $instance = new self();
        return $instance;
    }

    public static function createchofer($Pk_Chofer, $Personas_PK_cedula, $Vencimiento, $licencia) {
        $instance = new self();
        $instance->Pk_Chofer       = $Pk_Chofer;
        $instance->Personas_PK_cedula          = $Personas_PK_cedula;
        $instance->Vencimiento       = $Vencimiento;
        $instance->licencia        = $licencia;

        
        return $instance;
    }

    /****************************************************************************/
    //properties
    /****************************************************************************/
    public function getPk_Chofer() {
        return $this->Pk_Chofer;
    }

    public function setPk_Chofer($Pk_Chofer) {
        $this->Pk_Chofer = $Pk_Chofer;
    }

    /****************************************************************************/

    public function getPersonas_PK_cedula() {
        return $this->Personas_PK_cedula;
    }

    public function setPersonas_PK_cedula($Personas_PK_cedula) {
        $this->Personas_PK_cedula = $Personas_PK_cedula;
    }

    /****************************************************************************/

    public function getVencimiento() {
        return $this->Vencimiento;
    }

    public function setVencimiento($Vencimiento) {
        $this->Vencimiento = $Vencimiento;
    }

    /****************************************************************************/

    public function getlicencia() {
        return $this->licencia;
    }

    public function setlicencia($licencia) {
        $this->licencia= $licencia;
    }

    
    /****************************************************************************/
    //Convertir el obj a JSON
    /****************************************************************************/
    

    public function jsonSerialize() {
        return get_object_vars($this);
    }

}

