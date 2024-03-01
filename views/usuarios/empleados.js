function init() {
    $("#form_empleados").on("submit", (e) => {
      GuardarEditar(e);
    });
  }
  var ruta = "../../controllers/empleado.controllers.php?op=";
  $().ready(() => {
    CargaLista();
  });
  
  var CargaLista = () => {
    var html = "";
    $.get(ruta + "todos", (ListEmpleados) => {
      ListEmpleados = JSON.parse(ListEmpleados);
      $.each(ListEmpleados, (index, empleado) => {
        html += `<tr>
              <td>${index + 1}</td>
              <td>${empleado.Nombre}</td>
              <td>${empleado.Cargo}</td>
              <td>${empleado.Salario}</td>
              <td>${empleado.Fecha_Contratacion}</td>
  <td>
  <button class='btn btn-primary' onclick='uno(${
          empleado.id_empleado
        })'   data-bs-toggle="modal" data-bs-target="#ModalEmpleados">Editar</button>
  <button class='btn btn-danger' onclick='eliminar(${
          empleado.id_empleado
        })'>Eliminar</button>
              `;
      });
      $("#ListaEmpleados").html(html);
    });
  };
  
  var GuardarEditar = (e) => {
    e.preventDefault();
    var DatosFormularioEmpleado = new FormData($("#form_empleados")[0]);
    var accion = "";
  
    if (document.getElementById("id_empleado").value != "") {
      accion = ruta + "actualizar";
    } else {
      accion = ruta + "insertar";
    }
    $.ajax({
      url: accion,
      type: "post",
      data: DatosFormularioEmpleado,
      processData: false,
      contentType: false,
      cache: false,
      success: (respuesta) => {
        console.log(respuesta);
        respuesta = JSON.parse(respuesta);
        if (respuesta == "ok") {
          Swal.fire({
            title: "Empleado!",
            text: "Se guardó con éxito",
            icon: "success",
          });
          CargaLista();
          LimpiarCajas();
        } else {
          Swal.fire({
            title: "Empleado!",
            text: "Error al guradar",
            icon: "error",
          });
        }
      },
    });
  };
  
  var uno = async (id_empleado) => {
 
    document.getElementById("tituloModal").innerHTML = "Actualizar Empleados";
    $.post(ruta + "uno", { id_empleado: id_empleado }, (empleado) => {
      empleado = JSON.parse(empleado);
      document.getElementById("id_empleado").value = empleado.id_empleado;
      document.getElementById("Nombre").value = empleado.Nombre;
      document.getElementById("Cargo").value = empleado.Cargo;
      document.getElementById("Salario").value = empleado.Salario;
      document.getElementById("fecha_contratacion").value = empleado.fecha_contratacion;
    
  
    });
  };
 /* var unoconCedula = () => {
    var cedula = document.getElementById("Cedula").value;
    $.post(ruta + "unoconCedula", { cedula: cedula }, (usuario) => {
      usuario = JSON.parse(usuario);
      if (parseInt(usuario.numero) > 0) {
        Swal.fire({
          title: "Usuarios!",
          text: "Ya existe un usuario con esa cedula",
          icon: "error",
        });
        document.getElementById("Cedula").value = "";
      }
    });
  };*/
 /* var unoconCorreo = () => {
    var Correo = document.getElementById("Correo").value;
    $.post(ruta + "unoconCorreo", { Correo: Correo }, (usuario) => {
      usuario = JSON.parse(usuario);
      if (parseInt(usuario.numero) > 0) {
        Swal.fire({
          title: "Usuarios!",
          text: "Ya existe un usuario con ese correo",
          icon: "error",
        });
        document.getElementById("Correo").value = "";
      }
    });
  };*/
  
  
  var eliminar = (id_empleado) => {
    Swal.fire({
      title: "Empleados",
      text: "Esta segurpo que desea eliminar el empleado",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Eliminar",
    }).then((result) => {
      if (result.isConfirmed) {
        $.post(ruta + "eliminar", { id_empleado: id_empleado }, (respuesta) => {
          respuesta = JSON.parse(respuesta);
          if (respuesta == "ok") {
            CargaLista();
            Swal.fire({
              title: "Empleados!",
              text: "Se emliminó con éxito",
              icon: "success",
            });
          } else {
            Swal.fire({
              title: "Empleados!",
              text: "Error al guradar",
              icon: "error",
            });
          }
        });
      }
    });
  };
  
  var LimpiarCajas = () => {
    document.getElementById("id_empleado").value = "";
    document.getElementById("Nombre").value = "";
    document.getElementById("Cargo").value = "";
    document.getElementById("Salario").value = "";
    document.getElementById("fecha_contratacion").value = "";
    document.getElementById("tituloModal").innerHTML = "Insertar Empleado";
    $("#ModalEmpleados").modal("hide");
  };
  init();
  