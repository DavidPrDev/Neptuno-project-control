$(function () {

  $("#seleccionProyectos").change(function () {
    var idProyecto = $(this).val();
    $(
      "#nombreProyecto, #descripcion, #fechaInicio, #fechaFinalizacion, #horasTotal, #cliente, #idEquipo, #prioridad"
    ).fadeOut("fast", function () {
     
      $.ajax({
        type: "POST",
        url: "ajax/detalleProyecto.php",
        data: "data=" + idProyecto,
        dataType: "json",
        success: function (respuesta) {
          $('#collapseOne').collapse('hide');
      
          $("#nombreProyecto").html(respuesta.nombreProyecto);
          $("#descripcion").html(respuesta.descripcion);
          $("#fechaInicio").html(respuesta.fechaInicio);
          $("#fechaFinalizacion").html(respuesta.fechaFinalizacion);
          $("#horasTotal").html(respuesta.horas_total);
          $("#cliente").html(respuesta.Cliente);
          $("#idEquipo").html(respuesta.idEquipo);
          $("#prioridad").html(respuesta.prioridad);

          var etapas=respuesta.etapas;
          
          html="";
          
            if(etapas.length>0){
              $("#infoEtapa").html("");
              $("#tablaEtapas").html("");

              html += "<thead><tr><th scope='col'>Id etapa</th><th scope='col'>Nombre etapa</th>"
              html+="<th scope='col'>descripcion</th><th scope='col'>Estado</th></tr></thead>";

              for(var i=0;i<etapas.length;i++)
              {  
                estado = etapas[i].completada == 1 ? "<i data-toggle='tooltip' data-placement='top' title='Tarea Completada' class='fa-solid fa-check fa-lg completada'></i>" : "<a data-toggle='tooltip' data-placement='top' title='Clicke para completar' href='javascript:completarEtapa(" + etapas[i].idEtapa + ")'><i class='fa-solid fa-x fa-lg noCompletada' data-bs-toggle='modal' data-bs-target='#modalCompletarEtapa'></i></a>";
                html += "<tr><td>"+etapas[i].idEtapa+"</td>";
                html += "<td>"+etapas[i].nombreEtapa+"</td>";
                html += "<td>"+etapas[i].descripcion+"</td>";
                html += "<td>" + estado + "</td></tr>";

              }
               html+="</tbody>";
               $("#tablaEtapas").append(html);
            }else{
              $("#tablaEtapas").html("Este proyecto no tiene etapas");
            }
            
            

          $(
            "#nombreProyecto, #descripcion, #fechaInicio, #fechaFinalizacion, #horasTotal, #cliente, #idEquipo, #prioridad"
          ).fadeIn("fast");
          $('[data-toggle="tooltip"]').tooltip();
        },
        error: function () {
          alert("Error al realizar la solicitud AJAX");
        },
      });
    });
  });
 
});
