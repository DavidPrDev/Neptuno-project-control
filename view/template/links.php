        <!-- Si utilizamos componentes de Bootstrap que requieran Javascript agregar el siguiente archivo -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous">
        </script>
        <!--CDN Jquery -->
        <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
        <!--CDN Datatable -->
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables-responsive/2.5.0/dataTables.responsive.min.js" integrity="sha512-DY4twak65A5MI1m/CEKadDVrb0O8p7pLluLAXvpg0FjuQ4ZSzKyfcUtkM+ek4fIVUeaD7+nsv9k+mzTcFsDXIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.datatables.net/colreorder/1.5.2/js/dataTables.colReorder.min.js"></script>
        <!-- fontawesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- Noty -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script src="content/scripts/scriptsFunctions.js"></script>
        <?php if (isset($_SESSION['IdEmpleado'])) {

            switch ($_SESSION['categoria']) {
                case "1":

                    echo '<script src="content/scripts/scriptsAdmin.js"></script>';
                    break;

                case "2":

                    echo '<script src="content/scripts/scriptsDev.js"></script>';

                    break;
                case "3":

                    echo '<script src="content/scripts/scriptsJefe.js"></script>';

                    break;
            }
        }
        ?>
        <script src="content/scripts/scriptsMarcaje.js"></script>
        <script src="content/scripts/scriptsGeneral.js"></script>
        </body>

        </html>