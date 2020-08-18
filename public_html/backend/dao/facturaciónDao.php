<?php

require_once("adodb5/adodb.inc.php");
require_once("../domain/facturación.php");

/**
 * 
 * @author ChGari
 * Date Last  modification: Tue Jul 07 16:42:51 CST 2020
 * Comment: It was created
 *
 */

//this attribute enable to see the SQL's executed in the data base
//$labAdodb->debug=true;

class FacturaciónDao {

    public function __construct() {
        $driver = 'mysqli';
        $this->labAdodb = newAdoConnection($driver);
        $this->labAdodb->setCharset('utf8');
        $this->labAdodb->setConnectionParameter('CharacterSet', 'WE8ISO8859P15');
        //los cados de conexión   host,       user,   pass,   basedatos
        $this->labAdodb->Connect("localhost", "root", "root", "mydb");   
        
        //si se desea hacer debug del SQL que se genera en la base de datos
        //dependiendo del error es necesario ver si es un error directamente
        //en la base de datos
        $this->labAdodb->debug=false;        
    }

    //***********************************************************
    //agrega a una persona a la base de datos
    //***********************************************************

    public function add(Facturación $facturación) {

        global $labAdodb;
        try {
            $sql = sprintf("insert into Facturación (PK_factura, Viaje_PK_Viaje, Monto, Km, Fecha) 
                                          values (%s,%s,%s,%s,%s)",
                    $this->labAdodb->Param("PK_factura"),
                    $this->labAdodb->Param("Viaje_PK_Viaje"),
                    $this->labAdodb->Param("Monto"),
                    $this->labAdodb->Param("Km"),
                    $this->labAdodb->Param("Fecha"));
                    
            $sqlParam = $labAdodb->Prepare($sql);

            $valores = array();

            $valores["PK_factura"]       = $facturación->getPK_factura();
            $valores["Viaje_PK_Viaje"]   = $facturación->getViaje_PK_Viaje();
            $valores["Monto"]       = $facturación->getMonto();
            $valores["Km"]       = $facturación->getKm();
            $valores["Fecha"]   = $facturación->getFecha();

            

            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo insertar el registro (Error generado en el metodo add de la clase FacturaciónDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //verifica si una persona existe en la base de datos por ID
    //***********************************************************

    public function exist(Facturación $facturación) {

        global $labAdodb;
        $exist = false;
        try {
            $sql = sprintf("select * from Facturación where  PK_factura = %s ",
                            $this->labAdodb->Param("PK_factura"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();
            $valores["PK_factura"] = $facturación->getPK_factura();

            $resultSql = $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
            if ($resultSql->RecordCount() > 0) {
                $exist = true;
            }
            return $exist;
        } catch (Exception $e) {
            throw new Exception('No se pudo obtener el registro (Error generado en el metodo exist de la clase FacturaciónDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //modifica una persona en la base de datos
    //***********************************************************

    public function update(Facturación $facturación) {

        global $labAdodb;
        try {
            $sql = sprintf("update Facturación set Viaje_PK_Viaje = %s, 
                                               Monto = %s, 
                                                Km = %s, 
                                                Fecha = %s 

                                                 
                            where PK_factura = %s",
                    $this->labAdodb->Param("Viaje_PK_Viaje"),
                    $this->labAdodb->Param("Monto"),
                    $this->labAdodb->Param("Km"),
                    $this->labAdodb->Param("Fecha"),
                    
                    $this->labAdodb->Param("PK_factura"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["PK_factura"]        = $facturación->getPK_factura();
            $valores["Viaje_PK_Viaje"]    = $facturación->getViaje_PK_Viaje();
            $valores["Monto"]             = $facturación->getMonto();
            $valores["Km"]                = $facturación->getKm();
            $valores["Fecha"]             = $facturación->getFecha();

            
            $valores["PK_factura"]       = $facturación->getPK_factura();
            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo actualizar el registro (Error generado en el metodo update de la clase FacturaciónDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //elimina una persona en la base de datos
    //***********************************************************

    public function delete(Facturación $facturación) {

        global $labAdodb;
        try {
            $sql = sprintf("delete from Facturación where  PK_factura = %s",
                            $this->labAdodb->Param("PK_factura"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["PK_factura"] = $facturación->getPK_factura();

            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo eliminar el registro (Error generado en el metodo delete de la clase FacturaciónDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //busca a una persona en la base de datos
    //***********************************************************

    public function searchById(Facturación $facturación) {

        global $labAdodb;
        $returnFacturación = null;
        try {
            $sql = sprintf("select * from Facturación where  PK_factura = %s",
                            $this->labAdodb->Param("PK_factura"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["PK_factura"] = $facturación->getPK_factura();

            $resultSql = $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
            
            if ($resultSql->RecordCount() > 0) {
                $returnFacturación = Facturación::createNullFacturación();
                $returnFacturación->setPK_factura($resultSql->Fields("PK_factura"));
                $returnFacturación->setViaje_PK_Viaje($resultSql->Fields("Viaje_PK_Viaje"));
                $returnFacturación->setMonto($resultSql->Fields("Monto"));
                $returnFacturación->setKm($resultSql->Fields("Km"));
                $returnFacturación->setFecha($resultSql->Fields("Fecha"));

                
            }
        } catch (Exception $e) {
            throw new Exception('No se pudo consultar el registro (Error generado en el metodo searchById de la clase PersonasDao), error:'.$e->getMessage());
        }
        return $returnFacturación;
    }

    //***********************************************************
    //obtiene la información de las personas en la base de datos
    //***********************************************************
    
    public function getAll() {

        global $labAdodb;
        try {
            $sql = sprintf("select * from Facturación");
            $resultSql = $this->labAdodb->Execute($sql);
            return $resultSql;
        } catch (Exception $e) {
            throw new Exception('No se pudo obtener los registros (Error generado en el metodo getAll de la clase FacturaciónDao), error:'.$e->getMessage());
        }
    }

}

