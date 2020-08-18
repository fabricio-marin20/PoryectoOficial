<?php

require_once("../bo/choferBo.php");
require_once("../domain/chofer.php");


/**
 * This class contain all services methods of the table Personas
 * @author ChGari
 * Date Last  modification: Fri Jul 24 11:28:43 CST 2020
 * Comment: It was created
 *
 */
//************************************************************
// chofer Controller 
//************************************************************

if (filter_input(INPUT_POST, 'action') != null) {
    $action = filter_input(INPUT_POST, 'action');

    try {
        $mychoferBo = new ChoferBo();
        $mychofer = chofer::createNullchofer();

        //***********************************************************
        //choose the action
        //***********************************************************

        if ($action === "add_chofer" or $action === "update_chofer") {
            //se valida que los parametros hayan sido enviados por post
            if ((filter_input(INPUT_POST, 'Pk_Chofer') != null) && (filter_input(INPUT_POST, 'Personas_PK_cedula') != null) && (filter_input(INPUT_POST, 'Vencimiento') != null) && (filter_input(INPUT_POST, 'licencia') != null)) {
                $mychofer->setPk_Chofer(filter_input(INPUT_POST, 'Pk_Chofer'));
                $mychofer->setPersonas_PK_cedula(filter_input(INPUT_POST, 'Personas_PK_cedula'));
                $mychofer->setVencimiento(filter_input(INPUT_POST, 'Vencimiento'));
                $mychofer->setlicencia(filter_input(INPUT_POST, 'licencia'));

           
                if ($action == "add_chofer") {
                    $mychoferBo->add($mychofer);
                    echo('M~Registro Incluido Correctamente');
                }
                if ($action == "update_chofer") {
                    $mychoferBo->update($mychofer);
                    echo('M~Registro Modificado Correctamente');
                }
            }
        }

        //***********************************************************
        //***********************************************************

        if ($action === "showAll_chofer") {//accion de consultar todos los registros
            $resultDB   = $mychoferBo->getAll();
            $json       = json_encode($resultDB->GetArray());
            $resultado = '{"data": ' . $json . '}';
            if($resultDB->RecordCount() === 0){
                $resultado = '{"data": []}';
            }
            echo $resultado;
        }

        //***********************************************************
        //***********************************************************

        
        if ($action === "show_chofer") {//accion de mostrar cliente por ID
            //se valida que los parametros hayan sido enviados por post
            if (filter_input(INPUT_POST, 'Pk_Chofer') != null) {
                $myPchofer->setPK_cedula(filter_input(INPUT_POST, 'Pk_Chofer'));
                $mychofer = $mychoferBo->searchById($mychofer);
                if ($mychofer != null) {
                    echo json_encode(($mychofer));
                } else {
                    echo('E~NO Existe un cliente con el ID especificado');
                }
            }
        }

        //***********************************************************
        //***********************************************************

        if ($action === "delete_chofer") {//accion de eliminar cliente por ID
            //se valida que los parametros hayan sido enviados por post
            if (filter_input(INPUT_POST, 'Pk_Chofer') != null) {
                $mychofer->setPk_Chofer(filter_input(INPUT_POST, 'Pk_Chofer'));
                $mychoferBo->delete($mychofer);
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
