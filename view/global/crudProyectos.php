<main>
    <span data-numero="3" class="d-none pagina-actual"></span>
    <div class="container contenido">
        <div class="row">
            <div class="col">
                <h1 class="text-center">Listado de proyectos </h1>
                <table id="tblProyectos" class="table responsive display tablaCrud">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Nombre Proyecto</th>
                            <th>Fecha Finalizacion</th>
                            <th>Horas Registradas</th>
                            <th>Horas total</th>
                            <th>Cliente</th>
                            <th>Prioridad</th>
                            <th>Acciones</th>
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
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="staticBackdropLabel">Projecto <span id="clienteSpan"></span>
                </h5>
                <button type="button" class="btn btn-primary botonGuardarModal" id="editarModal">Editar
                    Proyecto</button>
                <button type="button" class="btn btn-success  boton-oculto botonSecundarioModal" id="guardarModal">Guardar</button>
                <button type="button" class="btn btn-danger  boton-oculto botonSecundarioModal " id='cancelarGuardar'>Cancelar</button>
                <button type="button" class="btn-close cerrarModalEdicion cancelarGuardar" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="idProyecto" class="col-form-label"><b>ID Proyecto</b></label>
                    </div>
                    <div class="col-8">
                        <input type="text" id="idProyecto" class="form-control" disabled>
                    </div>
                    <div class="col-1"></div>
                </div>

                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="nombreProyecto" class="col-form-label"><b>Nombre Proyecto</b></label>
                    </div>
                    <div class="col-8">
                        <input type="text" id="nombreProyecto" class="form-control" disabled>
                    </div>
                    <div class="col-1"><button class="btn btn-edicion btn-primary boton-oculto" id="editarNombre">+</button></div>
                </div>

                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="descripcion" class="col-form-label"><b>Descripción</b></label>
                    </div>
                    <div class="col-8">
                        <textarea id="descripcion" class="form-control" disabled><b>Texto existente</b></textarea>
                    </div>
                    <div class="col-1"><button class="btn btn-primary btn-edicion boton-oculto" id="editarDescripcion">+</button></div>
                </div>

                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="fechaInicio" class="col-form-label"><b>Fecha de Inicio</b></label>
                    </div>
                    <div class="col-8">
                        <input type="date" id="fechaInicio" class="form-control" disabled>
                    </div>
                    <div class="col-1"><button class="btn btn-primary btn-edicion boton-oculto" id="editarFechaInicio">+</button></div>
                </div>

                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="fechaFinalizacion" class="col-form-label"><b>Fecha de Finalización</b></label>
                    </div>
                    <div class="col-8">
                        <input type="date" id="fechaFinalizacion" class="form-control" disabled>
                    </div>
                    <div class="col-1"><button class="btn btn-primary btn-edicion boton-oculto" id="editarFechaFin">+</button></div>
                </div>

                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="horasRegistradas" class="col-form-label"><b>Horas registradas</b></label>
                    </div>
                    <div class="col-8">
                        <div class="row ">
                            <div class="col-3 "><input id="horas" type="number" id="horas" min="0" max="100" class="form-control horas horasRegistradas text-center" disabled></div>
                            <div class="col-1 separador"><span><b>:</b></span></div>
                            <div class="col-3 "><input type="number" id="minutos" min="0" max="59" class="form-control minSec horasRegistradas text-center" disabled></div>
                            <div class="col-1 separador"><span><b>:</b></span></div>
                            <div class="col-3 "><input type="number" id="segundos" min="0" max="59" class="form-control minSec horasRegistradas text-center" disabled></div>
                            <div class="col-sm-1 "></div>
                        </div>

                        <span id="containerHora" class="text-center"></span>
                        <span id="containerMinSec" class="text-center"></span>

                    </div>
                    <div class="col-1"><button class="btn btn-primary btn-edicion boton-oculto" id="editarHorasRegistradas">+</button></div>
                </div>

                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="horasTotal" class="col-form-label"><b>Horas Totales</b></label>
                    </div>

                    <div class="col-8">
                        <div class="row ">
                            <div class="col-3 "><input id="horasTotal" type="number" id="horas" min="0" max="100" class="form-control horasTotal text-center horas" disabled></div>
                            <div class="col-1 separador"><span><b>:</b></span></div>
                            <div class="col-3 "><input type="number" id="minutosTotal" min="0" max="59" class="form-control minSec horasTotal text-center" disabled></div>
                            <div class="col-1 separador"><span><b>:</b></span></div>
                            <div class="col-3 "><input type="number" id="segundosTotal" min="0" max="59" class="form-control minSec horasTotal text-center" disabled></div>
                            <div class="col-sm-1 "></div>
                        </div>

                        <span id="containerHora" class="text-center"></span>
                        <span id="containerMinSec" class="text-center"></span>
                    </div>
                    <div class="col-1"><button class="btn btn-primary btn-edicion boton-oculto" id="editarHorasTotales">+</button></div>
                </div>

                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="cliente" class="col-form-label"><b>Cliente</b></label>
                    </div>
                    <div class="col-8">
                        <input type="text" id="cliente" class="form-control" disabled>
                    </div>
                    <div class="col-1"><button class="btn btn-primary btn-edicion boton-oculto" id="editarCliente">+</button></div>
                </div>

                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="idEquipo" class="col-form-label"><b>ID Equipo</b></label>
                    </div>
                    <div class="col-8" id="checkEquipo">



                    </div>
                    <div class="col-1"><button class="btn btn-primary btn-edicion boton-oculto" id="editarIdEquipo">+</button></div>
                </div>

                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="prioridad" class="col-form-label"><b>Prioridad</b></label>
                    </div>
                    <div class="col-8">
                        <select id="prioridad" class="form-control" disabled>
                            <option value="Alta">Alta</option>
                            <option value="Media">Media</option>
                            <option value="Baja">Baja</option>
                        </select>
                    </div>
                    <div class="col-1"><button class="btn btn-primary btn-edicion boton-oculto" id="editarPrioridad">+</button></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cerrarModalEdicion" data-bs-dismiss="modal">cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="staticBackdropCrearProyecto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="staticBackdropLabel">Creacion Proyecto <span id="empleadoSpan"></span>
                </h5>

                <button type="button" class="btn btn-success botonGuardarModal" id="guardarProyectoNuevo">Guardar
                    Proyecto </button>
                <button type="button" class="btn-close cerrarCreacionProyecto cancelarGuardar" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="nombreProyectoC" class="col-form-label"><b>Nombre Proyecto</b></label>
                    </div>
                    <div class="col-8">
                        <input type="text" id="nombreProyectoC" class="form-control">
                    </div>
                    <div class="col-1"></div>
                </div>

                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="descripcionC" class="col-form-label"><b>Descripcion</b></label>
                    </div>
                    <div class="col-8">
                        <input type="text" id="descripcionC" class="form-control">
                    </div>
                    <div class="col-1"></div>
                </div>

                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="fechaInicioC" class="col-form-label"><b>Fecha Inicio</b></label>
                    </div>
                    <div class="col-8">
                        <input type="date" id="fechaInicioC" class="form-control">
                    </div>
                    <div class="col-1"></div>
                </div>

                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="fechaFinC" class="col-form-label"><b>Fecha Fin</b></label>
                    </div>
                    <div class="col-8">
                        <input type="date" id="fechaFinC" name="fechaFinC" class="form-control">
                    </div>
                    <div class="col-1"></div>
                </div>

                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="clienteC" class="col-form-label"><b>Cliente</b></label>
                    </div>
                    <div class="col-8">
                        <input type="text" id="clienteC" class="form-control">
                    </div>
                    <div class="col-1"></div>
                </div>

                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="idEquipoC" class="col-form-label"><b> Id Equipo</b></label>
                    </div>
                    <div class="col-8" id="checkEquipoCrear">


                        </select>
                    </div>
                    <div class="col-1"></div>
                </div>

                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="prioridadC" class="col-form-label"><b>Prioridad</b></label>
                    </div>
                    <div class="col-8">

                        <select id="prioridadC" class="form-control">
                            <option value="">--Seleccione--</option>
                            <option value="Alta">Alta</option>
                            <option value="Media">Media</option>
                            <option value="Baja">Baja</option>
                        </select>
                    </div>
                    <div class="col-1"></div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cerrarCreacionEmpleado" data-bs-dismiss="modal">cerrar</button>
            </div>
        </div>
    </div>
</div>