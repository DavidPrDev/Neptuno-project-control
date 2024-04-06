<main>
    <span data-numero="4" class="d-none pagina-actual"></span>
    <div class="container contenido">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center">Listado de Etapa </h1>

                <table id="tblEtapas" class="table tablaCrud display responsive">
                    <thead>
                        <tr>
                            <th>Id Etapa</th>
                            <th>Nombre Etapa</th>
                            <th>Nombre Proyecto</th>
                            <th>Completada</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?= $dataToView["data"] ?>
                    </tbody>

                </table>
                <div class=" d-flex flex-row-reverse">

                </div>

            </div>
        </div>
    </div>
</main>
<div class="modal fade" id="staticBackdropEtapas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center text-center" id="staticBackdropLabelEtapas"></h5>

                <button type="button" class="btn btn-danger   botonSecundarioModalE" id="revertirEntrega">Revertir entrega</button>
                <button type="button" class="btn-close cerrarEdicionEquipos" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="nombreEtapa" class="col-form-label"><b>Nombre etapa</b></label>
                    </div>
                    <div class="col-8">
                        <input type='text' class='form-control' id="nombreEtapa" class="form-control" disabled>

                    </div>
                    <div class="col-1"></div>
                </div>
                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="nombreProyecto" class="col-form-label"><b>Nombre Proyecto</b></label>
                    </div>
                    <div class="col-8">
                        <input type='text' class='form-control' id="nombreProyecto" class="form-control" disabled>



                    </div>
                    <div class="col-1"></div>
                </div>

                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="nombreEmpleado" class="col-form-label"><b>Nombre Empleado </b></label>
                    </div>
                    <div class="col-8">
                        <input type='text' class='form-control' id="nombreEmpleado" class="form-control" disabled>

                    </div>
                    <div class="col-1"></div>
                </div>
                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="comentarioEntrega" class="col-form-label"><b>comentario</b></label>
                    </div>
                    <div class="col-8">
                        <textarea type='text' class='form-control' id="comentarioEntrega" class="form-control" disabled></textarea>

                    </div>
                    <div class="col-1"></div>
                </div>
                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="horasEtapa" class="col-form-label"><b>Horas invertidas</b></label>
                    </div>
                    <div class="col-8">
                        <input type='text' class='form-control' id="horasEtapa" class="form-control" disabled>

                    </div>
                    <div class="col-1"></div>
                </div>

                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="fehcaEntrega" class="col-form-label"><b>Fecha entrega</b></label>
                    </div>
                    <div class="col-8">
                        <input type='text' class='form-control' id="fehcaEntrega" class="form-control" disabled>

                    </div>
                    <div class="col-1"></div>
                </div>
                <input type="hidden" id="idEmpleado" value="" />
                <input type="hidden" id="idProyecto" value="" />
                <input type="hidden" id="idEtapa" value="" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cerrarEdicionEquipos" data-bs-dismiss="modal">cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="staticBackdropCrearEtapas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="staticBackdropLabel">Datos Etapa</h5>

                <button type="button" class="btn btn-success   botonSecundarioModalE" id="guardarEtapa">Guardar Etapa</button>
                <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="nombreProyecto" class="col-form-label"><b>Nombre Proyecto</b></label>
                    </div>
                    <div class="col-8">
                        <select class='form-control' id="nombreProyectoCrear" class="form-control">

                        </select>
                    </div>
                    <div class="col-1"></div>
                </div>

                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="nombreEtapaCrear" class="col-form-label"><b>Nombre etapa</b></label>
                    </div>
                    <div class="col-8">
                        <input type='text' class='form-control' id="nombreEtapaCrear" class="form-control">

                    </div>
                    <div class="col-1"></div>
                </div>


                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="descripcionEtapa" class="col-form-label"><b>Descripcion</b></label>
                    </div>
                    <div class="col-8">
                        <textarea type='text' class='form-control' id="descripcionEtapa" class="form-control"></textarea>

                    </div>
                    <div class="col-1"></div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">cerrar</button>
            </div>
        </div>
    </div>
</div>