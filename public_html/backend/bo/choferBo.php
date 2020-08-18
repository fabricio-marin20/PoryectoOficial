<?php


require_once("../domain/chofer.php");
require_once("../dao/choferDao.php");

/**
 *
 *
 */
class ChoferBo {

    private $choferDao;

    public function __construct() {
        $this->choferDao = new ChoferDao();
    }

    public function getChoferDao() {
        return $this->choferDao;
    }

    public function setChoferDao(choferDao $choferDao) {
        $this->choferDao = $choferDao;
    }

    //***********************************************************
    //agrega a una persona a la base de datos
    //***********************************************************

    public function add(chofer $chofer) {
        try {
            if (!$this->choferDao->exist($chofer)) {
                $this->choferDao->add($chofer);
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

    public function update(chofer $chofer) {
        try {
            $this->choferDao->update($chofer);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //***********************************************************
    //eliminar a una persona a la base de datos
    //***********************************************************

    public function delete(chofer $chofer) {
        try {
            $this->choferDao->delete($chofer);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //***********************************************************
    //consulta a una persona a la base de datos
    //***********************************************************

    public function searchById(chofer $chofer) {
        try {
            return $this->choferDao->searchById($chofer);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //***********************************************************
    //consultar todas las personas de la base de datos
    //***********************************************************

    public function getAll() {
        try {
            return $this->choferDao->getAll();
        } catch (Exception $e) {
            throw $e;
        }
    }

}

//end of the class PersonasBo
?>