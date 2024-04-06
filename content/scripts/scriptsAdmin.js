$(function () {
  ///////////////////////SECCION GESTION EMPLEADOS ADMINISTRACION///////////////////////
  var tablaEmpleados = $("#tblEmpleados").DataTable({
    responsive: true,
    autoWidth: true,
    columnDefs: [
      { responsivePriority: 1, targets: [-1, -6] },
      {
        responsivePriority: 2,
        targets: [-1, -2],
      },
    ],
    deferRender: true,
  });

  var botonPersonalizado =
    '<button id="crearEmpleado" data-bs-toggle="modal" data-bs-target="#staticBackdropCrearEmpleados" class="btn btn-primary">Crear Empleado</button>';
  $("#tblEmpleados_wrapper .dataTables_filter").prepend(botonPersonalizado);

  $("#crearEmpleado").click(function () {
 
    $.ajax({
      url: "ajax/detallesCategoria.php",
      dataType: "json",
      success: function (respuesta) {
        
        $("#idCategoriaC").html("");
        for (var i = 0; i < respuesta.length; i++) {
          $("#idCategoriaC").append(
            "<option value='" +
              respuesta[i]["idCategoria"] +
              "'>" +
              respuesta[i]["nombreCategoria"] +
              "</option>"
          );
        }
        $("#idCategoriaC").append("<option selected>--seleccione--</option>");
      },
      error: function () {
        alert("error");
      },
    });
  });

  $("#editarEmpleado").click(function () {
    $(".btn-edicion").removeClass("boton-oculto");
    $("#editarEmpleado").addClass("boton-oculto");
    $("#guardarEmpleado").removeClass("boton-oculto");
    $("#cancelarGuardarEmpleado").removeClass("boton-oculto");
  });
  $(".cancelarGuardarEmpleado").click(function () {
    $("#nombre").attr("disabled", true);
    $("#direccion").attr("disabled", true);
    $("#ciudad").attr("disabled", true);
    $("#pais").attr("disabled", true);
    $("#telefono").attr("disabled", true);
    $("#usuario").attr("disabled", true);
    $("#contrasenna").attr("disabled", true);
    $("#email").attr("disabled", true);
    $("#idCategoria").attr("disabled", true);
    $("#jefe").attr("disabled", true);
    ///////////////////////////
    $("#nombre").removeClass("activo");
    $("#direccion").removeClass("activo");
    $("#ciudad").removeClass("activo");
    $("#pais").removeClass("activo");
    $("#telefono").removeClass("activo");
    $("#usuario").removeClass("activo");
    $("#contrasenna").removeClass("activo");
    $("#email").removeClass("activo");
    $("#idCategoria").removeClass("activo");
    $("#jefe").removeClass("activo");
  })
  $("#cancelarGuardarEmpleado").click(function () {
    $(".btn-edicion").addClass("boton-oculto");
    $("#guardarEmpleado").addClass("boton-oculto");
    $("#cancelarGuardarEmpleado").addClass("boton-oculto");
    $("#editarEmpleado").removeClass("boton-oculto");

    $("#nombre").attr("disabled", true);
    $("#direccion").attr("disabled", true);
    $("#ciudad").attr("disabled", true);
    $("#pais").attr("disabled", true);
    $("#telefono").attr("disabled", true);
    $("#usuario").attr("disabled", true);
    $("#contrasenna").attr("disabled", true);
    $("#email").attr("disabled", true);
    $("#idCategoria").attr("disabled", true);
    $("#jefe").attr("disabled", true);
    ///////////////////////////
    $("#nombre").removeClass("activo");
    $("#direccion").removeClass("activo");
    $("#ciudad").removeClass("activo");
    $("#pais").removeClass("activo");
    $("#telefono").removeClass("activo");
    $("#usuario").removeClass("activo");
    $("#contrasenna").removeClass("activo");
    $("#email").removeClass("activo");
    $("#idCategoria").removeClass("activo");
    $("#jefe").removeClass("activo");
  }); 

$("#editarNombreEmpleado").click(function () {
  if ($("#nombre").prop("disabled")) {
    $("#nombre").prop("disabled", false);
    $("#nombre").addClass("activo");
  } else {
    $("#nombre").prop("disabled", true);
    $("#nombre").removeClass("activo");
  }
});

$("#editarDireccion").click(function () {
  if ($("#direccion").prop("disabled")) {
    $("#direccion").prop("disabled", false);
    $("#direccion").addClass("activo");
  } else {
    $("#direccion").prop("disabled", true);
    $("#direccion").removeClass("activo");
  }
});


$("#editarCiudad").click(function () {
  if ($("#ciudad").prop("disabled")) {
    $("#ciudad").prop("disabled", false);
    $("#ciudad").addClass("activo");
  } else {
    $("#ciudad").prop("disabled", true);
    $("#ciudad").removeClass("activo");
  }
});
$("#paisEditar").click(function () {
  if ($("#pais").prop("disabled")) {
    $("#pais").prop("disabled", false);
    $("#pais").addClass("activo");
  } else {
    $("#pais").prop("disabled", true);
    $("#pais").removeClass("activo");
  }
});
$("#editarTelefono").click(function () {
  if ($("#telefono").prop("disabled")) {
    $("#telefono").prop("disabled", false);
    $("#telefono").addClass("activo");
  } else {
    $("#telefono").prop("disabled", true);
    $("#telefono").removeClass("activo");
  }
});

$("#editarUsuario").click(function () {
  if ($("#usuario").prop("disabled")) {
    $("#usuario").prop("disabled", false);
    $("#usuario").addClass("activo");
  } else {
    $("#usuario").prop("disabled", true);
    $("#usuario").removeClass("activo");
  }
});
$("#editarContrasenna").click(function () {
  if ($("#contrasenna").prop("disabled")) {
    $("#contrasenna").prop("disabled", false);
    $("#contrasenna").addClass("activo");
  } else {
    $("#contrasenna").prop("disabled", true);
    $("#contrasenna").removeClass("activo");
  }
});
$("#editarEmail").click(function () {
  if ($("#email").prop("disabled")) {
    $("#email").prop("disabled", false);
    $("#email").addClass("activo");
  } else {
    $("#email").prop("disabled", true);
    $("#email").removeClass("activo");
  }
});
  $("#editarIdCategoria").click(function () {
    if ($("#idCategoria").prop("disabled")) {
      $("#idCategoria").prop("disabled", false);
      $("#idCategoria").addClass("activo");
    } else {
      $("#idCategoria").prop("disabled", true);
      $("#idCategoria").removeClass("activo");
    }
  });
 

  $("#guardarEmpleado").click(function () {
    
    Swal.fire({
      title: "Deseas guardar el registro?",
      text: "Esto modificara la base de datos permanentemente",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Guardar",
    }).then((result) => {
      if (result.isConfirmed) {
        var idEmpleado = $("#idEmpleado").val();
        var nombre = "";
        var direccion = "";
        var ciudad = "";
        var pais = "";
        var telefono = "";
        var usuario = "";
        var contrasenna = "";
        var email = "";
        var idCategoria = "";
       
        if (!$("#nombre").attr("disabled")) {
          nombre = $("#nombre").val();
        }
        if (!$("#direccion").attr("disabled")) {
          direccion = $("#direccion").val();
        }
        if (!$("#ciudad").attr("disabled")) {
          ciudad = $("#ciudad").val();
        }
        if (!$("#pais").attr("disabled")) {
          pais = $("#pais").val();
        }
        if (!$("#telefono").attr("disabled")) {
          telefono = $("#telefono").val();
        }
        if (!$("#usuario").attr("disabled")) {
          usuario = $("#usuario").val();
        }
        if (!$("#contrasenna").attr("disabled")) {
          contrasenna = MD5($("#contrasenna").val());
        }
        if (!$("#email").attr("disabled")) {
          email = $("#email").val();
        }   

        var arrayDatos = {
          idEmpleado: idEmpleado,
          nombre: nombre,
          direccion: direccion,
          ciudad: ciudad,
          pais: pais,
          telefono: telefono,
          usuario: usuario,
          contrasenna: contrasenna,
          email: email,
          idCategoria: idCategoria,
          
        };
      
        var jsonData = JSON.stringify(arrayDatos);

        $.ajax({
          type: "POST",
          url: "ajax/updateEmpleado.php",
          data: "data=" + jsonData, 
          success: function (respuesta) {
            $("#staticBackdrop").modal("hide");

           setTimeout(function () {
              location.reload(true);
            }, 1000);
          },
          error: function () {
            alert("error");
          },
        });

        Swal.fire("Guardado!", "El registro a sido guardado.", "success");
      }
    });
  });
 

  $("#guardaEmpleadoNuevo").click(function () {
    var nombreInput = $("#nombreEmpleadoC").val();
    var direccionInput = $("#direccionC").val();
    var ciudadInput = $("#ciudadC").val();
    var paisInput = $("#paisC").val();
    var telefonoInput = $("#telefonoC").val();
    var usuarioInput = $("#usuarioC").val();
    var contrasennaInput = $("#contrasennaC").val();
    var emailInput = $("#emailC").val();
    var idCategoriaInput = $("#idCategoriaC").val();


    if (nombreInput.trim() === "") {
      $("#nombreEmpleadoC").addClass("input-error");
    }
    if (direccionInput.trim() === "") {
      $("#direccionC").addClass("input-error");
    }
    if (ciudadInput.trim() === "") {
      $("#ciudadC").addClass("input-error");
    }
    if (paisInput.trim() === "") {
      $("#paisC").addClass("input-error");
    }
    if (telefonoInput.trim() === "") {
      $("#telefonoC").addClass("input-error");
    }
    if (usuarioInput.trim() === "") {
      $("#usuarioC").addClass("input-error");
    }
    if (contrasennaInput.trim() === "") {
      $("#contrasennaC").addClass("input-error");
    }
    if (idCategoriaInput.trim() === "--seleccione--") {
      $("#idCategoriaC").addClass("input-error");
    }
    
    if (
      nombreInput.trim() === "" ||
      direccionInput.trim() === "" ||
      ciudadInput.trim() === "" ||
      paisInput.trim() === "" ||
      telefonoInput.trim() === "" ||
      usuarioInput.trim() === "" ||
      contrasennaInput.trim() === "" ||
      idCategoriaInput.trim() === "--seleccione--"
    ) {
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Rellene los campos obligatorios!",
      });
    } else {
      Swal.fire({
        title: "Deseas Crear el registro?",
        text: "Esto modificara la base de datos permanentemente",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Crear",
      }).then((result) => {
        if (result.isConfirmed) {
          var contraseñaEncryptada = MD5($("#contrasennaC").val());

          var arrayDatos = {
            nombreInput: nombreInput,
            direccionInput: direccionInput,
            ciudadInput: ciudadInput,
            paisInput: paisInput,
            telefonoInput: telefonoInput,
            usuarioInput: usuarioInput,
            contrasenna: contraseñaEncryptada,
            emailInput: emailInput,
            idCategoriaInput: idCategoriaInput,
           
          };

          var jsonData = JSON.stringify(arrayDatos);

          $.ajax({
            type: "POST",
            url: "ajax/createEmpleado.php",
            data: "data=" + jsonData, 
            success: function (respuesta) {

              $("#staticBackdropCrearEmpleados").modal("hide");

              setTimeout(function () {
                location.reload(true);
              }, 1000);
            },
            error: function () {
              alert("error");
            },
          });

          Swal.fire("Creado!", "El registro a sido creado.", "success");
        }
      });
    }
  });
  $(".cerrarCreacionEmpleado").click(function () {
    $("#nombreEmpleadoC").removeClass("input-error");
    $("#direccionC").removeClass("input-error");
    $("#ciudadC").removeClass("input-error");
    $("#paisC").removeClass("input-error");
    $("#telefonoC").removeClass("input-error");
    $("#usuarioC").removeClass("input-error");
    $("#contrasennaC").removeClass("input-error");
    $("#emailC").removeClass("input-error");
    $("#idCategoriaC").removeClass("input-error");
    $("#jefeC").removeClass("input-error");
  });

  $(".cerrarEdicionEmpleado").click(function () {
    $("#editarEmpleado").removeClass("boton-oculto");

    $("#guardarEmpleado").addClass("boton-oculto");
    $("#cancelarGuardarEmpleado").addClass("boton-oculto");
    $("#editarNombreEmpleado").addClass("boton-oculto");
    $("#editarDireccion").addClass("boton-oculto");
    $("#editarCiudad").addClass("boton-oculto");
    $("#paisEditar").addClass("boton-oculto");
    $("#editarTelefono").addClass("boton-oculto");
    $("#editarUsuario").addClass("boton-oculto");
    $("#editarContrasenna").addClass("boton-oculto");
    $("#editarEmail").addClass("boton-oculto");
    $("#editarIdCategoria").addClass("boton-oculto");
    $("#editarJefe").addClass("boton-oculto");

    $("#nombreEmpleado").attr("disabled", true);
    $("#direccion").attr("disabled", true);
    $("#ciudad").attr("disabled", true);
    $("#pais").attr("disabled", true);
    $("#telefono").attr("disabled", true);
    $("#usuario").attr("disabled", true);
    $("#contrasenna").attr("disabled", true);
    $("#email").attr("disabled", true);
    $("#idCategoria").attr("disabled", true);
    $("#jefe").attr("disabled", true);
  });
  ///////////////EDICION MARCAJE/////////////////////
  $("#editarMarcaje").click(function () {
    $(".btn-edicion").removeClass("boton-oculto");
    $("#editarMarcaje").addClass("boton-oculto");
    $("#guardarMarcaje").removeClass("boton-oculto");
    $("#cancelarGuardarMarcaje").removeClass("boton-oculto");
  });

  $("#cancelarGuardarMarcaje").click(function () {
    $("#horaEntrada").attr("disabled", true);
    $("#horaSalida").attr("disabled", true);
    $("#comentario").attr("disabled", true);
    $("#horasJornada").attr("disabled", true);
    $("#jornadaFinalizada").attr("disabled", true);
    $("#horaPausa").attr("disabled", true);
    $("#horaFinPausa").attr("disabled", true);
   
    ///////////////////////////////////
    $("#horaEntrada").removeClass("activo");
    $("#horaSalida").removeClass("activo");
    $("#comentario").removeClass("activo");
    $("#horasJornada").removeClass("activo");
    $("#jornadaFinalizada").removeClass("activo");
    $("#horaPausa").removeClass("activo");
    $("#horaFinPausa").removeClass("activo");
  })

  $("#cancelarGuardarMarcaje").click(function () {
    $(".btn-edicion").addClass("boton-oculto");
    $("#guardarMarcaje").addClass("boton-oculto");
    $("#cancelarGuardarMarcaje").addClass("boton-oculto");
    $("#editarMarcaje").removeClass("boton-oculto");

    $("#horaEntrada").attr("disabled", true);
    $("#horaSalida").attr("disabled", true);
    $("#comentario").attr("disabled", true);
    $("#horasJornada").attr("disabled", true);
    $("#jornadaFinalizada").attr("disabled", true);
    $("#horaPausa").attr("disabled", true);
    $("#horaFinPausa").attr("disabled", true);
   
    ///////////////////////////////////
    $("#horaEntrada").removeClass("activo");
    $("#horaSalida").removeClass("activo");
    $("#comentario").removeClass("activo");
    $("#horasJornada").removeClass("activo");
    $("#jornadaFinalizada").removeClass("activo");
    $("#horaPausa").removeClass("activo");
    $("#horaFinPausa").removeClass("activo");
   
  });
  $(".cancelarGuardarMarcaje").click(function () {
    $(".btn-edicion").addClass("boton-oculto");
    $("#guardarMarcaje").addClass("boton-oculto");
    $("#cancelarGuardarMarcaje").addClass("boton-oculto");
    $("#editarMarcaje").removeClass("boton-oculto");

    $("#horaEntrada").attr("disabled", true);
    $("#horaSalida").attr("disabled", true);
    $("#comentario").attr("disabled", true);
    $("#horasJornada").attr("disabled", true);
    $("#jornadaFinalizada").attr("disabled", true);
    $("#horaPausa").attr("disabled", true);
    $("#horaFinPausa").attr("disabled", true);
   
    ///////////////////////////////////
    $("#horaEntrada").removeClass("activo");
    $("#horaSalida").removeClass("activo");
    $("#comentario").removeClass("activo");
    $("#horasJornada").removeClass("activo");
    $("#jornadaFinalizada").removeClass("activo");
    $("#horaPausa").removeClass("activo");
    $("#horaFinPausa").removeClass("activo");
   
  });

  $("#editarHoraEntrada").click(function () {
    if ($("#horaEntrada").prop("disabled")) {
      $("#horaEntrada").prop("disabled", false);
      $("#horaEntrada").addClass("activo");
    } else {
      $("#horaEntrada").prop("disabled", true);
      $("#horaEntrada").removeClass("activo");
    }
  });
  $("#editarHoraSalida").click(function () {
    if ($("#horaSalida").prop("disabled")) {
      $("#horaSalida").prop("disabled", false);
      $("#horaSalida").addClass("activo");
    } else {
      $("#horaSalida").prop("disabled", true);
      $("#horaSalida").removeClass("activo");
    }
  });
  $("#editarComentario").click(function () {
    if ($("#comentario").prop("disabled")) {
      $("#comentario").prop("disabled", false);
      $("#comentario").addClass("activo");
    } else {
      $("#comentario").prop("disabled", true);
      $("#comentario").removeClass("activo");
    }
  });
  $("#editarHorasJornada").click(function () {
    if ($("#horasJornada").prop("disabled")) {
      $("#horasJornada").prop("disabled", false);
      $("#horasJornada").addClass("activo");
    } else {
      $("#horasJornada").prop("disabled", true);
      $("#horasJornada").removeClass("activo");
    }
  });
  $("#editarJornadaFinalizada").click(function () {
    if ($("#jornadaFinalizada").prop("disabled")) {
      $("#jornadaFinalizada").prop("disabled", false);
      $("#jornadaFinalizada").addClass("activo");
    } else {
      $("#jornadaFinalizada").prop("disabled", true);
      $("#jornadaFinalizada").removeClass("activo");
    }
  });

  $("#editarHoraPausa").click(function () {
    if ($("#horaPausa").prop("disabled")) {
      $("#horaPausa").prop("disabled", false);
      $("#horaPausa").addClass("activo");
    } else {
      $("#horaPausa").prop("disabled", true);
      $("#horaPausa").removeClass("activo");
    }
  });
  $("#editarFinPausa").click(function () {
    if ($("#horaFinPausa").prop("disabled")) {
      $("#horaFinPausa").prop("disabled", false);
      $("#horaFinPausa").addClass("activo");
    } else {
      $("#horaFinPausa").prop("disabled", true);
      $("#horaFinPausa").removeClass("activo");
    }
  });

  $("#guardarMarcaje").click(function () {
    Swal.fire({
      title: "Deseas guardar la modificacion?",
      text: "Esto modificara la base de datos permanentemente",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Guardar",
    }).then((result) => {
      if (result.isConfirmed) {
        var idMarcaje = $("#idMarcaje").val();
        var horaEntrada = "";
        var horaSalida = "";
        var comentario = "";
        var horasJornada = "";
        var jornadaFinalizada = 0;
        var horaPausa = "";
        var horaFinPausa = "";

        if (!$("#horaEntrada").attr("disabled")) {
          horaEntrada = $("#horaEntrada").val();
        }
        if (!$("#horaSalida").attr("disabled")) {
          horaSalida = $("#horaSalida").val();
        }
        if (!$("#comentario").attr("disabled")) {
          comentario = $("#comentario").val();
        }
        if (!$("#horasJornada").attr("disabled")) {
          horasJornada = $("#horasJornada").val();
        }
        if (!$("#jornadaFinalizada").attr("disabled")) {
          jornadaFinalizada = $("#jornadaFinalizada option:selected").val();
        }
        if (!$("#horaPausa").attr("disabled")) {
          horaPausa = $("#horaPausa").val();
        }
        if (!$("#horaFinPausa").attr("disabled")) {
          horaFinPausa = $("#horaFinPausa").val();
        }

        var arrayDatos = {
          idMarcaje: idMarcaje,
          horaEntrada: horaEntrada,
          horaSalida: horaSalida,
          comentario: comentario,
          horasJornada: horasJornada,
          jornadaFinalizada: jornadaFinalizada,
          horaPausa: horaPausa,
          horaFinPausa: horaFinPausa,
        };

        var jsonData = JSON.stringify(arrayDatos);

        $.ajax({
          type: "POST",
          url: "ajax/updateMarcaje.php",
          data: "data=" + jsonData, 
          success: function (respuesta) {
            $("#staticBackdrop").modal("hide");
         
            setTimeout(function () {
              location.reload(true);
            }, 1000);
          },
          error: function () {
            alert("error");
          },
        });

        Swal.fire("Guardado!", "El registro a sido guardado.", "success");
      }
    });
  });

  $("#tblMarcaje").DataTable({
    responsive: true,
    autoWidth: true,
    columnDefs: [
        { responsivePriority: 1, targets: [-1, -6] },
        { responsivePriority: 2, targets: "_all" },
    ],
    order: [[0, 'desc']]
});


  ///////////////////FIN SECCION ADMINISTRACION //////////////////////
});
