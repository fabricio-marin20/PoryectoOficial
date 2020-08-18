<?php


require_once("../domain/facturación.php");
require_once("../dao/facturaciónDao.php");

/**
 * @author ChGari
 * Date Last  modification: Tue Jul 07 16:42:51 CST 2020
 * Comment: It was created
 *
 */
class FacturaciónBo {

    private $facturaciónDao;

    public function __construct() {
        $this->facturaciónDao = new FacturaciónDao();
    }

    public function getFacturaciónDao() {
        return $this->facturaciónDao;
    }

    public function setFacturaciónDao(FacturaciónDao $facturaciónDao) {
        $this->facturaciónDao = $facturaciónDao;
    }

    //***********************************************************
    //agrega a una persona a la base de datos
    //***********************************************************

    public function add(Facturación $facturación) {
        try {
            if (!$this->facturaciónDao->exist($facturación)) {
                $this->facturaciónDao->add($facturación);
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

    public function update(Facturación $facturación) {
        try {
            $this->facturaciónDao->update($facturación);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //***********************************************************
    //eliminar a una persona a la base de datos
    //***********************************************************

    public function delete(Facturación $facturación) {
        try {
            $this->facturaciónDao->delete($facturación);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //***********************************************************
    //consulta a una persona a la base de datos
    //***********************************************************

    public function searchById(Facturación $facturación) {
        try {
            return $this->facturaciónDao->searchById($facturación);
        } catch (Exception $e) {
            throw $e;
        }
    }

    //***********************************************************
    //consultar todas las personas de la base de datos
    //***********************************************************

    public function getAll() {
        try {
            return $this->facturaciónDao->getAll();
        } catch (Exception $e) {
            throw $e;
        }
    }

}

//end of the class PersonasBo
?>