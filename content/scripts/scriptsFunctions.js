/////////////////////////ZONA FUNCIONES /////////////////////////
///////////////////////FUNCION MOSTRAR PROYECTOS////////////////////
function contadorHMS(segundos, minutos, horas) {
  var secSin0 = Number(segundos);
  var minSin0 = Number(minutos);
  var horSin0 = Number(horas);

  if (iniciado) {
    intervalId = setInterval(function () {
      secSin0++;
      if (secSin0 >= 60) {
        secSin0 = 0;
        minSin0++;
        if (minSin0 >= 60) {
          minSin0 = 0;
          horSin0++;
        }
      }

      $("#second").html(añadirCero(secSin0));
      $("#minute").html(añadirCero(minSin0));
      $("#hour").html(añadirCero(horSin0));
    }, 1000);
  }
}
//////////////////--FUNCION AÑADIR 0--////////////////////

function añadirCero(numero) {
  if (numero <= 9) {
    return (numero = "0" + numero);
  } else {
    return numero;
  }
}
function mostrarDetalles(idPedido) {
  $.ajax({
    async: true,
    type: "POST",
    dataType: "json",
    contentType: "application/x-www-form-urlencoded",
    url: "ajax/detallesProyectos.php",
    data: "idProyecto=" + idPedido,
    success: function (data) {
      var proyecto = data.proyecto; 
      var equipos = data.idEquipos; 
    
      var equiposAsignados = data.idEquiposAsignados;
      
      $("#checkEquipo").html("");
      $("#clienteSpan").html(proyecto.Cliente);
      $("#idProyecto").val(proyecto.idProyecto);
      $("#nombreProyecto").val(proyecto.nombreProyecto);
      $("#descripcion").val(proyecto.descripcion);
      $("#fechaInicio").val(proyecto.fechaInicio);
      $("#fechaFinalizacion").val(proyecto.fechaFinalizacion);

      var horaSplitRegistradas = proyecto.horas_registradas.split(":");
      $("#horas").val(horaSplitRegistradas[0]);
      $("#minutos").val(horaSplitRegistradas[1]);
      $("#segundos").val(horaSplitRegistradas[2]);

      var horaSplitTotal = proyecto.horas_total.split(":");

      $("#horasTotal").val(horaSplitTotal[0]);
      $("#minutosTotal").val(horaSplitTotal[1]);
      $("#segundosTotal").val(horaSplitTotal[2]);

      $("#cliente").val(proyecto.Cliente);
      $("#prioridad").val(proyecto.prioridad);

      if (proyecto.prioridad === null) {
        $("#prioridad").prepend("<option>--Seleccione--</option>");
      }

      for (var i = 0; i < equipos.length; i++) {
        $("#checkEquipo").append(
          "<div class='form-check form-check-inline'>" +
            "<input class='form-check-input' type='checkbox' name='exampleRadios' id='exampleRadios1' value='" +
            equipos[i]["idEquipo"] +
            "' disabled>" +
            "<label class='form-check-label' for='exampleRadios1'>" +
            equipos[i]["idEquipo"] +
            "</label></div>"
        );
      }
      for (var i = 0; i < equipos.length; i++) {
        var idEquipo = equipos[i]["idEquipo"];
        for (var j = 0; j < equiposAsignados.length; j++) {
          if (idEquipo == equiposAsignados[j]["idEquipo"]) {
            $(
              "#checkEquipo input[value='" +
                equiposAsignados[j]["idEquipo"] +
                "']"
            ).prop("checked", true);
          }
        }
      }
    },

    error: function (error) {
      console.log("Error de servidor: " + error);
    },
  });
}

function eliminarEquipo(idEquipo) {
  Swal.fire({
    title: "Desea eliminar el registro?",
    text: "Esto modificara la base de datos permanentemente",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Guardar",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        async: true,
        type: "POST",
        contentType: "application/x-www-form-urlencoded",
        url: "ajax/eliminarEquipo.php",
        data: "idEquipo=" + idEquipo,
        success: function (data) {
          
            setTimeout(function () {
            location.reload(true);
          }, 1000); 
        },

        error: function (error) {
          console.log("Error de servidor: " + error);
        },
      });
      Swal.fire(
        "Proyecto Eliminado!",
        "El registro a sido eliminado.",
        "success"
      );
    }
  });
}

