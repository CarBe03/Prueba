<?php
//TODO: Requerimientos 
require_once('../config/conexion.php');
class Proyecto
{
    /*TODO: Procedimiento para sacar todos los registros*/
    public function todos()
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT * FROM `proyecto`";
        $datos = mysqli_query($con, $cadena);
        return $datos;
        $con->close();
    }
    /*TODO: Procedimiento para sacar un registro del*/
    public function uno($id_proyecto)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT * FROM proyecto WHERE id_proyecto = 1 LIMIT 1";
        $datos = mysqli_query($con, $cadena);
        return $datos;
        $con->close();
    }
    public function unoconnombre($nombre_proyecto)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT count(*) as numero FROM `proyecto` WHERE `nombre_proyecto`='$nombre_proyecto'";
        $datos = mysqli_query($con, $cadena);
        return $datos;
        $con->close();
    }
    
    /*TODO: Procedimiento para insertar */
    public function Insertar( $nombre_proyecto, $fecha_inicio, $duracion, $cliente)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "INSERT INTO `proyecto`(`nombre_proyecto`, `fecha_inicio`, `duracion`, `cliente`) VALUES('$nombre_proyecto','$fecha_inicio','$duracion','$cliente')";
        if (mysqli_query($con, $cadena)) {
            return "ok";
        } else {
            return mysqli_error($con);
        }
        $con->close();
    }
    /*TODO: Procedimiento para actualizar */
    public function Actualizar()
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "";
        if (mysqli_query($con, $cadena)) {
            return "ok";
        } else {
            return 'error al actualizar el registro';
        }
        $con->close();
    }
    /*TODO: Procedimiento para Eliminar */
    public function Eliminar($idAccesos)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "";
        if (mysqli_query($con, $cadena)) {
            return true;
        } else {
            return false;
        }
        $con->close();
    }
}
