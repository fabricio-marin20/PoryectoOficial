
<?php


require_once("../domain/InfAuto.php");
require_once("../dao/InfAutoDao.php");

/**
 * @author ChGari
 * Date Last  modification: Tue Jul 07 16:42:51 CST 2020
 * Comment: It was created
 *
 */
class InfAutoBo {

    private $InfAutoDao;

    public function __construct() {
        $this->InfAutoDao = new InfAutoDao();
    }

    public function getInfAutoDao() {
        return $this->InfAutoDao;
    }

    public function setInfAutoDao(InfAutoDao $InfAutoDao) {
        $this->InfAutoDao = $InfAutoDao;
    }

    //***********************************************************
    //agrega a una persona a la base de datos
    //***********************************************************

    public function add(InfAuto $InfAuto) {
        try {
            if (!$this->InfAutoDao->exist($InfAuto)) {
                $this->InfAutoDao->add($InfAuto);
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

    public function update(InfAuto $InfAuto) {
        try {
            $this->InfAutoDao->update($InfAuto);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //***********************************************************
    //eliminar a una persona a la base de datos
    //***********************************************************

    public function delete(InfAuto $InfAuto) {
        try {
            $this->InfAutoDao->delete($InfAuto);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //***********************************************************
    //consulta a una persona a la base de datos
    //***********************************************************

    public function searchById(InfAuto $InfAuto) {
        try {
            return $this->InfAutoDao->searchById($InfAuto);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //***********************************************************
    //consultar todas las personas de la base de datos
    //***********************************************************

    public function getAll() {
        try {
            return $this->InfAutoDao->getAll();
        } catch (Exception $e) {
            throw $e;
        }
    }

}
