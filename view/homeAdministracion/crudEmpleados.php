<main>
    <span data-numero="4" class="d-none pagina-actual"></span>
    <div class="container contenido">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center">Listado de Empleados </h1>
                <table id="tblEmpleados" class="table tablaCrud display responsive">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Nombre</th>
                            <th>Pais</th>
                            <th>Telefono</th>
                            <th>Usuario</th>
                            <th>Email</th>
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
<div class="modal fade" id="staticBackdropEmpleados" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="staticBackdropLabel">Datos Empleado <span id="empleadoSpan"></span>
                </h5>
                <button type="button" class="btn btn-primary botonGuardarModal" id="editarEmpleado">Editar
                    Empleado</button>
                <button type="button" class="btn btn-success  boton-oculto botonSecundarioModal" id="guardarEmpleado">Guardar</button>
                <button type="button" class="btn btn-danger  boton-oculto botonSecundarioModal " id='cancelarGuardarEmpleado'>Cancelar</button>
                <button type="button" class="btn-close cerrarEdicionEmpleado cancelarGuardarEmpleado" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="idEmpleado" class="col-form-label"><b>ID Empleado</b></label>
                    </div>
                    <div class="col-8">
                        <input type="text" id="idEmpleado" class="form-control" disabled>
                    </div>
                    <div class="col-1"></div>
                </div>

                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="nombreEmpleado" class="col-form-label"><b>Nombre Empleado</b></label>
                    </div>
                    <div class="col-8">
                        <input type="text" id="nombre" class="form-control" disabled>
                    </div>
                    <div class="col-1"><button class="btn btn-edicion btn-primary boton-oculto" id="editarNombreEmpleado">+</button></div>
                </div>

                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="direccion" class="col-form-label"><b>Direccion</b></label>
                    </div>
                    <div class="col-8">
                        <input type="text" id="direccion" class="form-control" disabled>
                    </div>
                    <div class="col-1"><button class="btn btn-primary btn-edicion boton-oculto" id="editarDireccion">+</button></div>
                </div>

                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="ciudad" class="col-form-label"><b>Ciudad</b></label>
                    </div>
                    <div class="col-8">
                        <input type="text" id="ciudad" class="form-control" disabled>
                    </div>
                    <div class="col-1"><button class="btn btn-primary btn-edicion boton-oculto" id="editarCiudad">+</button></div>
                </div>

                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="pais" class="col-form-label"><b>Pais</b></label>
                    </div>
                    <div class="col-8">
                        <input type="text" id="pais" class="form-control" disabled>
                    </div>
                    <div class="col-1"><button class="btn btn-primary btn-edicion boton-oculto" id="paisEditar">+</button></div>
                </div>

                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="telefono" class="col-form-label"><b>Telefono</b></label>
                    </div>
                    <div class="col-8">
                        <input type="text" id="telefono" class="form-control" disabled>
                    </div>
                    <div class="col-1"><button class="btn btn-primary btn-edicion boton-oculto" id="editarTelefono">+</button></div>
                </div>

                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="usuario" class="col-form-label"><b> Usuario</b></label>
                    </div>
                    <div class="col-8">
                        <input type="text" id="usuario" class="form-control" disabled>
                    </div>
                    <div class="col-1"><button class="btn btn-primary btn-edicion boton-oculto" id="editarUsuario">+</button></div>
                </div>

                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="contrasenna" class="col-form-label"><b>Contraseña</b></label>
                    </div>
                    <div class="col-8">
                        <input type="password" id="contrasenna" class="form-control" value="123456789" disabled>
                    </div>
                    <div class="col-1"><button class="btn btn-primary btn-edicion boton-oculto" id="editarContrasenna">+</button></div>
                </div>

                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="email" class="col-form-label"><b>Email</b></label>
                    </div>
                    <div class="col-8">
                        <input type="text" id="email" class="form-control" disabled>
                    </div>
                    <div class="col-1"><button class="btn btn-primary btn-edicion boton-oculto" id="editarEmail">+</button></div>
                </div>

                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="idCategoria" class="col-form-label"><b>Categoria</b></label>
                    </div>
                    <div class="col-8">
                        <select type="text" id="idCategoria" class="form-control" disabled>

                        </select>
                    </div>
                    <div class="col-1"><button class="btn btn-primary btn-edicion boton-oculto" id="editarIdCategoria">+</button></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cerrarEdicionEmpleado" data-bs-dismiss="modal">cerrar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="staticBackdropCrearEmpleados" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="staticBackdropLabel">Creacion Empleado <span id="empleadoSpan"></span>
                </h5>

                <button type="button" class="btn btn-success botonGuardarModal" id="guardaEmpleadoNuevo">Guardar
                    Empleado </button>
                <button type="button" class="btn-close cerrarCreacionEmpleado cancelarGuardarEmpleado" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="nombreEmpleadoC" class="col-form-label"><b>Nombre Empleado</b></label>
                    </div>
                    <div class="col-8">
                        <input type="text" id="nombreEmpleadoC" name="nombreEmpleadoC" class="form-control" require>
                    </div>
                    <div class="col-1"></div>
                </div>

                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="direccionC" class="col-form-label"><b>Direccion</b></label>
                    </div>
                    <div class="col-8">
                        <input type="text" id="direccionC" name="direccionC" class="form-control" require>
                    </div>
                    <div class="col-1"></div>
                </div>

                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="ciudadC" class="col-form-label"><b>Ciudad</b></label>
                    </div>
                    <div class="col-8">
                        <input type="text" id="ciudadC" name="ciudadC" class="form-control" require>
                    </div>
                    <div class="col-1"></div>
                </div>

                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="paisC" class="col-form-label"><b>Pais</b></label>
                    </div>
                    <div class="col-8">
                        <input type="text" id="paisC" name="paisC" class="form-control" require>
                    </div>
                    <div class="col-1"></div>
                </div>

                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="telefonoC" class="col-form-label"><b>Telefono</b></label>
                    </div>
                    <div class="col-8">
                        <input type="text" id="telefonoC" name="telefonoC" class="form-control" require>
                    </div>
                    <div class="col-1"></div>
                </div>

                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="usuarioC" class="col-form-label"><b> Usuario</b></label>
                    </div>
                    <div class="col-8">
                        <input type="text" id="usuarioC" name="usuarioC" class="form-control" require>
                    </div>
                    <div class="col-1"></div>
                </div>

                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="contrasennaC" class="col-form-label"><b>Contraseña</b></label>
                    </div>
                    <div class="col-8">
                        <input type="password" id="contrasennaC" name="contrasennaC" class="form-control" require>
                    </div>
                    <div class="col-1"></div>
                </div>

                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="emailC" class="col-form-label"><b>Email</b></label>
                    </div>
                    <div class="col-8">
                        <input type="text" id="emailC" name="emailC" class="form-control" require>
                    </div>
                    <div class="col-1"></div>
                </div>

                <div class="row g-3 align-items-center mt-1">
                    <div class="col-3">
                        <label for="idCategoriaC" class="col-form-label"><b>Categoria</b></label>
                    </div>
                    <div class="col-8">
                        <select type="text" id="idCategoriaC" name="idCategoriaC" class="form-control" require>

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