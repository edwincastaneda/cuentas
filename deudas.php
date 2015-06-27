<?php
if(isset($_POST['nuevo'])){
    $sql="INSERT INTO deudas VALUES ('','".utf8_decode($_POST['descripcion'])."',".$_POST['monto'].", ".$_COOKIE["id_usuario"].")";
    $DB->execute($sql);
    header('Location: index.php?menu=deudas');
}
if(isset($_POST['guardar'])){
    $sql="UPDATE deudas SET descripcion = '".utf8_decode($_POST['descripcion'])."', monto=".$_POST['monto']
            . " WHERE id =".$_POST['id'];
    $DB->execute($sql);
    header('Location: index.php?menu=deudas');
}
if(isset($_POST['eliminar'])){
    $sql="DELETE FROM deudas WHERE id=".$_POST['id'];
    $DB->execute($sql);
    header('Location: index.php?menu=deudas');
}
?>
<div class="panel panel-danger">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="glyphicon glyphicon-credit-card"></span>  Deudas</h3>
    </div>
    <div class="panel-body panel-body-form">
        <table class="table table-striped table-hover table-form">
            <thead>
                <tr>
                    <th class="col-md-1">#</th>
                    <th class="col-md-8">Descripci&oacute;n</th>
                    <th class="col-md-2">Monto (Q.)</th>
                    <th class="col-md-1 text-center">Acci&oacute;nes</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $deudas = $DB->fetchAll("SELECT * FROM deudas WHERE id_usuario=".$_COOKIE["id_usuario"]);
                if (isset($deudas)) {
                    foreach ($deudas as $row) {
                        ?>
                <form action="index.php?menu=deudas" method="post">
                        <tr>
                            <td>
                            <input type="text" class="form-control input-sm" name="id" readonly value="<?php echo $row['id'];?>"></td>
                            <td><input type="text" class="form-control input-sm" required name="descripcion" value="<?php echo utf8_encode($row['descripcion']);?>"></td>
                            <td><input type="text" class="form-control input-sm" required name="monto" value="<?php echo $row['monto'];?>" onkeypress="return isNumberKey(event)"></td>
                            <td>
                                <button type="submit" class="btn btn-success btn-sm col-md-6" name="guardar"><span class="glyphicon glyphicon-floppy-saved"></span></button>
                                <button type="submit" class="btn btn-danger btn-sm col-md-6" name="eliminar" onclick=" return window.confirm('Los datos no se recuperaran, esta seguro de continuar?');"><span class="glyphicon glyphicon-trash"></span></button>
                            </td>
                        </tr>
                </form>
                        <?php
                    }
                }
                ?>
            <form action="index.php?menu=deudas" method="post" onsubmit=" return window.confirm('Se agregara una nueva deuda, desea continuar?');">
                <tr class="active">
                    <td class="text-center"><em>(nuevo)</em></td>
                    <td><input type="text" class="form-control input-sm" required name="descripcion"></td>
                    <td><input type="text" class="form-control input-sm" required name="monto" onkeypress="return isNumberKey(event)"></td>
                    <td>
                        <button type="submit" class="btn btn-info btn-sm col-md-12" name="nuevo"><span class="glyphicon glyphicon-floppy-disk"></span></button>	  
                    </td>
                </tr>
            </form>
            </tbody>
        </table> 
    </div>
</div>