<main>
    <span data-numero="5" class="d-none pagina-actual"></span>
    <div class="container contenido">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center">Listado de Equipos </h1>
                <table id="tblEquipos" class="table tablaCrud display responsive">
                    <thead>
                        <tr>
                            <th>Id Equipo</th>
                            <th>Nombre Proyecto</th>
                            <th>Jefe Equipo</th>
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
<div class="modal fade" id="staticBackdropEquipos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="staticBackdropLabel">Datos Equipo</h5>
                <button type="button" class="btn btn-primary botonGuardarModal" id="editarModalEquipos">Editar
                    Equipo</button>
                <button type="button" class="btn btn-primary  boton-oculto " id="añadirEmpleado">Añadir empleado</button>
                <button type="button" class="btn btn-success  boton-oculto botonSecundarioModalE" id="guardarEquipo">Guardar</button>
                <button type="button" class="btn btn-danger  boton-oculto botonSecundarioModalE" id="cancelarGuardarEquipo">Cancelar</button>
                <button type="button" class="btn-close cerrarEdicionEquipos" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="idEquipo" class="col-form-label"><b>ID Equipo</b></label>
                    </div>
                    <div class="col-8">
                        <input type="hidden" id="idEquipoA" class="form-control">
                        <input type="text" id="idEquipo" class="form-control" disabled>
                    </div>
                    <div class="col-1"></div>
                </div>

                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="nombreProyecto" class="col-form-label"><b>Nombre Proyecto</b></label>
                    </div>
                    <div class="col-8">
                        <select id="nombreProyecto" class="form-control" disabled>

                        </select>

                    </div>
                    <div class="col-1"><button class="btn btn-edicion btn-primary boton-oculto" id="editarNombreProyecto">+</button></div>
                </div>

                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="jefeEquipo" class="col-form-label"><b>Jefe equipo</b></label>
                    </div>
                    <div class="col-8">
                        <select id="jefeEquipo" class="form-control" disabled>
                        </select>
                    </div>
                    <div class="col-1"><button class="btn btn-primary btn-edicion boton-oculto" id="editarJefeEquipo">+</button></div>
                </div>

                <div id="selectEmpleados"></div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cerrarEdicionEquipos" data-bs-dismiss="modal">cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="staticBackdropCrearEquipos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="staticBackdropLabel">Creacion Equipo</h5>

                <button type="button" class="btn btn-success botonGuardarModal" id="guardarEquipoNuevo">Guardar
                    Equipo </button>
                <button type="button" class="btn-close cerrarCreacionEquipo" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="crearNombreProyecto" class="col-form-label"><b>Nombre Proyecto</b></label>
                    </div>
                    <div class="col-8">
                        <select type="text" id="crearNombreProyecto" name="nombreEmpleadoC" class="form-control">
                        </select>
                    </div>
                    <div class="col-1"></div>
                </div>

                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="crearJefeEquipo" class="col-form-label"><b>Jefe equipo</b></label>
                    </div>
                    <div class="col-8">
                        <select id="crearJefeEquipo" class="form-control">
                        </select>
                    </div>
                    <div class="col-1"></div>
                </div>

                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3"><label class="col-form-label"><b>Empleados</b></label></div>
                    <div class="col-8" id="checkEmpleados"></div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cerrarCreacionEmpleado" data-bs-dismiss="modal">cerrar</button>
            </div>
        </div>
    </div>
</div>