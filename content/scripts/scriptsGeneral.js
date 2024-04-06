$(function () {
  $('[data-toggle="tooltip"]').tooltip();
  
  $(".mantenimiento").click(function () {
    Swal.fire({
      icon: "warning",
      title: "¡Seccion en mantenimiento , visitenos proximamente🤙!",
      showConfirmButton: false,
      timer: 3500,
    });
    window.location("marcaje-empleados/");
  });
  ////////////////// SECCION LOGIN ////////////////////
  $("#botonEnviar").click(function () {
    enviarDatos();
  });
  $("#contrasenna").keypress(function (evt) {
    if (evt.keyCode === 13) {
      enviarDatos();
    }
  });

  function enviarDatos() {
    var usuario = $("#usuario").val();
    var contrasena = $("#contrasenna").val();

    //validacion por javascriptantes de hacer trabajar al servidor
    if (
      usuario == "" ||
      contrasena == "" ||
      usuario.indexOf(" ") >= 0 ||
      contrasena.indexOf(" ") >= 0
    ) {
      loginVacio();
      var usuario = $("#usuario").val("");

      var contrasena = $("#contrasenna").val("");
    } else {
     
      var passMd5 = MD5(contrasena);

      $.ajax({
        type: "POST",
        url: "ajax/loginAjax.php",
        data: "usuario=" + usuario + "&contrasenna=" + passMd5,
        success: function (respuesta) {
          if (respuesta == "KO") {
            mostrarAlerta();
          } else {
            window.location.href = "marcaje-empleados/";
          }

        
        },
        error: function () {
          alert("error");
        },
      });
    }
  }

  //////////////////--FIN SECCION LOGIN--////////////////////////
  //////////////////-- SECCION animacion nav--////////////////////////

  $("nav a").click(function (e) {
    e.preventDefault();
    var href = $(this).prop("href");
    var hrefNum = $(this).prop("id");
    var paginaActual = parseInt($(".pagina-actual").data("numero"), 10);
    var direccion = hrefNum > paginaActual ? "left" : "right";
    $(".contenido").hide("slide", { direction: direccion }, 400, function () {
      paginaActual = hrefNum;
      window.location.href = href;
    });
  });

  //////////////////--FIN animacion nav--////////////////////////
  $("#editarDatosEmpleadosD").click(function () {
    $(".btn-edicion").removeClass("boton-oculto");
    $("#editarDatosEmpleadosD").addClass("boton-oculto");
    $("#guardarEmpleadoD").removeClass("boton-oculto");
    $("#cancelarGuardarEmpleadoD").removeClass("boton-oculto");
  });
  $("#cancelarGuardarEmpleadoD").click(function () {
    $(".btn-edicion").addClass("boton-oculto");
    $("#guardarEmpleadoD").addClass("boton-oculto");
    $("#cancelarGuardarEmpleadoD").addClass("boton-oculto");
    $("#editarDatosEmpleadosD").removeClass("boton-oculto");
    $("#nombreD").attr("disabled", true);
    $("#direccionD").attr("disabled", true);
    $("#ciudadD").attr("disabled", true);
    $("#paisD").attr("disabled", true);
    $("#telefonoD").attr("disabled", true);
    $("#usuarioD").attr("disabled", true);
    $("#contrasennaD").attr("disabled", true);

    $("#emailD").removeClass("activo");
    $("#nombreD").removeClass("activo");
    $("#direccionD").removeClass("activo");
    $("#ciudadD").removeClass("activo");
    $("#paisD").removeClass("activo");
    $("#telefonoD").removeClass("activo");
    $("#usuarioD").removeClass("activo");
    $("#contrasennaD").removeClass("activo");
    $("#emailD").removeClass("activo");
  }); //

  $("#editarNombreD").click(function () {
    if ($("#nombreD").prop("disabled")) {
      $("#nombreD").prop("disabled", false);
      $("#nombreD").addClass("activo");
    } else {
      $("#nombreD").prop("disabled", true);
      $("#nombreD").removeClass("activo");
    }
  });
  $("#editarDireccionD").click(function () {
    if ($("#direccionD").prop("disabled")) {
      $("#direccionD").prop("disabled", false);
      $("#direccionD").addClass("activo");
    } else {
      $("#direccionD").prop("disabled", true);
      $("#direccionD").removeClass("activo");
    }
  });


  $("#editarCiudadD").click(function () {
    if ($("#ciudadD").prop("disabled")) {
      $("#ciudadD").prop("disabled", false);
      $("#ciudadD").addClass("activo");
    } else {
      $("#ciudadD").prop("disabled", true);
      $("#ciudadD").removeClass("activo");
    }
  });
  $("#editarPaisD").click(function () {
    if ($("#paisD").prop("disabled")) {
      $("#paisD").prop("disabled", false);
      $("#paisD").addClass("activo");
    } else {
      $("#paisD").prop("disabled", true);
      $("#paisD").removeClass("activo");
    }
  });
  $("#editarTelefonoD").click(function () {
    if ($("#telefonoD").prop("disabled")) {
      $("#telefonoD").prop("disabled", false);
      $("#telefonoD").addClass("activo");
    } else {
      $("#telefonoD").prop("disabled", true);
      $("#telefonoD").removeClass("activo");
    }
  });

  $("#editarUsuarioD").click(function () {
    if ($("#usuarioD").prop("disabled")) {
      $("#usuarioD").prop("disabled", false);
      $("#usuarioD").addClass("activo");
    } else {
      $("#usuarioD").prop("disabled", true);
      $("#usuarioD").removeClass("activo");
    }
  });
  $("#editarContrasennaD").click(function () {
    if ($("#contrasennaD").prop("disabled")) {
      $("#contrasennaD").prop("disabled", false);
      $("#contrasennaD").addClass("activo");
    } else {
      $("#contrasennaD").prop("disabled", true);
      $("#contrasennaD").removeClass("activo");
    }
  });
  $("#editarEmailD").click(function () {
    if ($("#emailD").prop("disabled")) {
      $("#emailD").prop("disabled", false);
      $("#emailD").addClass("activo");
    } else {
      $("#emailD").prop("disabled", true);
      $("#emailD").removeClass("activo");
    }
  });

  $("#guardarEmpleadoD").click(function () {
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
        var idEmpleado = $("#idEmpleadoD").val();
        var nombre = "";
        var direccion = "";
        var ciudad = "";
        var pais = "";
        var telefono = "";
        var usuario = "";
        var contrasenna = "";
        var email = "";
        var idCategoria = "";
       
        if (!$("#nombreD").attr("disabled")) {
          nombre = $("#nombreD").val();
        }
        if (!$("#direccionD").attr("disabled")) {
          direccion = $("#direccionD").val();
        }
        if (!$("#ciudadD").attr("disabled")) {
          ciudad = $("#ciudadD").val();
        }
        if (!$("#paisD").attr("disabled")) {
          pais = $("#paisD").val();
        }
        if (!$("#telefonoD").attr("disabled")) {
          telefono = $("#telefonoD").val();
        }
        if (!$("#usuarioD").attr("disabled")) {
          usuario = $("#usuarioD").val();
        }
        if (!$("#contrasennaD").attr("disabled")) {
          contrasenna = MD5($("#contrasennaD").val());
        }
        if (!$("#emailD").attr("disabled")) {
          email = $("#emailD").val();
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

  /////////////////////SECCION GESTION PROYECTOS
  $("#tblProyectos").DataTable({
    deferRender: true,
    responsive: true,
    autoWidth: true,
    columnDefs: [
      { responsivePriority: 1, targets: [-1, -7] },
      {
        responsivePriority: 2,
        targets: [-1, -2],
      },
    ],
  });

  var botonPersonalizado2 =
    '<button id="crearProyecto" data-bs-toggle="modal" data-bs-target="#staticBackdropCrearProyecto" class="btn btn-primary botonResponsive">Crear Proyecto</button>';
  // Insertar el botón encima del DataTable
  $("#tblProyectos_wrapper .dataTables_filter").prepend(botonPersonalizado2);

  $("#editarModal").click(function () {
    $(".btn-edicion").removeClass("boton-oculto");
    $("#editarModal").addClass("boton-oculto");
    $("#guardarModal").removeClass("boton-oculto");
    $("#cancelarGuardar").removeClass("boton-oculto");
  });
  $(".cancelarGuardar").click(function () {

    $("#nombreProyecto").prop("disabled", true);
    $("#nombreProyecto").prop("disabled", true);
    $("#descripcion").prop("disabled", true);
    $("#fechaInicio").prop("disabled", true);
    $("#fechaFinalizacion").prop("disabled", true);
    $(".horasRegistradas").prop("disabled", true);
    $(".horasTotal").prop("disabled", true);
    $("#cliente").prop("disabled", true);
    $(".form-check-input").prop("disabled", true);
    $("#prioridad").prop("disabled", true);

    ////////////////////////////////////////
    $("#nombreProyecto").removeClass("activo");
    $("#descripcion").removeClass("activo");
    $("#fechaInicio").removeClass("activo");
    $("#fechaFinalizacion").removeClass("activo");
    $(".horasRegistradas").removeClass("activo");
    $(".horasTotal").removeClass("activo");
    $("#cliente").removeClass("activo");
    $(".form-check-input").removeClass("activo");
    $("#prioridad").removeClass("activo");

  })
  $("#cancelarGuardar").click(function () {
    $(".btn-edicion").addClass("boton-oculto");
    $("#guardarModal").addClass("boton-oculto");
    $("#cancelarGuardar").addClass("boton-oculto");
    $("#editarModal").removeClass("boton-oculto");
  
    $("#nombreProyecto").prop("disabled", true);
    $("#nombreProyecto").prop("disabled", true);
    $("#descripcion").prop("disabled", true);
    $("#fechaInicio").prop("disabled", true);
    $("#fechaFinalizacion").prop("disabled", true);
    $(".horasRegistradas").prop("disabled", true);
    $(".horasTotal").prop("disabled", true);
    $("#cliente").prop("disabled", true);
    $(".form-check-input").prop("disabled", true);
    $("#prioridad").prop("disabled", true);

    ////////////////////////////////////////
    $("#nombreProyecto").removeClass("activo");
    $("#descripcion").removeClass("activo");
    $("#fechaInicio").removeClass("activo");
    $("#fechaFinalizacion").removeClass("activo");
    $(".horasRegistradas").removeClass("activo");
    $(".horasTotal").removeClass("activo");
    $("#cliente").removeClass("activo");
    $(".form-check-input").removeClass("activo");
    $("#prioridad").removeClass("activo");
  });
  $("#editarNombre").click(function () {
    if ($("#nombreProyecto").prop("disabled")) {
      $("#nombreProyecto").prop("disabled", false);
      $("#nombreProyecto").addClass("activo");
    } else {
      $("#nombreProyecto").prop("disabled", true);
      $("#nombreProyecto").removeClass("activo");
    }
  });
  $("#editarDescripcion").click(function () {
    if ($("#descripcion").prop("disabled")) {
      $("#descripcion").prop("disabled", false);
      $("#descripcion").addClass("activo");
      
    } else {
      $("#descripcion").prop("disabled", true);
      $("#descripcion").removeClass("activo");
    }
  });
  $("#editarFechaInicio").click(function () {
    if ($("#fechaInicio").prop("disabled")) {
      $("#fechaInicio").prop("disabled", false);
      $("#fechaInicio").addClass("activo");
    } else {
      $("#fechaInicio").prop("disabled", true);
      $("#fechaInicio").removeClass("activo");
    }
  });

  $("#editarFechaFin").click(function () {
    if ($("#fechaFinalizacion").prop("disabled")) {
      $("#fechaFinalizacion").prop("disabled", false);
      $("#fechaFinalizacion").addClass("activo");
    } else {
      $("#fechaFinalizacion").prop("disabled", true);
      $("#fechaFinalizacion").removeClass("activo");
    }
  });
  $("#editarHorasRegistradas").click(function () {
    if ($(".horasRegistradas").prop("disabled")) {
      $(".horasRegistradas").prop("disabled", false);
      $(".horasRegistradas").addClass("activo");
    } else {
      $(".horasRegistradas").prop("disabled", true);
      $(".horasRegistradas").removeClass("activo");
    }
  });
  $("#editarHorasTotales").click(function () {
    if ($(".horasTotal").prop("disabled")) {
      $(".horasTotal").prop("disabled", false);
      $(".horasTotal").addClass("activo");
    } else {
      $(".horasTotal").prop("disabled", true);
      $(".horasTotal").removeClass("activo");
    }
  });
  $("#editarCliente").click(function () {
    if ($("#cliente").prop("disabled")) {
      $("#cliente").prop("disabled", false);
      $("#cliente").addClass("activo");
    } else {
      $("#cliente").prop("disabled", true);
      $("#cliente").removeClass("activo");
    }
  });

  $("#editarIdEquipo").click(function () {
    if ($(".form-check-input").prop("disabled")) {
      $(".form-check-input").prop("disabled", false);
      $(".form-check-input").addClass("activo");
    } else {
      $(".form-check-input").prop("disabled", true);
      $(".form-check-input").removeClass("activo");
    }
  });
  $("#editarPrioridad").click(function () {
    if ($("#prioridad").prop("disabled")) {
      $("#prioridad").prop("disabled", false);
      $("#prioridad").addClass("activo");
    } else {
      $("#prioridad").prop("disabled", true);
      $("#prioridad").removeClass("activo");
    }
  });

  $("#crearProyecto").click(function () {
    $("#checkEquipoCrear").html("");
    $.ajax({
      url: "ajax/detallesEquipo.php",
      dataType: "json",
      success: function (respuesta) {
        for (var i = 0; i < respuesta.length; i++) {
          $("#checkEquipoCrear").append(
            "<div class='form-check form-check-inline'>" +
              "<input class='form-check-input' type='checkbox' name='exampleRadios' id='exampleRadios1' value='" +
              respuesta[i]["idEquipo"] +
              "' >" +
              "<label class='form-check-label' for='exampleRadios1'>" +
              respuesta[i]["idEquipo"] +
              "</label></div>"
            ////
          );
        }
      },
      error: function () {
        alert("error");
      },
    });
  });

  $(".horas").on("input", function () {
    $("#containerHora").html("");
    var valor = $(this).val();
    if (valor.length > 3) {
      $(this).val(valor.slice(0, 3));
      limiteHoras();
    }
  });
  $(".minSec").on("input", function () {
    $("#containerMinSec").html("");
    var valor = $(this).val();
    if (valor > 59) {
      $(this).val("");
      liminteMinSec();
    }
  });

  $("#guardarModal").click(function () {
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
        var idProyecto = $("#idProyecto").val();
        var nombreProyecto = "";
        var descripcion = "";
        var fechaInicio = "";
        var fechaFinalizacion = "";
        var horasRegistradas = "";
        var horasTotal = "";
        var cliente = "";
        var prioridad = "";
        if (!$("#nombreProyecto").prop("disabled")) {
          nombreProyecto = $("#nombreProyecto").val();
        }
        if (!$("#descripcion").prop("disabled")) {
          descripcion = $("#descripcion").val();
        }
        if (!$("#fechaInicio").prop("disabled")) {
          fechaInicio = $("#fechaInicio").val();
        }
        if (!$("#fechaFinalizacion").prop("disabled")) {
          fechaFinalizacion = $("#fechaFinalizacion").val();
        }
        if (!$(".horasRegistradas").prop("disabled")) {
          var horas = $("#horas").val();
          var minutos = $("#minutos").val();
          var segundos = $("#segundos").val();

          if (horas.length < 2) {
            horas = "0" + horas;
          }
          if (minutos.length < 2) {
            minutos = "0" + minutos;
          }
          if (segundos.length < 2) {
            segundos = "0" + segundos;
          }
          horasRegistradas = horas + ":" + minutos + ":" + segundos;
        }

        ////////////////////////
        if (!$("#horasTotal").prop("disabled")) {
          var horas = $("#horasTotal").val();
          var minutos = $("#minutosTotal").val();
          var segundos = $("#segundosTotal").val();

          if (horas.length < 2) {
            horas = "0" + horas;
          }
          if (minutos.length < 2) {
            minutos = "0" + minutos;
          }
          if (segundos.length < 2) {
            segundos = "0" + segundos;
          }
          horasTotal = horas + ":" + minutos + ":" + segundos;
        }

        //////////////////77777
        if (!$("#cliente").prop("disabled")) {
          cliente = $("#cliente").val();
        }
        var arrayIdEquipo = [];

        if (!$(".form-check-input").prop("disabled")) {
          
          $.each($(".form-check-input:checked"), function () {
            arrayIdEquipo.push($(this).val());
          });
        }
        if (!$("#prioridad").prop("disabled")) {
          prioridad = $("#prioridad option:selected").val();

          if (prioridad === "--Seleccione--") {
            prioridad = "";
          }
        }
        var arrayDatos = {
          idProyecto: idProyecto,
          nombreProyecto: nombreProyecto,
          descripcion: descripcion,
          fechaInicio: fechaInicio,
          fechaFinalizacion: fechaFinalizacion,
          horasRegistradas: horasRegistradas,
          cliente: cliente,
          horasTotal: horasTotal,
          arrayIdEquipo: arrayIdEquipo,
          prioridad: prioridad,
        };

        var jsonData = JSON.stringify(arrayDatos);

        $.ajax({
          type: "POST",
          url: "ajax/updateProyecto.php",
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
  $("#guardarProyectoNuevo").click(function () {
    var nombreInput = $("#nombreProyectoC").val();
    var descripcionInput = $("#descripcionC").val();
    var fechaInicioInput = $("#fechaInicioC").val();
    var fechaFinInput = $("#fechaFinC").val();
    var clienteInput = $("#clienteC").val();

      var arrayIdEquipo=[];
      $.each($(".form-check-input:checked"), function () {
        arrayIdEquipo.push($(this).val());
      });
    

    var prioridadInput = $("#prioridadC").val();

    if (nombreInput.trim() === "") {
      $("#nombreProyectoC").addClass("input-error");
    }
    if (clienteInput.trim() === "") {
      $("#clienteC").addClass("input-error");
    }

    if (nombreInput.trim() === "" || clienteInput.trim() === "") {
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
          var arrayDatos = {
            nombreInput: nombreInput,
            descripcionInput: descripcionInput,
            fechaInicioInput: fechaInicioInput,
            fechaFinInput: fechaFinInput,
            clienteInput: clienteInput,
            arrayIdEquipo: arrayIdEquipo,
            prioridadInput: prioridadInput,
          };

          var jsonData = JSON.stringify(arrayDatos);

          $.ajax({
            type: "POST",
            url: "ajax/createProyecto.php",
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
  $(".cerrarCreacionProyecto").click(function () {
    $("#nombreProyectoC").removeClass("input-error");

    $("#clienteC").removeClass("input-error");
  });
  $(".cerrarModalEdicion").click(function () {
    $("#editarModal").removeClass("boton-oculto");

    $("#guardarModal").addClass("boton-oculto");
    $("#cancelarGuardar").addClass("boton-oculto");

    $("#editarNombre").addClass("boton-oculto");
    $("#editarDescripcion").addClass("boton-oculto");
    $("#editarFechaInicio").addClass("boton-oculto");
    $("#editarFechaFin").addClass("boton-oculto");
    $("#editarHorasRegistradas").addClass("boton-oculto");
    $("#editarHorasTotales").addClass("boton-oculto");
    $("#editarCliente").addClass("boton-oculto");
    $("#editarIdEquipo").addClass("boton-oculto");
    $("#editarPrioridad").addClass("boton-oculto");

    $("#nombreProyecto").prop("disabled", true);
    $("#descripcion").prop("disabled", true);
    $("#fechaInicio").prop("disabled", true);

    $("#fechaFinalizacion").prop("disabled", true);
    $("#horasRegistradas").prop("disabled", true);
    $("#horasTotal").prop("disabled", true);
    $("#cliente").prop("disabled", true);
    $("#idEquipo").prop("disabled", true);
    $("#prioridad").prop("disabled", true);
  });

  //////////////////////////////////////////////////////////////////////////////////////
});
