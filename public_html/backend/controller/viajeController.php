<?php

require_once("../bo/ViajeBo.php");
require_once("../domain/Viaje.php");


/**
 * This class contain all services methods of the table Personas
 * @author ChGari
 * Date Last  modification: Fri Jul 24 11:28:43 CST 2020
 * Comment: It was created
 *
 */
//************************************************************
// Personas Controller 
//************************************************************

if (filter_input(INPUT_POST, 'action') != null) {
    $action = filter_input(INPUT_POST, 'action');

    try {
        $myViajeBo = new ViajeBo();
        $myViaje = Viaje::createNullViaje();

        //***********************************************************
        //choose the action
        //***********************************************************

        if ($action === "add_Viaje" or $action === "update_Viaje") {
            //se valida que los parametros hayan sido enviados por post
            if ((filter_input(INPUT_POST, 'PK_Viaje') != null) && (filter_input(INPUT_POST, 'Personas_PK_cedula') != null) && (filter_input(INPUT_POST, 'Chofer') != null) && (filter_input(INPUT_POST, 'Pasejero') != null) && (filter_input(INPUT_POST, 'Km') != null) && (filter_input(INPUT_POST, 'LonIni') != null) && (filter_input(INPUT_POST, 'LatIni') != null) && (filter_input(INPUT_POST, 'LonFin') != null)&& (filter_input(INPUT_POST, 'LatFin') != null)) {
                $myViaje->setPK_Viaje(filter_input(INPUT_POST, 'PK_Viaje'));
                $myViaje->setPersonas_PK_cedula(filter_input(INPUT_POST, 'Personas_PK_cedula'));
                $myViaje->setChofer(filter_input(INPUT_POST, 'Chofer'));
                $myViaje->setPasejero(filter_input(INPUT_POST, 'Pasejero'));
                $myViaje->setKm(filter_input(INPUT_POST, 'Km'));
                $myViaje->setLonIni(filter_input(INPUT_POST, 'LonIni'));
                $myViaje->setLatIni(filter_input(INPUT_POST, 'LatIni'));
                $myViaje->setLonFin(filter_input(INPUT_POST, 'LonFin'));
                $myViaje->setLatFin(filter_input(INPUT_POST, 'LatFin'));
                
           
                if ($action == "add_Viaje") {
                    $myViajeBo->add($myViaje);
                    echo('M~Registro Incluido Correctamente');
                }
                if ($action == "update_Viaje") {
                    $myViajeBo->update($myViaje);
                    echo('M~Registro Modificado Correctamente');
                }
            }
        }

        //***********************************************************
        //***********************************************************

        if ($action === "showAll_Viaje") {//accion de consultar todos los registros
            $resultDB   = $myViajeBo->getAll();
            $json       = json_encode($resultDB->GetArray());
            $resultado = '{"data": ' . $json . '}';
            if($resultDB->RecordCount() === 0){
                $resultado = '{"data": []}';
            }
            echo $resultado;
        }

        //***********************************************************
        //***********************************************************

        
        if ($action === "show_Viaje") {//accion de mostrar cliente por ID
            //se valida que los parametros hayan sido enviados por post
            if (filter_input(INPUT_POST, 'PK_Viaje') != null) {
                $myViaje->setPK_Viaje(filter_input(INPUT_POST, 'PK_Viaje'));
                $myViaje = $myViajeBo->searchById($myViaje);
                if ($myViaje != null) {
                    echo json_encode(($myViaje));
                } else {
                    echo('E~NO Existe un cliente con el ID especificado');
                }
            }
        }

        //***********************************************************
        //***********************************************************

        if ($action === "delete_Viaje") {//accion de eliminar cliente por ID
            //se valida que los parametros hayan sido enviados por post
            if (filter_input(INPUT_POST, 'PK_Viaje') != null) {
                $myViaje->setPK_Viaje(filter_input(INPUT_POST, 'PK_Viaje'));
                $myViajeBo->delete($myViaje);
                echo('M~Registro Fue Eliminado Correctamente');
            }
        }

        //***********************************************************
        //se captura cualquier error generado
        //***********************************************************
    } catch (Exception $e) { //exception generated in the business object..
        echo("E~" . $e->getMessage());
    }
} else {
    echo('M~Parametros no enviados desde el formulario'); //se codifica un mensaje para enviar
}
