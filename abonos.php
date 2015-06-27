<?php if (isset($_POST['nuevo'])) {
    $sql = "INSERT INTO abonos VALUES (''," . $_GET['id_deuda'] . ",'" . $_POST['fecha'] . "'," . $_POST['valor'] . ",'" . utf8_decode($_POST['forma_pago']) . "','" . $_POST['no_documento'] . "')";
    $DB->execute($sql);
    header('Location: index.php?menu=abonos&id_deuda='.$_GET['id_deuda']);
}
if (isset($_POST['guardar'])) {
    $sql = "UPDATE abonos SET fecha = '" . $_POST['fecha'] . "', valor=" . $_POST['valor']. ", forma_pago='" . utf8_decode($_POST['forma_pago']). "', no_documento='" . $_POST['no_documento']."'"
            . " WHERE id =" . $_POST['id'];
    $DB->execute($sql);
     header('Location: index.php?menu=abonos&id_deuda='.$_GET['id_deuda']);
}
if (isset($_POST['eliminar'])) {
    $sql = "DELETE FROM abonos WHERE id=" . $_POST['id'];
    $DB->execute($sql);
     header('Location: index.php?menu=abonos&id_deuda='.$_GET['id_deuda']);
}
$deudas = $DB->fetchAll("SELECT * FROM deudas WHERE id_usuario=".$_COOKIE["id_usuario"]);
if (isset($deudas) && !isset($_GET['id_deuda'])) {
    ?>
    <h2>Seleccione la deuda a la que desea abonar:</h2><br/>
    <?php
    foreach ($deudas as $row) {
        ?>
	<a href="index.php?menu=abonos&id_deuda=<?php echo $row['id']; ?>" class="a-deudas">
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
    $deuda = $DB->fetchAll("SELECT descripcion FROM deudas WHERE id=" . $_GET['id_deuda']);
    foreach ($deuda as $row) {
        $descripcion = $row['descripcion'];
    }
    ?>
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title"><span class="glyphicon glyphicon-piggy-bank"></span> Abonos (Deuda Seleccionada: <strong><?php echo utf8_encode($descripcion);?>)</strong></h3>
        </div>
        <div class="panel-body panel-body-form">
            <table class="table table-striped table-hover table-form">
                <thead>
                    <tr>
                        <th class="col-md-1">#</th>
                        <th class="col-md-2">Fecha</th>
                        <th class="col-md-2">Valor (Q.)</th>
                        <th class="col-md-3">Forma de Pago</th>
                        <th class="col-md-3">No. Documento</th>
                        <th class="col-md-1 text-center">Acci&oacute;nes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $abonos = $DB->fetchAll("SELECT * FROM abonos WHERE id_deudas=" . $_GET['id_deuda']);
                    if (isset($abonos)) {
                        foreach ($abonos as $row) {?>
                        <form action="index.php?menu=abonos&id_deuda=<?php echo $_GET['id_deuda']; ?>" method="post">
                            <tr>
                                <td>
                                    <input type="text" class="form-control input-sm" name="id" readonly value="<?php echo $row['id']; ?>"></td>
                                <td><input type="text" class="form-control input-sm datepicker" name="fecha" required value="<?php echo $row['fecha']; ?>"></td>
                                <td><input type="text" class="form-control input-sm" name="valor" required value="<?php echo $row['valor']; ?>" onkeypress="return isNumberKey(event)"></td>
                                <td>
                                    <select class="form-control input-sm" required name="forma_pago">
                                        <option value="Cheque" <?php
                                        if ($row['forma_pago'] == "Cheque") {
                                            echo "selected";
                                        }
                                        ?>>Cheque</option>
                                       
                                        <option value="Dep&oacute;sito" <?php
                                        if (utf8_encode($row['forma_pago']) == "Depósito") {
                                            echo "selected";
                                        }
                                        ?>>Dep&oacute;sito</option>
                                        
                                        <option value="Efectivo" <?php
                                        if ($row['forma_pago'] == "Efectivo") {
                                            echo "selected";
                                        }
                                        ?>>Efectivo</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control input-sm" name="no_documento" value="<?php echo $row['no_documento']; ?>"></td>

                                <td>
                                    <button type="submit" class="btn btn-success btn-sm col-md-6" name="guardar" ><span class="glyphicon glyphicon-floppy-saved"></span></button>
                                    <button type="submit" class="btn btn-danger btn-sm col-md-6" name="eliminar" onclick=" return window.confirm('Los datos no se recuperaran, esta seguro de continuar?');"><span class="glyphicon glyphicon-trash"></span></button>
                                </td>
                            </tr>
                        </form>
                        <?php
                    }
                }
                ?>
                <form action="index.php?menu=abonos&id_deuda=<?php echo $_GET['id_deuda']; ?>" method="post" onsubmit=" return window.confirm('Se agregara un nuevo abono a la deuda, desea continuar?');">
                    <tr class="active">
                        <td class="text-center"><em>(nuevo)</em></td>
                        <td>
                            <input type="text" class="form-control input-sm datepicker" required name="fecha">
                         </td>
                        <td><input type="text" class="form-control input-sm" required name="valor" onkeypress="return isNumberKey(event)"></td>
                        <td>
                            <select class="form-control input-sm" required name="forma_pago">
                                <option value="Cheque">Cheque</option>
                                <option value="Dep&oacute;sito">Dep&oacute;sito</option>
                                <option value="Efectivo">Efectivo</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control input-sm" name="no_documento"></td>
                        <td>
                            <button type="submit" class="btn btn-info btn-sm col-md-12" name="nuevo"><span class="glyphicon glyphicon-floppy-disk"></span></button>	  
                        </td>
                    </tr>
                </form>
                </tbody>
            </table>
        </div>
    </div>
<?php } ?>