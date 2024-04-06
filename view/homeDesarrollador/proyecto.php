<div class="container contenido">
    <span data-numero="3" class="d-none pagina-actual"></span>
    <main>
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <h3 class="text-center">datos proyecto</h3>
                <?= $dataToView["data"] ?>
            </div>
            <div class="col-1"></div>

        </div>
        <div class="modal fade" id="modalCompletarEtapa" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="staticBackdropLabel"></h5>

                        <button type="button" class="btn btn-success  botonSecundarioModal" id="completarEtapa">Guardar</button>

                        <button type="button" class="btn-close cerrarEdicionEmpleado" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3 align-items-center mt-1">
                            <div class="col-3">
                                <label for="horasRegistradas" class="col-form-label"><b>Horas empleadas</b></label>
                            </div>
                            <div class="col-8">
                                <div class="row ">
                                    <div class="col-3 "><input id="horas" type="number" id="horas" min="0" max="100" class="form-control horas horasRegistradas text-center"></div>
                                    <div class="col-1 separador"><span><b>:</b></span></div>
                                    <div class="col-3 "><input type="number" id="minutos" min="0" max="59" class="form-control minSec horasRegistradas text-center"></div>
                                    <div class="col-1 separador"><span><b>:</b></span></div>
                                    <div class="col-3 "><input type="number" id="segundos" min="0" max="59" class="form-control minSec horasRegistradas text-center"></div>
                                    <div class="col-sm-1 "></div>
                                </div>

                                <span id="containerHora" class="text-center"></span>
                                <span id="containerMinSec" class="text-center"></span>

                            </div>
                        </div>
                        <div class="row g-3 align-items-center mt-1">
                            <div class="col-3">
                                <label for="comentario" class="col-form-label"><b>Comentario</b></label>
                            </div>
                            <div class="col-8">
                                <textarea id="comentario" class="form-control"></textarea>
                            </div>
                            <div class="col-1"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary cerrarEdicionEmpleado" data-bs-dismiss="modal">cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

</div>