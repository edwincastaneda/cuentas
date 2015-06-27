<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <?php if (isset($_GET['menu'])) { ?>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            <?php } ?>
            <a class="navbar-brand" href="./">Gestor de Cuentas</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <?php if (isset($_GET['menu'])) { ?>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="?menu=deudas"><span class="glyphicon glyphicon-credit-card"></span> Deudas</a></li>
                    <li><a href="?menu=abonos"><span class="glyphicon glyphicon-piggy-bank"></span> Abonos</a></li>
                    <li><a href="?menu=consultas"><span class="glyphicon glyphicon-search"></span> Consultas</a></li>
                    <li><a href="#" onclick="if(confirm('Esta seguro que desea salir?')){window.location = 'logout.php'}return false;"><span class="glyphicon glyphicon-off"></span> Salir</a></li>
                </ul>
            <?php } ?>
        </div>
    </div>
</nav>