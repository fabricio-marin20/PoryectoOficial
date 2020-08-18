<?php


require_once("../domain/Viaje.php");
require_once("../dao/ViajeDao.php");

/**
 * @author ChGari
 * Date Last  modification: Tue Jul 07 16:42:51 CST 2020
 * Comment: It was created
 *
 */
class ViajeBo {

    private $ViajeDao;

    public function __construct() {
        $this->ViajeDao = new ViajeDao();
    }

    public function getViajeDao() {
        return $this->ViajeDao;
    }

    public function setViajeDao(ViajeDao $ViajeDao) {
        $this->ViajeDao = $ViajeDao;
    }

    //***********************************************************
    //agrega a una persona a la base de datos
    //***********************************************************

    public function add(Viaje $Viaje) {
        try {
            if (!$this->ViajeDao->exist($Viaje)) {
                $this->ViajeDao->add($Viaje);
            } else {
                throw new Exception("El Personas ya existe en la base de datos!!");
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    //***********************************************************
    //modifica a una persona a la base de datos
    //***********************************************************

    public function update(Viaje $Viaje) {
        try {
            $this->ViajeDao->update($Viaje);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //***********************************************************
    //eliminar a una persona a la base de datos
    //***********************************************************

    public function delete(Viaje $Viaje) {
        try {
            $this->ViajeDao->delete($Viaje);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //***********************************************************
    //consulta a una persona a la base de datos
    //***********************************************************

    public function searchById(Viaje $Viaje) {
        try {
            return $this->ViajeDao->searchById($Viaje);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //***********************************************************
    //consultar todas las personas de la base de datos
    //***********************************************************

    public function getAll() {
        try {
            return $this->ViajeDao->getAll();
        } catch (Exception $e) {
            throw $e;
        }
    }

}

//end of the class PersonasBo
