
<?php

require_once("adodb5/adodb.inc.php");
require_once("../domain/InfAuto.php");


//this attribute enable to see the SQL's executed in the data base
//$labAdodb->debug=true;

class InfAutoDao {

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

    public function add(InfAuto $InfAuto) {

        global $labAdodb;
        try {
            $sql = sprintf("insert into InfAuto (placa, Personas_PK_cedula, modelo, ColAut) 
                                          values (%s,%s,%s,%s)",
                    $this->labAdodb->Param("placa"),
                    $this->labAdodb->Param("Personas_PK_cedula"),
                    $this->labAdodb->Param("modelo"),
                    $this->labAdodb->Param("ColAut"));
                    
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["placa"]               = $InfAuto->getplaca();
            $valores["Personas_PK_cedula"]  = $InfAuto->getPersonas_PK_cedula();
            $valores["modelo"]           = $InfAuto->getmodelo();
            $valores["ColAut"]           = $InfAuto->getColAut();

            

            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo insertar el registro (Error generado en el metodo add de la clase InfAutoDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //verifica si una persona existe en la base de datos por ID
    //***********************************************************

  Public function exist(InfAuto $InfAuto) {

        global $labAdodb;
        $exist = false;
        try {
            $sql = sprintf("select * from InfAuto where  placa = %s ",
                            $this->labAdodb->Param("placa"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();
            $valores["placa"] = $InfAuto->getplaca();

            $resultSql = $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
            if ($resultSql->RecordCount() > 0) {
                $exist = true;
            }
            return $exist;
        } catch (Exception $e) {
            throw new Exception('No se pudo obtener el registro (Error generado en el metodo exist de la clase PersonasDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //modifica una persona en la base de datos
    //***********************************************************

    public function update(InfAuto $InfAuto) {

        global $labAdodb;
        try {
            $sql = sprintf("update InfAuto set Personas_PK_cedula = %s, 
                                                modelo = %s, 
                                                ColAut = %s 
                                                 
                            where placa = %s",
                    $$this->labAdodb->Param("Personas_PK_cedula"),
                    $$this->labAdodb->Param("modelo"),
                    $$this->labAdodb->Param("ColAut"),
                    
                    $this->labAdodb->Param("placa"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["Personas_PK_cedula"]      = $InfAuto->getPersonas_PK_cedula();
            $valores["modelo"]                  = $InfAuto->getmodelo();
            $valores["ColAut"]                  = $InfAuto->getColAut();
        
            $valores["placa"]                   = $InfAuto->getplaca();
            
            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo actualizar el registro (Error generado en el metodo update de la clase InfAutoDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //elimina una persona en la base de datos
    //***********************************************************

    public function delete(InfAuto $InfAuto) {

        global $labAdodb;
        try {
            $sql = sprintf("delete from InfAuto where  placa = %s",
                            $this->labAdodb->Param("placa"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["placa"] = $InfAuto->getplaca();

            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo eliminar el registro (Error generado en el metodo delete de la clase InfAutoDao), error:'.$e->getMessage());
        }
    }

    //***********************************************************
    //busca a una persona en la base de datos
    //***********************************************************

    public function searchById(InfAuto $InfAuto) {

        global $labAdodb;
        $returnInfAuto = null;
        try {
            $sql = sprintf("select * from InfAuto where  placa = %s",
                            $this->labAdodb->Param("placa"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["placa"] = $InfAuto->getplaca();

            $resultSql = $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
            
            if ($resultSql->RecordCount() > 0) {
                $returnInfAuto= InfAuto::createNullInfAuto();
                $returnInfAuto->setplaca($resultSql->Fields("placa"));
                $returnInfAuto->setPersonas_PK_cedula($resultSql->Fields("Personas_PK_cedula"));
                $returnInfAuto->setmodelo($resultSql->Fields("modelo"));
                $returnInfAuto->setColAut($resultSql->Fields("ColAut"));

                
            }
        } catch (Exception $e) {
            throw new Exception('No se pudo consultar el registro (Error generado en el metodo searchById de la clase InfAutoDao), error:'.$e->getMessage());
        }
        return $returnInfAuto;
    }

    //***********************************************************
    //obtiene la información de las personas en la base de datos
    //***********************************************************
    
    public function getAll() {

        global $labAdodb;
        try {
            $sql = sprintf("select * from InfAuto");
            $resultSql = $this->labAdodb->Execute($sql);
            return $resultSql;
        } catch (Exception $e) {
            throw new Exception('No se pudo obtener los registros (Error generado en el metodo getAll de la clase InfAutoDao), error:'.$e->getMessage());
        }
    }

}
