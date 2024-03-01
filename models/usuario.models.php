<?php
//TODO: Requerimientos 
require_once('../config/conexion.php');

class Usuarios
{

    public function Insertar($Nombres, $Apellidos, $Correo, $Contrasenia)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "INSERT into Usuarios(Nombres,Apellidos,Correo,Contrasenia) values ( '$Nombres', '$Apellidos', '$Correo', '$Contrasenia')";
        $datos = mysqli_query($con, $cadena);
        return $datos;
        $con->close();
    }

    public function todos()
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT Usuarios.idUsuarios, Usuarios.Nombres, Usuarios.Contrasenia, Usuarios.Apellidos, Usuarios.Correo from Usuarios";
        $datos = mysqli_query($con, $cadena);
        return $datos;
        $con->close();
    }
    public function uno($idUsuarios)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT count(*) as numero FROM `Usuarios` WHERE `idUsuarios`='$idUsuarios'";
        $datos = mysqli_query($con, $cadena);
        return $datos;
        $con->close();
    }
    /*public function unoconCedula($Cedula)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT count(*) as numero FROM `Usuarios` WHERE `Cedula`='$Cedula'";
        $datos = mysqli_query($con, $cadena);
        return $datos;
        $con->close();
    }*/
    public function unoconCorreo($Correo)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT count(*) as numero FROM `Usuarios` WHERE `Correo`='$Correo'";
        $datos = mysqli_query($con, $cadena);
        return $datos;
        $con->close();
    }
    /*TODO: Procedimiento para actualizar */
    public function Actualizar($idUsuarios, $Nombres, $Apellidos, $Correo, $Contrasenia)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "update Usuarios set Nombres='$Nombres',Apellidos='$Apellidos',Correo='$Correo',Contrasenia='$Contrasenia' where idUsuarios= $idUsuarios";
        if (mysqli_query($con, $cadena)) {
            $id = mysqli_insert_id($con);
            $usuImagen = new Usuarios;

        } else {
            return 'error al actualizar el registro';
        }
        $con->close();
    }
    /*TODO: Procedimiento para Eliminar */
    public function Eliminar($idUsuarios)
    {
        $Usuar = new Usuari();
        $usro = $Usuar->Eliminar($idUsuarios);
        if ($usro == 'ok') {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoConectar();
            $cadena = "DELETE FROM `usuarios` WHERE idUsuarios = $idUsuarios";

            return "ok";
        } else {
            return false;
        }
        $con->close();
    }

    public function login($Correo)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoConectar();
            $cadena = "SELECT idUsuarios, Nombres, Contrasenia, Apellidos, Correo FROM Usuarios WHERE Correo = '$Correo'";
            $datos = mysqli_query($con, $cadena);
            return $datos;
        } catch (Throwable $th) {
            return $th->getMessage();
        }
        $con->close();
    }
}


