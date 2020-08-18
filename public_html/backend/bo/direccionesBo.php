<?php


require_once("../domain/direcciones.php");
require_once("../dao/direccionesDao.php");


class DireccionesBo {

    private $direccionesDao;

    public function __construct() {
        $this->direccionesDao = new DireccionesDao();
    }

    public function getDireccionesDao() {
        return $this->direccionesDao;
    }

    public function setDireccionesDao(DireccionesDao $direccionesDao) {
        $this->direccionesDao = $direccionesDao;
    }

    //***********************************************************
    //agrega a una persona a la base de datos
    //***********************************************************

    public function add(Direcciones $direcciones) {
        try {
            if (!$this->direccionesDao->exist($direcciones)) {
                $this->direccionesDao->add($direcciones);
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

    public function update(Direcciones $direcciones) {
        try {
            $this->direccionesDao->update($direcciones);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //***********************************************************
    //eliminar a una persona a la base de datos
    //***********************************************************

    public function delete(Direcciones $direcciones) {
        try {
            $this->direccionesDao->delete($direcciones);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //***********************************************************
    //consulta a una persona a la base de datos
    //***********************************************************

    public function searchById(Direcciones $direcciones) {
        try {
            return $this->direccionesDao->searchById($direcciones);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //***********************************************************
    //consultar todas las personas de la base de datos
    //***********************************************************

    public function getAll() {
        try {
            return $this->direccionesDao->getAll();
        } catch (Exception $e) {
            throw $e;
        }
    }

}

//end of the class PersonasBo
