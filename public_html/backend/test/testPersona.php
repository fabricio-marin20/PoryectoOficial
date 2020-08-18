<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once ("../bo/personasBo.php");
require_once ("../domain/personas.php");

$obj_persona = new Personas();
$obj_persona->setPK_cedula(177998);
$obj_persona->setNombre("Este mod");
$obj_persona->setApellido1("rita");
$obj_persona->setApellido2("Fa");
$obj_persona->setFecNacimiento("150830");
$obj_persona->setCorreo("fabri@gmail.com");
$obj_persona->setUsu("fabo-02");
$obj_persona->setContrasena("123456");
$obj_persona->setTel(86161349);
$obj_persona->setTipoUsuario(2);

$bo_persona = new PersonasBo();

$operacion = 2; //variable para pruebas

switch ($operacion) {
    case 1: //Prueba para guardar en la base de datos
        $bo_persona->add($obj_persona);
        echo("<h1>Prueba de agregar exitosa</h1>");
    break;

    case 2: //Prueba para modificar en la base de datos
        $bo_persona->update($obj_persona);
        echo("<h1>Prueba de modificar exitosa</h1>");
    break;

    case 3: //Prueba para eliminar en la base de datos
        $bo_persona->delete($obj_persona);
        echo("<h1>Prueba de eliminar exitosa</h1>");
    break;

    case 4: //Prueba para consultar en la base de datos
        $personaConsultada = $bo_persona->searchById($obj_persona);
        echo("<h1>Prueba de consultar por ID exitosa exitosa</h1>");
        echo (json_encode($personaConsultada));
    break;

    case 5: //Prueba para consultar todos en la base de datos
        $resutlado = $bo_persona->getAll();
        echo("<h1>Prueba de consultar todos los registros exitosa</h1>");
        echo (json_encode($resutlado->GetArray()));
    break;

    default:
    break;
}
