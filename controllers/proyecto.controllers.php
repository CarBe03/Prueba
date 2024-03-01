<?php
error_reporting(0);
/*TODO: Requerimientos */
require_once('../config/sesiones.php');
require_once("../models/proyecto.models.php");
//require_once("../models/Accesos.models.php");
$Proyecto = new Proyecto;
//$Accesos = new Accesos;   
switch ($_GET["op"]) {
        /*TODO: Procedimiento para listar todos los registros */
    case 'todos':
        $datos = array();
        $datos = $Proyecto->todos();
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;
        /*TODO: Procedimiento para sacar un registro */
    case 'uno':
        $id_proyecto = $_POST["id_proyecto"];
        $datos = array();
        $datos = $Proyecto->uno($id_proyecto);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;
    case "unoconnombre":
        $nombre_proyecto = $_POST["nombre_proyecto"];
        $datos = array();
        $datos = $Proyecto->unoconnombre($nombre_proyecto);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;

        /*TODO: Procedimiento para insertar */
    case 'insertar':
        $nombre_proyecto = $_POST["nombre_proyecto"];
        $fecha_inicio = $_POST["fecha_inicio"];
        $duracion = $_POST["duracion"];
        $cliente = $_POST["cliente"];
        $datos = array();
        $datos = $Proyecto->Insertar($nombre_proyecto, $fecha_inicio, $duracion, $cliente);
        echo json_encode($datos);
        break;
        /*TODO: Procedimiento para actualizar */
    case 'actualizar':
        $id_proyecto = $_POST["id_proyecto"];
        $nombre_proyecto = $_POST["nombre_proyecto"];
        $fecha_inicio = $_POST["fecha_inicio"];
        $duracion = $_POST["duracion"];
        $cliente = $_POST["cliente"];
        $datos = array();
        $datos = $Proyecto->Actualizar($id_proyecto, $nombre_proyecto, $fecha_inicio, $duracion,$cliente);
        echo json_encode($datos);
        break;
        /*TODO: Procedimiento para eliminar */
    case 'eliminar':
        $id_proyecto = $_POST["id_proyecto"];
        $datos = array();
        $datos = $Proyecto->Eliminar($id_proyecto);
        echo json_encode($datos);
        break;
       
    }
