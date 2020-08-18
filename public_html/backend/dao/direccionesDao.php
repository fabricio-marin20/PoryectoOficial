<?php

require_once("adodb5/adodb.inc.php");
require_once("../domain/direcciones.php");



//this attribute enable to see the SQL's executed in the data base
//$labAdodb->debug=true;

class DireccionesDao {
    
    
    private $labAdodb;//objeto de conexion con la base de datos 
    
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

    public function add(Direcciones $direcciones) {

        global $labAdodb;
        try {
            $sql = sprintf("insert into Direcciones (PKA_idDireccion, Personas_PK_cedula, latitud, longitud) 
                                          values (%s,%s,%s,%s)",
                    $this->labAdodb->Param("PKA_idDireccion"),
                    $this->labAdodb->Param("Personas_PK_cedula"),
                    $this->labAdodb->Param("latitud"),
                    $this->labAdodb->Param("longitud"));
                    
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["PKA_idDireccion"]       = $direcciones->getPKA_idDireccion();
            $valores["Personas_PK_cedula"]    = $direcciones->getPersonas_PK_cedula();
            $valores["latitud"]               = $direcciones->getlatitud();
            $valores["longitud"]              = $direcciones->getlongitud();

            

            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo insertar el registro (Error generado en el metodo add de la clase DireccionesDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //verifica si una persona existe en la base de datos por ID
    //***********************************************************

    public function exist(Direcciones $direcciones) {

        global $labAdodb;
        $exist = false;
        try {
            $sql = sprintf("select * from Direcciones where  PKA_idDireccion = %s ",
                            $this->labAdodb->Param("PKA_idDireccion"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();
            $valores["PKA_idDireccion"] = $direcciones->getPKA_idDireccion();

            $resultSql = $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
            if ($resultSql->RecordCount() > 0) {
                $exist = true;
            }
            return $exist;
        } catch (Exception $e) {
            throw new Exception('No se pudo obtener el registro (Error generado en el metodo exist de la clase DireccionesDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //modifica una persona en la base de datos
    //***********************************************************

    public function update(Direcciones $direcciones) {

        global $labAdodb;
        try {
            $sql = sprintf("update Direcciones set Personas_PK_cedula = %s, 
                                                latitud = %s, 
                                                longitud = %s
                                            
                                                 
                            where PKA_idDireccion = %s",
                    $this->labAdodb->Param("Personas_PK_cedula"),
                    $this->labAdodb->Param("latitud"),
                    $this->labAdodb->Param("longitud"),
                    
                    
                    $this->labAdodb->Param("PKA_idDireccion"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["Personas_PK_cedula"]     = $direcciones->getPersonas_PK_cedula();
            $valores["latitud"]                = $direcciones->getlatitud();
            $valores["longitud"]               = $direcciones->getlongitud();

            
            $valores["PKA_idDireccion"]       = $direcciones->getPKA_idDireccion();
            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo actualizar el registro (Error generado en el metodo update de la clase DireccionesDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //elimina una persona en la base de datos
    //***********************************************************

    public function delete(Direcciones $direcciones) {

        global $labAdodb;
        try {
            $sql = sprintf("delete from Direcciones where  PKA_idDireccion = %s",
                            $this->labAdodb->Param("PKA_idDireccion"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["PKA_idDireccion"] = $direcciones->getPKA_idDireccion();

            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo eliminar el registro (Error generado en el metodo delete de la clase DireccionesDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //busca a una persona en la base de datos
    //***********************************************************

    public function searchById(Direcciones $direcciones) {

        global $labAdodb;
        $returnDirecciones = null;
        try {
            $sql = sprintf("select * from Direcciones where  PKA_idDireccion = %s",
                            $this->labAdodb->Param("PKA_idDireccion"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["PKA_idDireccion"] = $direcciones->getPKA_idDireccion();

            $resultSql = $this->labAdodb->Execute($sqlParam, $valores) or die($labAdodb->ErrorMsg());
            
            if ($resultSql->RecordCount() > 0) {
                $returnDirecciones = Direcciones::createNullDirecciones();
                $returnDirecciones->setPKA_idDireccion($resultSql->Fields("PKA_idDireccion"));
                $returnDirecciones->setPersonas_PK_cedula($resultSql->Fields("Personas_PK_cedula"));
                $returnDirecciones->setlatitud($resultSql->Fields("latitud"));
                $returnDirecciones->setlongitud($resultSql->Fields("longitud"));

                
            }
        } catch (Exception $e) {
            throw new Exception('No se pudo consultar el registro (Error generado en el metodo searchById de la clase DireccionesDao), error:'.$e->getMessage());
        }
        return $returnDirecciones;
    }

    //***********************************************************
    //obtiene la información de las personas en la base de datos
    //***********************************************************
    
    public function getAll() {

        global $labAdodb;
        try {
            $sql = sprintf("select * from Direcciones");
            $resultSql = $this->labAdodb->Execute($sql);
            return $resultSql;
        } catch (Exception $e) {
            throw new Exception('No se pudo obtener los registros (Error generado en el metodo getAll de la clase DireccionesDao), error:'.$e->getMessage());
        }
    }

}
