$(function () {
  ////////////////////RELOJ FICHAR//////////////////////////////
  var currentDate = new Date();

  var day = currentDate.getDate();
  var meses = [
    "enero",
    "febrero",
    "marzo",
    "abril",
    "mayo",
    "junio",
    "julio",
    "agosto",
    "septiembre",
    "octubre",
    "noviembre",
    "diciembre",
  ];
  var month = currentDate.getMonth();
  var year = currentDate.getFullYear();

  $("#fecha").html(day + " de " + meses[month] + " de " + year);

  function actualizarHora() {
    var currentHours = new Date();
    var horas = añadirCero(currentHours.getHours());
    var minutos = añadirCero(currentHours.getMinutes());
    var segundos = añadirCero(currentHours.getSeconds());

    $("#horaActual").html(horas + ":" + minutos + ":" + segundos);
  }

  actualizarHora();

  setInterval(actualizarHora, 1000);
  ////////////////////FIN RELOJ FICHAR//////////////////////////////

  ////////////////////MARCAJE DIARIO///////////////////////////////

  $("#ficharEntrada").click(function () {
    var horaActual = $("#horaActual").html();
    Swal.fire({
      icon: "success",
      title: "Hora Entrada <br>" + horaActual,
      showConfirmButton: false,
      timer: 2000,
    });
    var comentario = $("#comentario").val();
    var jsonData = JSON.stringify({ comentario: comentario });

    $.ajax({
      type: "POST",
      url: "ajax/horaMarcajeEntrada.php",
      data: { jsonData: jsonData },
      success: function (respuesta) {
        $("#ficharEntrada").hide();
        $("#comentario").addClass("boton-oculto");
        $("#añadirComentario").addClass("boton-oculto");
        $("#pausar").removeClass("boton-oculto");
      },
      error: function () {
        console.log("error");
      },
    });
  });
  $("#añadirComentario").click(function () {
    $("#comentario").removeClass("boton-oculto");
    $("#añadirComentario").addClass("boton-oculto");
  });

  $("#pausar").click(function () {
    Swal.fire({
      icon: "success",
      title: "Horario en pausa",
      showConfirmButton: false,
      timer: 2000,
    });
    $.ajax({
      type: "POST",
      url: "ajax/horaMarcajePausa.php",
      success: function (respuesta) {

        $("#reanudar").removeClass("boton-oculto");
        $("#pausar").addClass("boton-oculto");
        $("#ficharSalida").addClass("boton-oculto");
      },
      error: function () {
        console.log("error");
      },
    });
  });
  $("#reanudar").click(function () {
    Swal.fire({
      icon: "success",
      title: "Horario reanudado",
      showConfirmButton: false,
      timer: 2000,
    });
    $.ajax({
      type: "POST",
      url: "ajax/horaMarcajeReanudar.php",
      success: function (respuesta) {
     
        $("#reanudar").addClass("boton-oculto");
        $("#ficharSalida").removeClass("boton-oculto");
      },
      error: function () {
        console.log("error");
      },
    });
  });

  $("#ficharSalida").click(function () {
    var horaActual = $("#horaActual").html();
    Swal.fire({
      icon: "success",
      title: "Jornada finalizada " + horaActual,
      showConfirmButton: false,
      timer: 2000,
    });
    $.ajax({
      type: "GET",
      url: "ajax/horaMarcajeSalida.php",
      success: function (response) {
     
        $("#ficharSalida").addClass("boton-oculto");
        $("#reanudar").addClass("boton-oculto");
        $("#pausar").addClass("boton-oculto");
      },
      error: function () {
        $("#response").html("Error en la solicitud AJAX.");
      },
    });
  });
});