function eliminarProyecto(idPedido) {
  Swal.fire({
    title: "Desea eliminar el registro?",
    text: "Esto modificara la base de datos permanentemente",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Guardar",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        async: true,
        type: "POST",
        contentType: "application/x-www-form-urlencoded",
        url: "ajax/eliminarProyecto.php",
        data: "idProyecto=" + idPedido,
        success: function (data) {
          setTimeout(function () {
            location.reload(true);
          }, 1000);
        },

        error: function (error) {
          console.log("Error de servidor: " + error);
        },
      });
      Swal.fire(
        "Proyecto Eliminado!",
        "El registro a sido eliminado.",
        "success"
      );
    }
  });
}
function detallesEtapa(idEtapa){

  var completada = $('#tblEtapas').find('[data-idetapa="' + idEtapa + '"]').find('i.noCompletada').data('value')
  
  if(completada===0)
    {
        Swal.fire({
          icon: 'error', // Icono de error o peligro
          title: '¡Tarea no completada !',
          text: 'Esta tarea todavía esta pendiente.',
          showConfirmButton: false,
         timer: 1500 // No muestra un botón de confirmación
      });
    }else{

      $('#staticBackdropEtapas').modal('show');
  $.ajax({
    async: true,
    type: "POST",
    dataType: "json",
    contentType: "application/x-www-form-urlencoded",
    url: "ajax/detallesEtapaCompleta.php",
    data: "idEtapa=" + idEtapa,
    success: function (data) {
    
      var fechaHora = data.fecha.split(" "); 

      var fechaSplit=fechaHora[0].split("-");
      
      var fechaFormat=fechaSplit[2]+"/"+fechaSplit[1]+"/"+fechaSplit[0];

      var hora=fechaHora[1];

      var fechaCompleta=fechaFormat+"   "+hora;
      
      $("#staticBackdropLabelEtapas").html("Datos : "+data.nombreEtapa);
      $("#nombreEtapa").val(data.nombreEtapa);
      $("#nombreProyecto").val(data.nombreProyecto);
      $("#nombreEmpleado").val(data.nombre);
      $("#comentarioEntrega").val(data.comentario);
      $("#horasEtapa").val(data.horas_etapas);
      $("#fehcaEntrega").val(fechaCompleta);

      $("#idEmpleado").val(data.idEmpleadoEtapa);
      $("#idProyecto").val(data.idProyecto);
      $("#idEtapa").val(data.idEtapa);
      
    },

    error: function (error) {
      console.log("Error de servidor: " + error);
    },
  }); 


    }
    


}
function eliminarEtapa(idEtapa) {
  Swal.fire({
    title: "Desea eliminar el registro?",
    text: "Esto modificara la base de datos permanentemente",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Guardar",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        async: true,
        type: "POST",
        contentType: "application/x-www-form-urlencoded",
        url: "ajax/eliminarEtapa.php",
        data: "idEtapa=" + idEtapa,
        success: function (data) {
          
          setTimeout(function () {
            location.reload(true);
          }, 1000);
        },

        error: function (error) {
          console.log("Error de servidor: " + error);
        },
      });
      Swal.fire(
        "Proyecto Eliminado!",
        "El registro a sido eliminado.",
        "success"
      );
    }
  });
}
function detallesMarcaje(idEmpleado) {
  $.ajax({
    async: true,
    type: "POST",
    dataType: "json",
    contentType: "application/x-www-form-urlencoded",
    url: "ajax/detallesMarcaje.php",
    data: "idEmpleado=" + idEmpleado,
    success: function (data) {
   

      $("#nombreMarcaje").html(data.nombre);
      $("#idMarcaje").val(data.idMarcaje);
      $("#nombreEmpleado").val(data.nombre);
      $("#horaEntrada").val(data.horaEntrada);
      $("#horaSalida").val(data.horaSalida);
      $("#fecha").val(data.fecha);
      $("#comentario").val(data.comentario);
      $("#horasJornada").val(data.horas_jornada);
      $("#jornadaFinalizada").val(data.jornadaFinalizada);
      $("#horaPausa").val(data.horaPausa);
      $("#horaFinPausa").val(data.horaFinPausa);
    },

    error: function (error) {
      console.log("Error de servidor: " + error);
    },
  });
}
function eliminarMarcaje(idMarcaje) {
  Swal.fire({
    title: "Desea eliminar el registro?",
    text: "Esto modificara la base de datos permanentemente",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Eliminar",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        async: true,
        type: "POST",
        contentType: "application/x-www-form-urlencoded",
        url: "ajax/eliminarMarcaje.php",
        data: "idMarcaje=" + idMarcaje,
        success: function (data) {
          setTimeout(function () {
            location.reload(true);
          }, 1000);
        },

        error: function (error) {
          console.log("Error de servidor: " + error);
        },
      });
      Swal.fire(
        "Empleado Eliminado!",
        "El registro a sido eliminado.",
        "success"
      );
    }
  });
}
function detallesEmpleado(idEmpleado) {
  $.ajax({
    async: true,
    type: "POST",
    dataType: "json",
    contentType: "application/x-www-form-urlencoded",
    url: "ajax/detallesEmpleado.php",
    data: "idEmpleado=" + idEmpleado,
    success: function (data) {


      $("#idEmpleado").val(data.idEmpleado);
      $("#nombre").val(data.nombre);
      $("#direccion").val(data.direccion);
      $("#ciudad").val(data.ciudad);
      $("#pais").val(data.pais);
      $("#telefono").val(data.telDomicilio);
      $("#usuario").val(data.usuario);
      $("#email").val(data.email);
     
      $opcionCategoria = data.idCategoria;
   

      /////////////////////////////////////////////////////

      $.ajax({
        url: "ajax/detallesCategoria.php",
        dataType: "json",
        success: function (respuesta) {
          $("#idCategoria").html("");
          for (var i = 0; i < respuesta.length; i++) {
            $("#idCategoria").append(
              "<option value='" +
                respuesta[i]["idCategoria"] +
                "'>" +
                respuesta[i]["nombreCategoria"] +
                "</option>"
            );
            if (respuesta[i]["idCategoria"] === $opcionCategoria) {
              $(
                "#idCategoria option[value='" +
                  respuesta[i]["idCategoria"] +
                  "']"
              ).prop("selected", true);
            }
          }
        },
        error: function () {
          alert("error");
        },
      });
    },

    error: function (error) {
      console.log("Error de servidor: " + error);
    },
  });
}
function eliminarEmpleado(idEmpleado) {
  Swal.fire({
    title: "Desea eliminar el registro?",
    text: "Esto modificara la base de datos permanentemente",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Eliminar",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        async: true,
        type: "POST",
        contentType: "application/x-www-form-urlencoded",
        url: "ajax/eliminarEmpleado.php",
        data: "idEmpleado=" + idEmpleado,
        success: function (data) {
          setTimeout(function () {
            location.reload(true);
          }, 1000);
        },

        error: function (error) {
          console.log("Error de servidor: " + error);
        },
      });
      Swal.fire(
        "Empleado Eliminado!",
        "El registro a sido eliminado.",
        "success"
      );
    }
  });
}

