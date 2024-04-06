<div class="container-fluid">
    <span data-numero="2" class="d-none pagina-actual"></span>
    <div class="container contenido">
        <main>
            <div class="row">
                <div class="col-2"></div>
                <div class=" col-8">
                    <h3 class="text-center mt-2">Datos personales</h3>
                    <button id="editarDatosEmpleadosD" class="btn btn-success">Editar</button>
                    <button id="guardarEmpleadoD" class="btn btn-success boton-oculto">Guardar</button>
                    <button id="cancelarGuardarEmpleadoD" class="btn btn-danger boton-oculto">Cancelar</button>
                    <?= $dataToView["data"] ?>
                </div>
                <div class=" col-2 botonesOcultos">
                    <button class='btn btn-edicion btn-primary boton-oculto' id='editarNombreD'>+</button><br>
                    <button class='btn btn-edicion btn-primary botonSecundarioEditar boton-oculto' id='editarDireccionD'>+</button><br>
                    <button class='btn btn-edicion btn-primary botonSecundarioEditar boton-oculto' id='editarPaisD'>+</button><br>
                    <button class='btn btn-edicion btn-primary botonSecundarioEditar boton-oculto' id='editarCiudadD'>+</button><br>
                    <button class='btn btn-edicion btn-primary botonSecundarioEditar boton-oculto' id='editarTelefonoD'>+</button><br>
                    <button class='btn btn-edicion btn-primary botonSecundarioEditar boton-oculto' id='editarUsuarioD'>+</button><br>
                    <button class='btn btn-edicion btn-primary botonSecundarioEditar boton-oculto' id='editarContrasennaD'>+</button><br>
                    <button class='btn btn-edicion btn-primary botonSecundarioEditar boton-oculto' id='editarEmailD'>+</button><br>

                </div>
            </div>
        </main>
    </div>
</div>