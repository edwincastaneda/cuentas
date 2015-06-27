<?php
$deudas = $DB->fetchAll("SELECT * FROM deudas WHERE id_usuario=".$_COOKIE["id_usuario"]);
if (isset($deudas) && !isset($_GET['id_deuda'])) {
    ?>
    <h2>Seleccione la deuda que desea consultar:</h2><br/>
    <?php
    foreach ($deudas as $row) {
        ?>
			<a href="index.php?menu=consultas&id_deuda=<?php echo $row['id']; ?>" class="a-deudas">
	<div class="panel panel-default">
      <div class="panel-body panel-deudas">
        <span class="glyphicon glyphicon-credit-card icono" aria-hidden="true"></span> <?php echo utf8_encode($row['descripcion']); ?>
      </div>
    </div>
	</a>
        <?php
    }
}
if (isset($_GET['id_deuda'])) {
    $total = $DB->fetchAll("SELECT SUM(valor)as total FROM abonos WHERE id_deudas=" . $_GET['id_deuda']);
    foreach ($total as $row) {
        $total_actual = $row['total'];
    }
    $deuda = $DB->fetchAll("SELECT monto, descripcion FROM deudas WHERE id=" . $_GET['id_deuda']);
    foreach ($deuda as $row) {
        $monto_total = $row['monto'];
        $nombre = utf8_encode($row['descripcion']);
    }
    ?>
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title"><span class="glyphicon glyphicon-search"></span> Consultas</h3>
        </div>
        <div class="panel-body">
            <?php
            $barra = ($total_actual / $monto_total) * 100;
            ?>
            <h3 class="titulo">Deuda: <strong><?php echo $nombre; ?></strong></h3>
            <h3 class="titulo">Total de Deuda: <strong>Q.<?php echo $monto_total; ?></strong></h3>
            <h3 class="titulo">Abonado: <strong>Q.<?php echo  $total_actual; ?></strong></h3>
			<h3 class="titulo">Debo: <strong>Q.<?php echo  $monto_total-$total_actual; ?></strong></h3>
            <div class="progress progress-striped active">
                <div class="progress-bar progress-bar-success" style="width: <?php echo $barra; ?>%"></div>
            </div>
        </div>
    </div>
<?php } ?>