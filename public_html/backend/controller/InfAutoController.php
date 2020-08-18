<?php

require_once("../bo/InfAutoBo.php");
require_once("../domain/InfAuto.php");


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
        $myInfAutoBo = new InfAutoBo();
        $myInfAuto = InfAuto::createNullInfAuto();

        //***********************************************************
        //choose the action
        //***********************************************************

        if ($action === "add_InfAuto" or $action === "update_InfAuto") {
            //se valida que los parametros hayan sido enviados por post
            if ((filter_input(INPUT_POST, 'placa') != null) && (filter_input(INPUT_POST, 'Personas_PK_cedula') != null) && (filter_input(INPUT_POST, 'modelo') != null) && (filter_input(INPUT_POST, 'ColAut') != null)) {
                $myInfAuto->setplaca(filter_input(INPUT_POST, 'placa'));
                $myInfAuto->setPersonas_PK_cedula(filter_input(INPUT_POST, 'Personas_PK_cedula'));
                $myInfAuto->setmodelo(filter_input(INPUT_POST, 'modelo'));
                $myInfAuto->setColAut(filter_input(INPUT_POST, 'ColAut'));


           
                if ($action == "add_InfAuto") {
                    $myInfAutoBo->add($myInfAuto);
                    echo('M~Registro Incluido Correctamente');
                }
                if ($action == "update_InfAuto") {
                    $myInfAutoBo->update($myInfAuto);
                    echo('M~Registro Modificado Correctamente');
                }
            }
        }

        //***********************************************************
        //***********************************************************

        if ($action === "showAll_InfAuto") {//accion de consultar todos los registros
            $resultDB   = $myInfAutoBo->getAll();
            $json       = json_encode($resultDB->GetArray());
            $resultado = '{"data": ' . $json . '}';
            if($resultDB->RecordCount() === 0){
                $resultado = '{"data": []}';
            }
            echo $resultado;
        }

        //***********************************************************
        //***********************************************************

        
        if ($action === "show_InfAuto") {//accion de mostrar cliente por ID
            //se valida que los parametros hayan sido enviados por post
            if (filter_input(INPUT_POST, 'placa') != null) {
                $myInfAuto->setplaca(filter_input(INPUT_POST, 'placa'));
                $myInfAuto = $myInfAutoBo->searchById($myInfAuto);
                if ($myInfAuto != null) {
                    echo json_encode(($myInfAuto));
                } else {
                    echo('E~NO Existe un cliente con el ID especificado');
                }
            }
        }

        //***********************************************************
        //***********************************************************

        if ($action === "delete_InfAuto") {//accion de eliminar cliente por ID
            //se valida que los parametros hayan sido enviados por post
            if (filter_input(INPUT_POST, 'placa') != null) {
                $myInfAuto->setplaca(filter_input(INPUT_POST, 'placa'));
                $myInfAutoBo->delete($myInfAuto);
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
