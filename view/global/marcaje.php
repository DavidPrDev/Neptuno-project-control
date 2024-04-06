<div class="container contenido ">
    <span data-numero="1" class="d-none pagina-actual"></span>
    <main class='mt-4'>
        <div class="row">
            <div class="col-sm-4 d-sm-block d-none"></div>
            <div class="col-sm-4 col-12 text-center text-light colMarcaje">
                <h4><?= $dataToView["data"]->getNombre() ?></h4>
                <p><b><?= $dataToView["data"]->getEmail() ?></b>
                <p>
                <div id="horaActual"></div>
                <div id="fecha" class="mb-3"></div>
                <button class="btn btn-primary <?= $dataToView["data"]->getBtnEntrada() ?>" id="ficharEntrada">
                    entrada
                </button>
                <button class="btn btn-primary <?= $dataToView["data"]->getBtnPausar() ?>" id="pausar">
                    Pausar
                </button>
                <button class="btn btn-primary <?= $dataToView["data"]->getBtnReanudar() ?>" id="reanudar">
                    reanudar
                </button>
                <button class="btn btn-primary <?= $dataToView["data"]->getBtnFin() ?>" id="ficharSalida">
                    salida
                </button><br>
                <button class="btn btn-success mt-3 <?= $dataToView["data"]->getBtnEntrada() ?>" id="añadirComentario">añadir comentario</button>

                <textarea class="form-control mt-2 boton-oculto <?= $dataToView["data"]->getBtnEntrada() ?>" id="comentario" rows="5" placeholder="Escribe tu comentario aquí..."></textarea>

            </div>
            <div class="col-sm-4 d-sm-block d-none"></div>
        </div>
    </main>
</div>