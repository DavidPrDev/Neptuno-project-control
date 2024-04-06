<body>

    <div class="container-fluid bg-dark ">
        <header>
            <div class="row" id="espaciador">
                <div class="col-8 mb-4 d-block d-sm-none"></div>
            </div>
            <div class="row">

                <div class="col-lg-1  d-none d-lg-block">

                </div>

                <div class="col-lg-7 col-8">
                    <h1 class="text-light text-end mt-2" id="titulo">Neptuno Project Control</h1>
                </div>

                <div class="col-lg-4 col-4 logOut text-center ">
                    <?php

                    if (isset($_SESSION["usuario"])) {
                        echo "<div id='logOut'>
                      <span class='text-light' >Hola " . $_SESSION["usuario"] . "</span></br>
                     <button class='btn btn-danger'><a id='enlaceLogOut' href='logout/' >Cerrar Sesiónn</a></button> 
                    </div>  ";
                    } ?>

                </div>
            </div>
        </header>
    </div>