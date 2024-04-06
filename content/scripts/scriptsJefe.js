$(function () {
  $("#tblEquipos").DataTable({
    responsive: true,
    autoWidth: true,
    columnDefs: [
      { responsivePriority: 1, targets: [-1, -3] },
      { responsivePriority: 2, targets: "_all" },
    ],
  });
  $("#tblEtapas").DataTable({
    responsive: true,
    autoWidth: true,
    columnDefs: [
      { responsivePriority: 1, targets: [-1, -3] },
      { responsivePriority: 2, targets: "_all" },
    ],
  });

  var botonPersonalizadoEtapas =
  "<button id='crearEtapas' data-bs-toggle='modal' data-bs-target='#staticBackdropCrearEtapas' class='btn btn-primary botonResponsive'>Crear Etapa</button>";
$("#tblEtapas_wrapper .dataTables_filter").prepend(botonPersonalizadoEtapas);

  var botonPersonalizado =
    '<button id="crearEquipo" data-bs-toggle="modal" data-bs-target="#staticBackdropCrearEquipos" class="btn btn-primary botonResponsive">Crear Equipo</button>';
  $("#tblEquipos_wrapper .dataTables_filter").prepend(botonPersonalizado);



  $("#editarNombreProyecto").click(function () {
    if ($("#nombreProyecto").prop("disabled")) {
      $("#nombreProyecto").prop("disabled", false);
      $("#nombreProyecto").addClass("activo");
    } else {
      $("#nombreProyecto").prop("disabled", true);
      $("#nombreProyecto").removeClass("activo");
    }
  });
  $("#editarJefeEquipo").click(function () {
    if ($("#jefeEquipo").prop("disabled")) {
      $("#jefeEquipo").prop("disabled", false);
      $("#jefeEquipo").addClass("activo");
    } else {
      $("#jefeEquipo").prop("disabled", true);
      $("#jefeEquipo").removeClass("activo");
    }
  });

  $("#editarModalEquipos").click(function () {
    $(".btn-edicion").removeClass("boton-oculto");
    $("#editarModalEquipos").addClass("boton-oculto");
    $("#guardarEquipo").removeClass("boton-oculto");
    $("#cancelarGuardarEquipo").removeClass("boton-oculto");
    $("#añadirEmpleado").removeClass("boton-oculto");
    
  });

  $("#cancelarGuardarEquipo").click(function () {
    $(".btn-edicion").addClass("boton-oculto");
    $("#guardarEquipo").addClass("boton-oculto");
    $("#cancelarGuardarEquipo").addClass("boton-oculto");
    $("#editarModalEquipos").removeClass("boton-oculto");
    $("#nombreProyecto").prop("disabled", true);
    $("#jefeEquipo").prop("disabled", true);
    $("#añadirEmpleado").addClass("boton-oculto");
    $("#rowEmpleadoExtra").remove();
    $("#añadirEmpleado").prop("disabled", false);

    $("#nombreProyecto").removeClass("activo");
    $("#jefeEquipo").removeClass("activo");

  });

  $(".cerrarEdicionEquipos").click(function () {
    $(".btn-edicion").addClass("boton-oculto");
    $("#guardarEquipo").addClass("boton-oculto");
    $("#cancelarGuardarEquipo").addClass("boton-oculto");
    $("#editarModalEquipos").removeClass("boton-oculto");
    $("#nombreProyecto").prop("disabled", true);
    $("#jefeEquipo").prop("disabled", true);
    $("#añadirEmpleado").addClass("boton-oculto");
    $("#rowEmpleadoExtra").remove();
    $("#añadirEmpleado").prop("disabled", false);
    $("#nombreProyecto").removeClass("activo");
    $("#jefeEquipo").removeClass("activo");
  });


  $("#añadirEmpleado").click(function()
  {
    $("#añadirEmpleado").prop("disabled",true);
    $("#selectEmpleados").append("<div id='rowEmpleadoExtra' class='row g-3 align-items-center mt-1'><div class='col-3'><label for='crearEmpleado3' class='col-form-label'><b>Empleado Extra</b></label></div><div class='col-8'><select type='text' id='empleadoExtra' class='form-control'><option value='' selected>--Seleccione--</option></select></div><div class='col-1'></div></div>");
    
    var idEquipo=$("#idEquipo").val();
   

    
    var selectCentrado = $("#empleadoExtra")[0]; 
    $("#empleadoExtra").addClass("activo");
   
    selectCentrado.scrollIntoView({
      behavior: "smooth"
    });
  

        $.ajax({
          type: "POST",
          dataType: "json",
          url: "ajax/detallesEmpleadosNoAsign.php",
          data: "idEquipo=" + idEquipo,
          success: function (respuesta) {
          
            respuesta.forEach(function(empleado) {
              $("#empleadoExtra").append("<option value='"+empleado.idEmpleado+"'>"+empleado.nombre+"</option>")
            });

          },
          error: function () {
            alert("error");
          },
        });

    $("#empleadoExtra").change(function()
    {
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
          var idEquipo=$("#idEquipo").val();
          var idEmpleado=$("#empleadoExtra option:selected").val();
          var idEquipoA=$("#idEquipoA").val();

       

          $.ajax({
            type: "POST",
            url: "ajax/updateEmpleadoEquipo.php",
            data: "idEquipo=" + idEquipo + "&idEmpleado=" + idEmpleado,
            success: function (respuesta) {
           
              
                detallesEquipo( idEquipoA,idEquipo);
                 
                setTimeout(function () {
                  $(".btn-edicion").removeClass("boton-oculto");
                }, 100); 
              
              },
            error: function () {
              alert("error");
            },
          });
  
          Swal.fire("Guardado!", "El registro a sido guardado.", "success");
        }
      });
    
      
      $("#añadirEmpleado").prop("disabled",false);
    })
  })

  $("#guardarEquipo").click(function () {
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
        var idEquipo = $("#idEquipo").val();
        var nombreProyecto = "";
        var jefeEquipo = "";
        var empleado1 = "";
        var empleado2 = "";
        var empleado3 = "";

        if (!$("#nombreProyecto").prop("disabled")) {
          nombreProyecto = $("#nombreProyecto").val();

          if (nombreProyecto === "--Seleccione--") {
            nombreProyecto = "";
          }
        }
        if (!$("#jefeEquipo").prop("disabled")) {
          jefeEquipo = $("#jefeEquipo").val();
          if (jefeEquipo === "--Seleccione--") {
            jefeEquipo = "";
          }
        }
      

        //////////////////77777

        var arrayDatos = {
          idEquipo: idEquipo,
          nombreProyecto: nombreProyecto,
          jefeEquipo: jefeEquipo,
         
        };

        var jsonData = JSON.stringify(arrayDatos);

        $.ajax({
          type: "POST",
          url: "ajax/updateEquipo.php",
          data: "data=" + jsonData,
          success: function (respuesta) {
           
            $("#staticBackdropEquipos").modal("hide");

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

  $("#crearEquipo").click(function(){
    $.ajax({
      url: "ajax/detallesJefe.php",
      dataType: "json",
      success: function (respuesta) {
        $("#crearJefeEquipo").html("");
        for (var i = 0; i < respuesta.length; i++) {
          $("#crearJefeEquipo").append(
            "<option value='" +
              respuesta[i]["idEmpleado"] +
              "'>" +
              respuesta[i]["nombre"] +
              "</option>"
          );
        }
        $("#crearJefeEquipo").append("<option value='' selected>--Seleccione--</option>");
      },
      error: function () {
        alert("error1");
      },
    });

    /////////////////////////Ajax para obtener todo los empleados ////////////////////////////////
     $.ajax({
      url: "ajax/detallesEmpleadoEquipo.php",
      dataType: "json",
      success: function (respuesta) {
        

        for (var i = 0; i < respuesta.length; i++) {
          $("#checkEmpleados").append(
            "<div class='form-check form-check-inline'>" +
              "<input class='form-check-input' type='checkbox' name='exampleRadios' id='exampleRadios1' value='" +
              respuesta[i]["idEmpleado"] +
              "' >" +
              "<label class='form-check-label' for='exampleRadios1'>" +
              respuesta[i]["nombre"] +
              "</label></div>"
            ////
          );
        }
      },
      error: function () {
        alert("error2");
      },
    }); 
    $.ajax({
      url: "ajax/detallesProyectos.php",
      dataType: "json",
      success: function (respuesta) {
        $("#crearNombreProyecto").html("");
        for (var i = 0; i < respuesta.length; i++) {
          $("#crearNombreProyecto").append(
            "<option value='" +
              respuesta[i]["idProyecto"] +
              "'>" +
              respuesta[i]["nombreProyecto"] +
              "</option>"
          );

        }
        $("#crearNombreProyecto").append("<option value='' selected>--Seleccione--</option>");
      },
      error: function () {
        alert("error");
      },
    });
  });

  $("#guardarEquipoNuevo").click(function () {
    var nombreProyecto = $("#crearNombreProyecto option:selected").text();
    var jefeEquipo = $("#crearJefeEquipo option:selected").text();
    
    var arrayEmpleados = [];
    $.each($(".form-check-input:checked"), function () {
      arrayEmpleados.push($(this).val());
    });

    if (nombreProyecto == "--Seleccione--") {
      $("#crearNombreProyecto").addClass("input-error");
    }
    
    if (jefeEquipo == "--Seleccione--") {
      $("#crearJefeEquipo").addClass("input-error");
    }

    if (nombreProyecto == "--Seleccione--" || jefeEquipo == "--Seleccione--") {
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Rellene los campos obligatorios!",
      });
    } else {
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
          if (nombreProyecto === "--Seleccione--") {
            nombreProyecto = "";
          }else{
            nombreProyecto = $("#crearNombreProyecto option:selected").text();
          }
        
          if (jefeEquipo === "--Seleccione--") {
            jefeEquipo="";
          } else{
            jefeEquipo = $("#crearJefeEquipo").val();
          }  
        
         
        var arrayDatos = {
          nombreProyecto: nombreProyecto,
          jefeEquipo: jefeEquipo,
          arrayEmpleados:arrayEmpleados
        };

        var jsonData = JSON.stringify(arrayDatos);

        $.ajax({
          type: "POST",
          url: "ajax/createEquipo.php",
          data: "data=" + jsonData,
          success: function (respuesta) {
           
            $("#staticBackdropCrearEquipos").modal("hide");

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
  } 
  });
 
  $("#revertirEntrega").click(function()
  {
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
        var datos = {
          idEmpleado: $("#idEmpleado").val(),
          idProyecto: $("#idProyecto").val(),
          horasProyecto: $("#horasEtapa").val(),
          idEtapa: $("#idEtapa").val()
      };
   
      var jsonData = JSON.stringify(datos);

        $.ajax({
          type: "POST",
          url: "ajax/revertirEtapa.php",
          data: "data=" + jsonData,
          success: function (respuesta) {
           
             $("#staticBackdropEtapas").modal("hide");

            setTimeout(function () {
              location.reload(true);
            }, 1000); 
          },
          error: function () {
            alert("error");
          },
        });  

        Swal.fire("Eliminado!", "El registro de entrega a sido revertido.", "success");
      }
    });
  });

  $("#crearEtapas").click(function()
  {
    $.ajax({
      url: "ajax/detallesProyectos.php",
      dataType: "json",
      success: function (respuesta) {
        $("#nombreProyectoCrear").html("");
        $("#nombreProyectoCrear").append("<option value='0' selected>--Seleccione--</option>");
        
          for (var i = 0; i < respuesta.length; i++) {
          $("#nombreProyectoCrear").append(
            "<option value='" +
              respuesta[i]["idProyecto"] +
              "'>" +
              respuesta[i]["nombreProyecto"] +
              "</option>"
          );
        }
      },
      error: function () {
        alert("error");
      },
    });

  })

  $("#guardarEtapa").click(function()
  {
    var nombreProyectoCrear = $("#nombreProyectoCrear").val();
    var nombreEtapaCrear = $("#nombreEtapaCrear").val();
    var descripcionEtapa = $("#descripcionEtapa").val();

    
    if (nombreEtapaCrear.trim() === "") {
      $("#nombreEtapaCrear").addClass("input-error");
    }else{
      $("#nombreEtapaCrear").removeClass("input-error");
    }
    if (descripcionEtapa.trim() === "") {
      $("#descripcionEtapa").addClass("input-error");
    }else{
      $("#descripcionEtapa").removeClass("input-error");
    }
    if (nombreProyectoCrear === '0') {
      $("#nombreProyectoCrear").addClass("input-error");
    }else{
      $("#nombreProyectoCrear").removeClass("input-error");
    }

    if (nombreEtapaCrear.trim() === "" || descripcionEtapa.trim() === ""|| nombreProyectoCrear==0) {
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
            nombreProyectoCrear: nombreProyectoCrear,
            nombreEtapaCrear: nombreEtapaCrear,
            descripcionEtapa: descripcionEtapa,
          };

          var jsonData = JSON.stringify(arrayDatos);
         
          $.ajax({
            type: "POST",
            url: "ajax/createEtapa.php",
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
});
