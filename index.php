<?php
include_once('parametros.php');
include_once('class/class.DBPDO.php');
$DB = new DBPDO();
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-type" content="text/html;charset=UTF-8">
        <meta name="robots" content="noindex, nofollow">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Control de Cuentas</title>
        <link rel="icon" type="image/png" href="favicon.png" />

        <script src="js/jquery.min.js"></script>

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <!--        <link rel="stylesheet" href="css/bootstrap.theme.min.css">-->
        <link rel="stylesheet" href="css/bootstrap.superhero.min.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/datepicker.css">


        <script src="js/bootstrap.js"></script>
        <script src="js/bootstrap-datepicker.js"></script>
        <script src="js/bootstrap-datepicker.es.min.js"></script>
        <script type="text/javascript">
            $(function () {
                $('.datepicker').datepicker({
                    format: "yyyy-mm-dd"
                });
            });

            function isNumberKey(evt)
            {
                var charCode = (evt.which) ? evt.which : evt.keyCode;
                if (charCode != 46 && charCode > 31
                        && (charCode < 48 || charCode > 57))
                    return false;

                return true;
            }
        </script>

    </head>
    <body>
        <?php
        if (!isset($_COOKIE["id_usuario"]) && !isset($_COOKIE["nombre_usuario"])) {
            ?>

            <div class="col-md-3"></div>
            <div class="col-md-6 text-center login">
                <h3><span class="glyphicon glyphicon-off"></span> Iniciar Sesi&oacute;n</h3>
                <form method="post" action="login.php" class="login-form">
                    <input type="text" name="usuario" class="form-control input-sm input-user" required placeholder="Usuario">
                    <input type="password" name="contrasena" class="form-control input-sm input-pass" required placeholder="Contrase&ntilde;a">
                    <button class="btn-block btn-success btn-sm input-enter" type="submit" name="login">Ingresar</button>
                    <?php if (isset($_GET['err'])) { ?>
                        <span class="label label-danger"><span class="glyphicon glyphicon-remove"></span> Verifique sus credenciales!</span>
                    <?php } ?>
                </form>
            </div>
            <div class="col-md-3"></div>


        <?php } else { ?>
            <header>
                <?php include("header.php"); ?>
            </header>
            <section>
                <div class="content">
                    <div class="wrap">
                        <?php
                        if (isset($_GET['menu'])) {
                            if ($_GET['menu'] == "deudas") {
                                include("deudas.php");
                            }
                            if ($_GET['menu'] == "abonos") {
                                include("abonos.php");
                            }
                            if ($_GET['menu'] == "consultas") {
                                include("consultas.php");
                            }
                        } else {
                            include("menu.php");
                        }
                        ?>
                    </div>
                </div>
            </section>
            <?php
            $totales = $DB->fetch("SELECT SUM(monto)as total FROM deudas WHERE id_usuario=" . $_COOKIE["id_usuario"]);
            $totales_pie = $totales['total'];
            $abonos = $DB->fetch("SELECT SUM(valor)as total FROM abonos WHERE id_deudas IN (SELECT id FROM deudas WHERE id_usuario=" . $_COOKIE["id_usuario"] . ")");
            $abonos_pie = $abonos['total'];
            ?>
            <footer>
                <div class="col-lg-12 text-center">Total en deudas: <strong>Q.<?php echo round($totales_pie - $abonos_pie, 2); ?></strong></div>
                <div class="col-lg-12 text-center"><span class="glyphicon glyphicon-user"></span> Usuario: <strong><?php echo utf8_encode($_COOKIE["nombre_usuario"]); ?></strong></div>
            </footer>
        <?php }
        ?>
    </body>
</html>