function detallesEquipo( idEquipoA,idEquipo) {
  $.ajax({
    async: true,
    type: "POST",
    dataType: "json",
    contentType: "application/x-www-form-urlencoded",
    url: "ajax/detallesGestionEquipos.php",
    data: "idEquipo=" + idEquipo + "&idEquipoA=" + idEquipoA,
    success: function (data) {
     
     
      $("#idEquipoA").val(idEquipoA);
      $("#idEquipo").val(data.idEquipo);
      $("#nombreProyecto").val(data.nombreProyecto);
      $("#jefeEquipo").val(data.nombreJefe);

      var opcion = data.nombreJefe;
     
      var opcionNombreProyecto = data.nombreProyecto;
     
      $.ajax({
        url: "ajax/detallesJefe.php",
        dataType: "json",
        success: function (respuesta) {
          $("#jefeEquipo").html("");
          for (var i = 0; i < respuesta.length; i++) {
            $("#jefeEquipo").append(
              "<option value='" +
                respuesta[i]["idEmpleado"] +
                "'>" +
                respuesta[i]["nombre"] +
                "</option>"
            );
            if (respuesta[i]["nombre"] === opcion) {
              
              $(
                "#jefeEquipo option[value='" + respuesta[i]["idEmpleado"] + "']"
              ).prop("selected", true);
            }
          }
        },
        error: function () {
          alert("error1");
        },
      });

      /////////////////////////A////////////////////////////////
      $.ajax({
        url: "ajax/detallesEmpleadoEquipo.php",
        data:"idEquipoA=" + idEquipo,
        type: "POST",
        dataType: "json",
        success: function (respuesta) {
          $("#selectEmpleados").html("");
          var empleadosTotales = respuesta.empleadosTotales;
          var empleadosAsignados = respuesta.empleadosAsignados;
          
          // Mantén un registro de empleados seleccionados
          var empleadosSeleccionados = [];
  
          for (var i = 0; i < empleadosAsignados.length; i++) {
              var empleadoId = empleadosTotales[i].idEmpleado;
              var empleadoNombre = empleadosTotales[i].nombre;
  
              var empleadoHtml =
                  "<div class='row g-3 align-items-center mt-1'>" +
                  "<div class='col-3'>" +
                  "<label for='empleado" + i + "' class='col-form-label'><b>Empleado " + (i + 1) + "</b></label>" +
                  "</div>" +
                  "<div class='col-8'>" +
                  "<input type='hidden' id="+empleadosAsignados[i].idEmpleado+" value='" + empleadosAsignados[i].idEmpleado+"'>" +
                  "<input class='form-control' type='text' value='" + empleadosAsignados[i].nombre  + "' disabled>"+"</div>" +
                  "<div class='col-1'>" +
                  "<button class='btn btn-danger btn-edicion boton-oculto eliminarEmpleado' >+</button>" +
                  "</div>" +
                  "</div>";
  
              $("#selectEmpleados").append(empleadoHtml);

        }
        $(".eliminarEmpleado").click(function()
        {
          
          var idEmpleado = $(this).closest(".row").find("input[type='hidden']").val();
          var idEquipo=$("#idEquipo").val();
          var idEquipoA=$("#idEquipoA").val();
          
            Swal.fire({
              title: "Desea eliminar el registro?",
              text: "Esto modificara la base de datos permanentemente",
              icon: "warning",
              showCancelButton: true,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Eliminar",
            }).then((result) => {
              if (result.isConfirmed) {
                $.ajax({
                  async: true,
                  type: "POST",
                  contentType: "application/x-www-form-urlencoded",
                  url: "ajax/eliminarEmpleadoEquipo.php",
                  data: "idEmpleado=" + empleadoId,
                  data: "idEquipo=" + idEquipo + "&idEmpleado=" + idEmpleado,
                  success: function (data) {
                  

                    detallesEquipo( idEquipoA,idEquipo);
                 
                    setTimeout(function () {
                      $(".btn-edicion").removeClass("boton-oculto");
                    }, 100); 
                  },
          
                  error: function (error) {
                    console.log("Error de servidor: " + error);
                  },
                });
                Swal.fire(
                  "Proyecto Eliminado!",
                  "El registro a sido eliminado.",
                  "success"
                );
              }
            });
          
          
          
        })
        },
        error: function () {
          alert("error2");
        },
      });
      $.ajax({
        url: "ajax/detallesProyectos.php",
        dataType: "json",
        success: function (respuesta) {
          $("#nombreProyecto").html("");
          for (var i = 0; i < respuesta.length; i++) {
            $("#nombreProyecto").append(
              "<option value='" +
                respuesta[i]["idProyecto"] +
                "'>" +
                respuesta[i]["nombreProyecto"] +
                "</option>"
            );
            if (respuesta[i]["nombreProyecto"] === opcionNombreProyecto) {
              $(
                "#nombreProyecto option[value='" +
                  respuesta[i]["idProyecto"] +
                  "']"
              ).prop("selected", true);
            }
          }
          if (opcionNombreProyecto == null) {
            $("#nombreProyecto").append(
              "<option selected>" + "--Seleccione--" + "</option>"
            );
          }
        },
        error: function () {
          alert("error");
        },
      });

      /////////////////////////////////////////////////////
    },

    error: function (error) {
      console.log("Error de servidor: " + JSON.stringify(error));
    },
  });
}

