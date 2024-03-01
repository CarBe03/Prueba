<?php
error_reporting(0);
/*TODO: Requerimientos */
require_once('../config/sesiones.php');
require_once("../models/empleado.models.php");
//require_once("../models/Accesos.models.php");
$Empleado = new Empleado;
//$Accesos = new Accesos;   
switch ($_GET["op"]) {
        /*TODO: Procedimiento para listar todos los registros */
    case 'todos':
        $datos = array();
        $datos = $Empleado->todos();
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;
        /*TODO: Procedimiento para sacar un registro */
    case 'uno':
        $id_empleado = $_POST["id_empleado"];
        $datos = array();
        $datos = $Empleado->uno($id_empleado);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;
    case "unoconcargo":
        $Cargo = $_POST["cargo"];
        $datos = array();
        $datos = $Empleado->unoconcargo($cargo);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;
    case "unoconsalario":
        $Salario = $_POST["Salario"];
        $datos = array();
        $datos = $Empleado->unoconsalario($Salario);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;
        /*TODO: Procedimiento para insertar */
    case 'insertar':
        $nombre = $_POST["nombre"];
        $cargo = $_POST["cargo"];
        $salario = $_POST["salario"];
        $fecha_contratacion = $_POST["fecha_contratacion"];
        $datos = array();
        $datos = $Empleado->Insertar($nombre, $cargo, $salario, $fecha_contratacion);
        echo json_encode($datos);
        break;
        /*TODO: Procedimiento para actualizar */
    case 'actualizar':
        $id_empleado = $_POST["id_empleado"];
        $nombre = $_POST["nombre"];
        $cargo = $_POST["cargo"];
        $salario = $_POST["salario"];
        $datos = array();
        $datos = $Empleado->Actualizar($id_empleado, $nombre, $cargo, $salario);
        echo json_encode($datos);
        break;
        /*TODO: Procedimiento para eliminar */
    case 'eliminar':
        $id_empleado = $_POST["id_empleado"];
        $datos = array();
        $datos = $Empleado->Eliminar($id_empleado);
        echo json_encode($datos);
        break;
       
    }
