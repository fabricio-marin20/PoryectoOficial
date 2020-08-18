<?php

require_once("adodb5/adodb.inc.php");
require_once("../domain/chofer.php");

/**
 * 
 * 
 *
 */

//this attribute enable to see the SQL's executed in the data base
//$labAdodb->debug=true;

class ChoferDao {

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

    public function add( Chofer $chofer) {

        global $labAdodb;
        try {
            $sql = sprintf("insert into chofer (Pk_Chofer, Personas_PK_cedula, Vencimiento, licencia) 
                                          values (%s,%s,%s,%s)",
                    $this->labAdodb->Param("Pk_Chofer"),
                    $this->labAdodb->Param("Personas_PK_cedula"),
                    $this->labAdodb->Param("Vencimiento"),
                    $this->labAdodb->Param("licencia"));
                    
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["Pk_Chofer"]       = $chofer->getPk_Chofer();
            $valores["Personas_PK_cedula"]       = $chofer->getPersonas_PK_cedula();
            $valores["Vencimiento"]     = $chofer->getVencimiento();
            $valores["licencia"]        = $chofer->getlicencia();
            
            
            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo insertar el registro (Error generado en el metodo add de la clase ChoferDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //verifica si una persona existe en la base de datos por ID
    //***********************************************************

    public function exist(chofer $chofer) {

        global $labAdodb;
        $exist = false;
        try {
            $sql = sprintf("select * from chofer where  Pk_Chofer = %s ",
                            $this->labAdodb->Param("Pk_Chofer"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();
            $valores["Pk_Chofer"] = $chofer->getPk_Chofer();

            $resultSql = $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
            if ($resultSql->RecordCount() > 0) {
                $exist = true;
            }
            return $exist;
        } catch (Exception $e) {
            throw new Exception('No se pudo obtener el registro (Error generado en el metodo exist de la clase ChoferDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //modifica una persona en la base de datos
    //***********************************************************

    public function update(chofer $chofer) {

        global $labAdodb;
        try {
            $sql = sprintf("update chofer set Personas_PK_cedula = %s, 
                                                Vencimiento = %s, 
                                                licencia = %s 
                                               
                   
                            where Pk_Chofer = %s",
                    $this->labAdodb->Param("Personas_PK_cedula"),
                    $this->labAdodb->Param("Vencimiento"),
                    $this->labAdodb->Param("licencia"),

                    
                    $this->labAdodb->Param("Pk_Chofer"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            
            $valores["Personas_PK_cedula"]       = $chofer->getPersonas_PK_cedula();
            $valores["Vencimiento"]              = $chofer->getVencimiento();
            $valores["licencia"]                 = $chofer->getlicencia();
            
            $valores["Pk_Chofer"]                = $chofer->getPk_Chofer();
            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo actualizar el registro (Error generado en el metodo update de la clase ChoferDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //elimina una persona en la base de datos
    //***********************************************************

    public function delete(chofer $chofer) {

        global $labAdodb;
        try {
            $sql = sprintf("delete from chofer where  Pk_Chofer = %s",
                            $this->labAdodb->Param("Pk_Chofer"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["Pk_Chofer"] = $chofer->getPk_Chofer();

            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo eliminar el registro (Error generado en el metodo delete de la clase ChoferDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //busca a una persona en la base de datos
    //***********************************************************

    public function searchById(chofer $chofer) {

        global $labAdodb;
        $returnchofer = null;
        try {
            $sql = sprintf("select * from chofer where  Pk_Chofer = %s",
                            $this->labAdodb->Param("Pk_Chofer"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["Pk_Chofer"] = $chofer->getPk_Chofer();

            $resultSql = $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
            
            if ($resultSql->RecordCount() > 0) {
                $returnchofer = Personas::createNullchofer();
                $returnchofer->setPK_cedula($resultSql->Fields("Pk_Chofer"));
                $returnchofer->setnombre($resultSql->Fields("FK_cedula"));
                $returnchofer->setapellido1($resultSql->Fields("Vencimiento"));
                $returnchofer->setapellido2($resultSql->Fields("licencia"));

                
            }
        } catch (Exception $e) {
            throw new Exception('No se pudo consultar el registro (Error generado en el metodo searchById de la clase ChoferDao), error:'.$e->getMessage());
        }
        return $returnchofer;
    }

    //***********************************************************
    //obtiene la información de las personas en la base de datos
    //***********************************************************
    
    public function getAll() {

        global $labAdodb;
        try {
            $sql = sprintf("select * from chofer");
            $resultSql = $this->labAdodb->Execute($sql);
            return $resultSql;
        } catch (Exception $e) {
            throw new Exception('No se pudo obtener los registros (Error generado en el metodo getAll de la clase ChoferDao), error:'.$e->getMessage());
        }
    }

}