function completarEtapa(idEtapa)
{
var valorColumna2="";
  var filaDeseada = $("tr:has(td:contains("+idEtapa+"))").filter(function() {
     valorColumna2 = $(this).find('td:eq(1)').text();
    
});

  //id titulo modal staticBackdropLabel
  $("#staticBackdropLabel").html("");
  $("#staticBackdropLabel").html("Datos : "+valorColumna2);
  $("#completarEtapa").click(function()
  {
  Swal.fire({
    title: "Desea Completar la tarea?",
    text: "Esto modificara la base de datos permanentemente",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Eliminar",
  }).then((result) => {
    if (result.isConfirmed) {

        var horas = $("#horas").val();
        var minutos = $("#minutos").val();
        var segundos = $("#segundos").val();
        var descripcion =$("#comentario").val();
      
        if (horas.length < 2) {
          horas = "0" + horas;
        }
        if (minutos.length < 2) {
          minutos = "0" + minutos;
        }
        if (segundos.length < 2) {
          segundos = "0" + segundos;
        }
        var horasEmpleadas = horas + ":" + minutos + ":" + segundos;

        var arrayDatos = {
            horasEmpleadas:horasEmpleadas,
            descripcion:descripcion,
            idEtapa:idEtapa
        };

        var jsonData = JSON.stringify(arrayDatos);
      
        $.ajax({
          type: "POST",
          url:"ajax/completarEtapa.php",
          data: "data=" + jsonData,
          success: function (data) {
            
            setTimeout(function () {
              location.reload(true);
            }, 1000);
          },
      
          error: function (error) {
            console.log("Error de servidor: " + error);
          },
        });
     
      Swal.fire(
        "Tarea Finalizada!",
        "El registro a sido actualizado.",
        "success"
      );
    }
  }); 
})
}
///////////////////////////////////////////////////////////////

