function init() {
    $("#form_proyectos").on("submit", (e) => {
      GuardarEditar(e);
    });
  }
  var ruta = "../../controllers/proyecto.controllers.php?op=";
  $().ready(() => {
    CargaLista();
  });
  
  var CargaLista = () => {
    var html = "";
    $.get(ruta + "todos", (ListProyecto) => {
        ListProyecto = JSON.parse(ListProyecto);
      $.each(ListProyecto, (index, proyecto) => {
        html += `<tr>
              <td>${index + 1}</td>
              <td>${proyecto.nombre_proyecto}</td>
              <td>${proyecto.fecha_inicio}</td>
              <td>${proyecto.duracion}</td>
              <td>${proyecto.cliente}</td>
  <td>
  <button class='btn btn-primary' onclick='uno(${
          proyecto.id_proyecto
        })'   data-bs-toggle="modal" data-bs-target="#ModalProyectos">Editar</button>
  <button class='btn btn-danger' onclick='eliminar(${
          proyecto.id_proyecto
        })'>Eliminar</button>
              `;
      });
      $("#ListaProyectos").html(html);
    });
  };
  
  var GuardarEditar = (e) => {
    e.preventDefault();
    var DatosFormularioProyecto = new FormData($("#form_proyectos")[0]);
    var accion = "";
  
    if (document.getElementById("id_proyecto").value != "") {
      accion = ruta + "actualizar";
    } else {
      accion = ruta + "insertar";
    }
    $.ajax({
      url: accion,
      type: "post",
      data: DatosFormularioProyecto,
      processData: false,
      contentType: false,
      cache: false,
      success: (respuesta) => {
        console.log(respuesta);
        respuesta = JSON.parse(respuesta);
        if (respuesta == "ok") {
          Swal.fire({
            title: "Proyecto!",
            text: "Se guardó con éxito",
            icon: "success",
          });
          CargaLista();
          LimpiarCajas();
        } else {
          Swal.fire({
            title: "Proyecto!",
            text: "Error al guradar",
            icon: "error",
          });
        }
      },
    });
  };
  
  var uno = async (id_proyecto) => {
 
    document.getElementById("tituloModal").innerHTML = "Actualizar Proyecto";
    $.post(ruta + "uno", { id_proyecto: id_proyecto }, (proyecto) => {
      proyecto = JSON.parse(proyecto);
      document.getElementById("id_proyecto").value = proyecto.id_proyecto;
      document.getElementById("nombre_proyecto").value = proyecto.nombre_proyecto;
      document.getElementById("fecha_inicio").value = proyecto.fecha_inicio;
      document.getElementById("duracion").value = proyecto.duracion;
      document.getElementById("cliente").value = proyecto.cliente;
    
  
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
  
  
  var eliminar = (id_proyecto) => {
    Swal.fire({
      title: "Proyectos",
      text: "Esta segurpo que desea eliminar el Proyecto",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Eliminar",
    }).then((result) => {
      if (result.isConfirmed) {
        $.post(ruta + "eliminar", { id_proyecto: id_proyecto }, (respuesta) => {
          respuesta = JSON.parse(respuesta);
          if (respuesta == "ok") {
            CargaLista();
            Swal.fire({
              title: "Proyecto!",
              text: "Se emliminó con éxito",
              icon: "success",
            });
          } else {
            Swal.fire({
              title: "Proyecto!",
              text: "Error al guradar",
              icon: "error",
            });
          }
        });
      }
    });
  };
  
  var LimpiarCajas = () => {
    document.getElementById("id_proyecto").value = "";
    document.getElementById("nombre_proyecto").value = "";
    document.getElementById("fecha_inicio").value = "";
    document.getElementById("duracion").value = "";
    document.getElementById("cliente").value = "";
    document.getElementById("tituloModal").innerHTML = "Insertar Proyecto";
    $("#ModalProyectos").modal("hide");
  };
  init();
  