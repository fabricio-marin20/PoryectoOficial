<?php

require_once("../bo/direccionesBo.php");
require_once("../domain/direcciones.php");


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
        $myDireccionesBo = new DireccionesBo();
        $myDirecciones = Direcciones::createNullDirecciones();

        //***********************************************************
        //choose the action
        //***********************************************************

        if ($action === "add_direcciones" or $action === "update_direcciones") {
            //se valida que los parametros hayan sido enviados por post
            if ((filter_input(INPUT_POST, 'PKA_idDireccion') != null) && (filter_input(INPUT_POST, 'Personas_PK_cedula') != null) && (filter_input(INPUT_POST, 'latitud') != null) && (filter_input(INPUT_POST, 'longitud') != null)) {
                $myDirecciones->setPKA_idDireccion(filter_input(INPUT_POST, 'PKA_idDireccion'));
                $myDirecciones->setPersonas_PK_cedula(filter_input(INPUT_POST, 'Personas_PK_cedula'));
                $myDirecciones->setlatitud(filter_input(INPUT_POST, 'latitud'));
                $myDirecciones->setlongitud(filter_input(INPUT_POST, 'longitud'));


           
                if ($action == "add_direcciones") {
                    $myDireccionesBo->add($myDirecciones);
                    echo('M~Registro Incluido Correctamente');
                }
                if ($action == "update_direcciones") {
                    $myDireccionesBo->update($myDirecciones);
                    echo('M~Registro Modificado Correctamente');
                }
            }
        }

        //***********************************************************
        //***********************************************************

        if ($action === "showAll_direcciones") {//accion de consultar todos los registros
            $resultDB   = $myDireccionesBo->getAll();
            $json       = json_encode($resultDB->GetArray());
            $resultado = '{"data": ' . $json . '}';
            if($resultDB->RecordCount() === 0){
                $resultado = '{"data": []}';
            }
            echo $resultado;
        }

        //***********************************************************
        //***********************************************************

        
        if ($action === "show_direcciones") {//accion de mostrar cliente por ID
            //se valida que los parametros hayan sido enviados por post
            if (filter_input(INPUT_POST, 'PKA_idDireccion') != null) {
                $myDirecciones->setPK_cedula(filter_input(INPUT_POST, 'PKA_idDireccion'));
                $myDirecciones = $myDireccionesBoBo->searchById($myDirecciones);
                if ($myDirecciones != null) {
                    echo json_encode(($mydirecciones));
                } else {
                    echo('E~NO Existe un cliente con el ID especificado');
                }
            }
        }

        //***********************************************************
        //***********************************************************

        if ($action === "delete_direcciones") {//accion de eliminar cliente por ID
            //se valida que los parametros hayan sido enviados por post
            if (filter_input(INPUT_POST, 'PKA_idDireccion') != null) {
                $myDirecciones->setPK_cedula(filter_input(INPUT_POST, 'PKA_idDireccion'));
                $myDireccionesBoBo->delete($myDirecciones);
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