//////////////--FUNCION PARA NOTY--////////////////////////////
function mostrarAlerta() {
  new Noty({
    type: "error", // Tipo de notificación (error)
    layout: "inline", // Usar el diseño "inline" para que se muestre dentro del contenedor
    theme: "mint", // Tema de la notificación (rojo)
    text: "¡Login incorrecto!", // Texto del mensaje
    timeout: 3000, // Duración en milisegundos antes de que la notificación se cierre automáticamente (3 segundos)
    container: "#alertContainer", // ID del contenedor donde se mostrará la alerta
  }).show();
}
function loginVacio() {
  new Noty({
    type: "warning",
    layout: "inline",
    theme: "mint",
    text: "¡Rellene los campo!",
    timeout: 3000,
    container: "#alertContainer",
  }).show();
}
function limiteHoras() {
  new Noty({
    type: "warning",
    layout: "inline",
    theme: "mint",
    text: "¡Solo 3 caracteres!",
    timeout: 3000,
    container: "#containerHora",
  }).show();
}
function liminteMinSec() {
  new Noty({
    type: "warning",
    layout: "inline",
    theme: "mint",
    text: "¡limite 2 caracteres 0-59!",
    timeout: 3000,
    container: "#containerMinSec",
  }).show();
}

//////////////////////--BIBLIOTECA MD5--///////////////////////////
var MD5 = function (d) {
  var r = M(V(Y(X(d), 8 * d.length)));
  return r.toLowerCase();
};
function M(d) {
  for (var _, m = "0123456789ABCDEF", f = "", r = 0; r < d.length; r++)
    (_ = d.charCodeAt(r)), (f += m.charAt((_ >>> 4) & 15) + m.charAt(15 & _));
  return f;
}
function X(d) {
  for (var _ = Array(d.length >> 2), m = 0; m < _.length; m++) _[m] = 0;
  for (m = 0; m < 8 * d.length; m += 8)
    _[m >> 5] |= (255 & d.charCodeAt(m / 8)) << m % 32;
  return _;
}
function V(d) {
  for (var _ = "", m = 0; m < 32 * d.length; m += 8)
    _ += String.fromCharCode((d[m >> 5] >>> m % 32) & 255);
  return _;
}
function Y(d, _) {
  (d[_ >> 5] |= 128 << _ % 32), (d[14 + (((_ + 64) >>> 9) << 4)] = _);
  for (
    var m = 1732584193, f = -271733879, r = -1732584194, i = 271733878, n = 0;
    n < d.length;
    n += 16
  ) {
    var h = m,
      t = f,
      g = r,
      e = i;
    (f = md5_ii(
      (f = md5_ii(
        (f = md5_ii(
          (f = md5_ii(
            (f = md5_hh(
              (f = md5_hh(
                (f = md5_hh(
                  (f = md5_hh(
                    (f = md5_gg(
                      (f = md5_gg(
                        (f = md5_gg(
                          (f = md5_gg(
                            (f = md5_ff(
                              (f = md5_ff(
                                (f = md5_ff(
                                  (f = md5_ff(
                                    f,
                                    (r = md5_ff(
                                      r,
                                      (i = md5_ff(
                                        i,
                                        (m = md5_ff(
                                          m,
                                          f,
                                          r,
                                          i,
                                          d[n + 0],
                                          7,
                                          -680876936
                                        )),
                                        f,
                                        r,
                                        d[n + 1],
                                        12,
                                        -389564586
                                      )),
                                      m,
                                      f,
                                      d[n + 2],
                                      17,
                                      606105819
                                    )),
                                    i,
                                    m,
                                    d[n + 3],
                                    22,
                                    -1044525330
                                  )),
                                  (r = md5_ff(
                                    r,
                                    (i = md5_ff(
                                      i,
                                      (m = md5_ff(
                                        m,
                                        f,
                                        r,
                                        i,
                                        d[n + 4],
                                        7,
                                        -176418897
                                      )),
                                      f,
                                      r,
                                      d[n + 5],
                                      12,
                                      1200080426
                                    )),
                                    m,
                                    f,
                                    d[n + 6],
                                    17,
                                    -1473231341
                                  )),
                                  i,
                                  m,
                                  d[n + 7],
                                  22,
                                  -45705983
                                )),
                                (r = md5_ff(
                                  r,
                                  (i = md5_ff(
                                    i,
                                    (m = md5_ff(
                                      m,
                                      f,
                                      r,
                                      i,
                                      d[n + 8],
                                      7,
                                      1770035416
                                    )),
                                    f,
                                    r,
                                    d[n + 9],
                                    12,
                                    -1958414417
                                  )),
                                  m,
                                  f,
                                  d[n + 10],
                                  17,
                                  -42063
                                )),
                                i,
                                m,
                                d[n + 11],
                                22,
                                -1990404162
                              )),
                              (r = md5_ff(
                                r,
                                (i = md5_ff(
                                  i,
                                  (m = md5_ff(
                                    m,
                                    f,
                                    r,
                                    i,
                                    d[n + 12],
                                    7,
                                    1804603682
                                  )),
                                  f,
                                  r,
                                  d[n + 13],
                                  12,
                                  -40341101
                                )),
                                m,
                                f,
                                d[n + 14],
                                17,
                                -1502002290
                              )),
                              i,
                              m,
                              d[n + 15],
                              22,
                              1236535329
                            )),
                            (r = md5_gg(
                              r,
                              (i = md5_gg(
                                i,
                                (m = md5_gg(
                                  m,
                                  f,
                                  r,
                                  i,
                                  d[n + 1],
                                  5,
                                  -165796510
                                )),
                                f,
                                r,
                                d[n + 6],
                                9,
                                -1069501632
                              )),
                              m,
                              f,
                              d[n + 11],
                              14,
                              643717713
                            )),
                            i,
                            m,
                            d[n + 0],
                            20,
                            -373897302
                          )),
                          (r = md5_gg(
                            r,
                            (i = md5_gg(
                              i,
                              (m = md5_gg(m, f, r, i, d[n + 5], 5, -701558691)),
                              f,
                              r,
                              d[n + 10],
                              9,
                              38016083
                            )),
                            m,
                            f,
                            d[n + 15],
                            14,
                            -660478335
                          )),
                          i,
                          m,
                          d[n + 4],
                          20,
                          -405537848
                        )),
                        (r = md5_gg(
                          r,
                          (i = md5_gg(
                            i,
                            (m = md5_gg(m, f, r, i, d[n + 9], 5, 568446438)),
                            f,
                            r,
                            d[n + 14],
                            9,
                            -1019803690
                          )),
                          m,
                          f,
                          d[n + 3],
                          14,
                          -187363961
                        )),
                        i,
                        m,
                        d[n + 8],
                        20,
                        1163531501
                      )),
                      (r = md5_gg(
                        r,
                        (i = md5_gg(
                          i,
                          (m = md5_gg(m, f, r, i, d[n + 13], 5, -1444681467)),
                          f,
                          r,
                          d[n + 2],
                          9,
                          -51403784
                        )),
                        m,
                        f,
                        d[n + 7],
                        14,
                        1735328473
                      )),
                      i,
                      m,
                      d[n + 12],
                      20,
                      -1926607734
                    )),
                    (r = md5_hh(
                      r,
                      (i = md5_hh(
                        i,
                        (m = md5_hh(m, f, r, i, d[n + 5], 4, -378558)),
                        f,
                        r,
                        d[n + 8],
                        11,
                        -2022574463
                      )),
                      m,
                      f,
                      d[n + 11],
                      16,
                      1839030562
                    )),
                    i,
                    m,
                    d[n + 14],
                    23,
                    -35309556
                  )),
                  (r = md5_hh(
                    r,
                    (i = md5_hh(
                      i,
                      (m = md5_hh(m, f, r, i, d[n + 1], 4, -1530992060)),
                      f,
                      r,
                      d[n + 4],
                      11,
                      1272893353
                    )),
                    m,
                    f,
                    d[n + 7],
                    16,
                    -155497632
                  )),
                  i,
                  m,
                  d[n + 10],
                  23,
                  -1094730640
                )),
                (r = md5_hh(
                  r,
                  (i = md5_hh(
                    i,
                    (m = md5_hh(m, f, r, i, d[n + 13], 4, 681279174)),
                    f,
                    r,
                    d[n + 0],
                    11,
                    -358537222
                  )),
                  m,
                  f,
                  d[n + 3],
                  16,
                  -722521979
                )),
                i,
                m,
                d[n + 6],
                23,
                76029189
              )),
              (r = md5_hh(
                r,
                (i = md5_hh(
                  i,
                  (m = md5_hh(m, f, r, i, d[n + 9], 4, -640364487)),
                  f,
                  r,
                  d[n + 12],
                  11,
                  -421815835
                )),
                m,
                f,
                d[n + 15],
                16,
                530742520
              )),
              i,
              m,
              d[n + 2],
              23,
              -995338651
            )),
            (r = md5_ii(
              r,
              (i = md5_ii(
                i,
                (m = md5_ii(m, f, r, i, d[n + 0], 6, -198630844)),
                f,
                r,
                d[n + 7],
                10,
                1126891415
              )),
              m,
              f,
              d[n + 14],
              15,
              -1416354905
            )),
            i,
            m,
            d[n + 5],
            21,
            -57434055
          )),
          (r = md5_ii(
            r,
            (i = md5_ii(
              i,
              (m = md5_ii(m, f, r, i, d[n + 12], 6, 1700485571)),
              f,
              r,
              d[n + 3],
              10,
              -1894986606
            )),
            m,
            f,
            d[n + 10],
            15,
            -1051523
          )),
          i,
          m,
          d[n + 1],
          21,
          -2054922799
        )),
        (r = md5_ii(
          r,
          (i = md5_ii(
            i,
            (m = md5_ii(m, f, r, i, d[n + 8], 6, 1873313359)),
            f,
            r,
            d[n + 15],
            10,
            -30611744
          )),
          m,
          f,
          d[n + 6],
          15,
          -1560198380
        )),
        i,
        m,
        d[n + 13],
        21,
        1309151649
      )),
      (r = md5_ii(
        r,
        (i = md5_ii(
          i,
          (m = md5_ii(m, f, r, i, d[n + 4], 6, -145523070)),
          f,
          r,
          d[n + 11],
          10,
          -1120210379
        )),
        m,
        f,
        d[n + 2],
        15,
        718787259
      )),
      i,
      m,
      d[n + 9],
      21,
      -343485551
    )),
      (m = safe_add(m, h)),
      (f = safe_add(f, t)),
      (r = safe_add(r, g)),
      (i = safe_add(i, e));
  }
  return Array(m, f, r, i);
}
function md5_cmn(d, _, m, f, r, i) {
  return safe_add(bit_rol(safe_add(safe_add(_, d), safe_add(f, i)), r), m);
}
function md5_ff(d, _, m, f, r, i, n) {
  return md5_cmn((_ & m) | (~_ & f), d, _, r, i, n);
}
function md5_gg(d, _, m, f, r, i, n) {
  return md5_cmn((_ & f) | (m & ~f), d, _, r, i, n);
}
function md5_hh(d, _, m, f, r, i, n) {
  return md5_cmn(_ ^ m ^ f, d, _, r, i, n);
}
function md5_ii(d, _, m, f, r, i, n) {
  return md5_cmn(m ^ (_ | ~f), d, _, r, i, n);
}
function safe_add(d, _) {
  var m = (65535 & d) + (65535 & _);
  return (((d >> 16) + (_ >> 16) + (m >> 16)) << 16) | (65535 & m);
}
function bit_rol(d, _) {
  return (d << _) | (d >>> (32 - _));
}
