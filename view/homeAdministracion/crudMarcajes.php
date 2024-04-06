<main>
    <span data-numero="5" class="d-none pagina-actual"></span>
    <div class="container contenido">
        <div class="row">
            <div class="col">
                <h1 class="text-center">Control marcajes </h1>
                <table id="tblMarcaje" class="table  tablaCrud display responsive">
                    <thead>

                        <tr>
                            <th>id</th>
                            <th>Nombre</th>
                            <th>Hora entrada</th>
                            <th>Hora salida </th>
                            <th>Fecha</th>
                            <th>Jornada finalizada</th>
                            <th>Accioes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?= $dataToView["data"] ?>
                    </tbody>

                </table>
                <div class="d-flex flex-row-reverse">

                </div>

            </div>
        </div>
    </div>
</main>
<div class="modal fade" id="staticBackdropMarcaje" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="staticBackdropLabel">Datos de <span id="nombreMarcaje"></span>
                </h5>
                <button type="button" class="btn btn-primary " id="editarMarcaje">Editar</button>
                <button type="button" class="btn btn-success  boton-oculto botonSecundarioModal" id="guardarMarcaje">Guardar</button>
                <button type="button" class="btn btn-danger  boton-oculto botonSecundarioModal" id='cancelarGuardarMarcaje'>Cancelar</button>
                <button type="button" class="btn-close cancelarGuardadoX cancelarGuardarMarcaje" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="idMarcaje" class="col-form-label"><b>ID Marcaje</b></label>
                    </div>
                    <div class="col-8">
                        <input type="text" id="idMarcaje" class="form-control" disabled>
                    </div>
                    <div class="col-1"></div>
                </div>

                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="nombreEmpleado" class="col-form-label"><b>Nombre </b></label>
                    </div>
                    <div class="col-8">
                        <input type="text" id="nombreEmpleado" class="form-control" disabled>
                    </div>
                    <div class="col-1"></div>
                </div>

                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="horaEntrada" class="col-form-label"><b>Hora Entrada</b></label>
                    </div>
                    <div class="col-8">

                        <input class="form-control" id="horaEntrada" type="time" step="2" disabled>

                    </div>
                    <div class="col-1"><button class="btn btn-edicion btn-primary boton-oculto" id="editarHoraEntrada">+</button></div>
                </div>

                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="horaSalida" class="col-form-label"><b>Hora Salida</b></label>
                    </div>
                    <div class="col-8">
                        <input type="time" id="horaSalida" step="2" class="form-control" disabled>
                    </div>
                    <div class="col-1"><button class="btn btn-edicion btn-primary boton-oculto" id="editarHoraSalida">+</button></div>
                </div>

                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="fecha" class="col-form-label"><b>Fecha</b></label>
                    </div>
                    <div class="col-8">
                        <input type="date" id="fecha" class="form-control" disabled>
                    </div>
                    <div class="col-1"></div>
                </div>

                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="comentario" class="col-form-label"><b>Comentario</b></label>
                    </div>
                    <div class="col-8">
                        <textarea id="comentario" class="form-control" disabled></textarea>
                    </div>
                    <div class="col-1"><button class="btn btn-edicion btn-primary boton-oculto" id="editarComentario">+</button></div>
                </div>

                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="horasJornada" class="col-form-label"><b> Horas Jornada</b></label>
                    </div>
                    <div class="col-8">
                        <input type="time" id="horasJornada" class="form-control" step="2" disabled>
                    </div>
                    <div class="col-1"><button class="btn btn-edicion btn-primary boton-oculto" id="editarHorasJornada">+</button></div>
                </div>

                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="jornadaFinalizada" class="col-form-label"><b>Jornada Finalizada</b></label>
                    </div>
                    <div class="col-8">

                        <select id="jornadaFinalizada" class="form-control" disabled>
                            <option value="0">No</option>
                            <option value="1">Si</option>
                        </select>
                    </div>
                    <div class="col-1"><button class="btn btn-edicion btn-primary boton-oculto" id="editarJornadaFinalizada">+</button></div>
                </div>

                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="horaPausa" class="col-form-label"><b>Hora pausa</b></label>
                    </div>
                    <div class="col-8">
                        <input type="time" step="2" id="horaPausa" class="form-control" disabled>
                    </div>
                    <div class="col-1"><button class="btn btn-edicion btn-primary boton-oculto" id="editarHoraPausa">+</button></div>
                </div>

                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="horaFinPausa" class="col-form-label"><b>Hora fin pausa</b></label>
                    </div>
                    <div class="col-8">
                        <input type="time" step="2" id="horaFinPausa" class="form-control" disabled>
                    </div>
                    <div class="col-1"><button class="btn btn-edicion btn-primary boton-oculto" id="editarFinPausa">+</button></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cancelarGuardadoX cancelarGuardarMarcaje" data-bs-dismiss="modal">cerrar</button>
            </div>
        </div>
    </div>
</div>