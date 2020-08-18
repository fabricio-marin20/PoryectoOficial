
<?php

require_once("adodb5/adodb.inc.php");
require_once("../domain/Viaje.php");

/**
 * 
 * @author ChGari
 * Date Last  modification: Tue Jul 07 16:42:51 CST 2020
 * Comment: It was created
 *
 */

//this attribute enable to see the SQL's executed in the data base
//$labAdodb->debug=true;

class ViajeDao {

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

    public function add(Viaje $Viaje) {

        global $labAdodb;
        try {
            $sql = sprintf("insert into Viaje (PK_Viaje,Personas_PK_cedula, Chofer, Pasejero, Km, LonIni, LatIni, LonFin, LatFin) 
                                          values (%s,%s,%s,%s,%s,%s,%s,%s,%s)",
                    $this->labAdodb->Param("PK_Viaje"),
                    $this->labAdodb->Param("Personas_PK_cedula"),
                    $this->labAdodb->Param("Chofer"),
                    $this->labAdodb->Param("Pasejero"),
                    $this->labAdodb->Param("Km"),
                    $this->labAdodb->Param("LonIni"),
                    $this->labAdodb->Param("LatIni"),
                    $this->labAdodb->Param("LonFin"),
                    $this->labAdodb->Param("LatFin"));
                    
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["PK_Viaje"]                    = $Viaje->getPK_Viaje();
            $valores["Personas_PK_cedula"]          = $Viaje->getPersonas_PK_cedula();
            $valores["Chofer"]                      = $Viaje->getChofer();
            $valores["Pasejero"]                    = $Viaje->getPasejero();
            $valores["Km"]                          = $Viaje->getKm();
            $valores["LonIni"]                      = $Viaje->getLonIni();
            $valores["LatIni"]                      = $Viaje->getLatIni();
            $valores["LonFin"]                      = $Viaje->getLonFin();
            $valores["LatFin"]                      = $Viaje->getLatFin();

            

            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo insertar el registro (Error generado en el metodo add de la clase ViajeDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //verifica si una persona existe en la base de datos por ID
    //***********************************************************

    public function exist(Viaje $Viaje) {

        global $labAdodb;
        $exist = false;
        try {
            $sql = sprintf("select * from Viaje where  PK_Viaje = %s ",
                            $this->labAdodb->Param("PK_Viaje"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();
            $valores["PK_Viaje"] = $Viaje->getPK_Viaje();

            $resultSql = $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
            if ($resultSql->RecordCount() > 0) {
                $exist = true;
            }
            return $exist;
        } catch (Exception $e) {
            throw new Exception('No se pudo obtener el registro (Error generado en el metodo exist de la clase ViajeDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //modifica una persona en la base de datos
    //***********************************************************

    public function update(Viaje $Viaje) {

        global $labAdodb;
        try {
            $sql = sprintf("update Viaje set Personas_PK_cedula = %s, 
                                                Chofer = %s, 
                                                Pasejero = %s, 
                                                Km = %s, 
                                                LonIni = %s, 
                                                LatIni = %s, 
                                                LonFin = %s,
                                                LatFin = %s
                                                 
                            where PK_Viaje = %s",
                    $this->labAdodb->Param("Personas_PK_cedula"),
                    $this->labAdodb->Param("Chofer"),
                    $this->labAdodb->Param("Pasejero"),
                    $this->labAdodb->Param("Km"),
                    $this->labAdodb->Param("LonIni"),
                    $this->labAdodb->Param("LatIni"),
                    $this->labAdodb->Param("LonFin"),
                    $this->labAdodb->Param("LatFin"),
                    
                    
                    $this->labAdodb->Param("PK_Viaje"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["Personas_PK_cedula"]          = $Viaje->getPersonas_PK_cedula();
            $valores["Chofer"]                      = $Viaje->getChofer();
            $valores["Pasejero"]                    = $Viaje->getPasejero();
            $valores["Km"]                          = $Viaje->getKm();
            $valores["LonIni"]                      = $Viaje->getLonIni();
            $valores["LatIni"]                      = $Viaje->getLatIni();
            $valores["LonFin"]                      = $Viaje->getLonFin();
            $valores["tel"]                         = $Viaje->getLatFin();
            
            
            $valores["PK_Viaje"]       = $Viaje->getPK_Viaje();
            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo actualizar el registro (Error generado en el metodo update de la clase ViajeDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //elimina una persona en la base de datos
    //***********************************************************

    public function delete(Viaje $Viaje) {

        global $labAdodb;
        try {
            $sql = sprintf("delete from Viaje where  PK_Viaje = %s",
                            $this->labAdodb->Param("PK_Viaje"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["PK_Viaje"] = $Viaje->getPK_Viaje();

            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo eliminar el registro (Error generado en el metodo delete de la clase ViajeDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //busca a una persona en la base de datos
    //***********************************************************

    public function searchById(Viaje $Viaje) {

        global $labAdodb;
        $returnViaje= null;
        try {
            $sql = sprintf("select * from Viaje where  PK_Viaje = %s",
                            $this->labAdodb->Param("PK_Viaje"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["PK_Viaje"] = $Viaje->getPK_Viaje();

            $resultSql = $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
            
            if ($resultSql->RecordCount() > 0) {
                $returnViaje = Viaje::createNullViaje();
                $returnViaje->setPK_Viaje($resultSql->Fields("PK_Viaje"));
                $returnViaje->setPersonas_PK_cedula($resultSql->Fields("Personas_PK_cedula"));
                $returnViaje->setChofer($resultSql->Fields("Chofer"));
                $returnViaje->setPasejero($resultSql->Fields("Pasejero"));
                $returnViaje->setKm($resultSql->Fields("Km"));
                $returnViaje->setLonIni($resultSql->Fields("LonIni"));
                $returnViaje->setLatIni($resultSql->Fields("LatIni"));
                $returnViaje->setLonFin($resultSql->Fields("LonFin"));
                $returnViaje->setLatFin($resultSql->Fields("LatFin"));
             
                
            }
        } catch (Exception $e) {
            throw new Exception('No se pudo consultar el registro (Error generado en el metodo searchById de la clase ViajeDao), error:'.$e->getMessage());
        }
        return $returnViaje;
    }

    //***********************************************************
    //obtiene la información de las personas en la base de datos
    //***********************************************************
    
    public function getAll() {

        global $labAdodb;
        try {
            $sql = sprintf("select * from Viaje");
            $resultSql = $this->labAdodb->Execute($sql);
            return $resultSql;
        } catch (Exception $e) {
            throw new Exception('No se pudo obtener los registros (Error generado en el metodo getAll de la clase ViajeDao), error:'.$e->getMessage());
        }
    }

}
