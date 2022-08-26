<?php include("template/cabecera.php"); ?>

<?php
    include("../config/conexionBD.php");
    $sentenciaSQL=$conexion->prepare("SELECT * FROM alumnos");
    $sentenciaSQL->execute(); 
    $listaAlumnos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
    $fndResolucion=(isset($_POST["fndDocumento"]))?$_POST["fndDocumento"]:"";
    $accion=(isset($_POST["accion"]))?$_POST["accion"]:"";  
?>

<h3 class="text-center">Alumnos</h3>
<!-- <form action="alumnos/modificar.php" method="POST"> -->
<form class="card-deck" action="alumnos/modificar.php" method="POST">
    <div class="row card">
        <div class="col-10">
        <h5 class="mt-2">Listado de alumnos</h5>
            <table class="table table-striped table-bordered" style="width: 100%" id="tabla">
                <thead>
                    <th>Documento</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                </thead>
                <tbody>
                    <?php foreach($listaAlumnos as $alumno) { ?>
                    <tr>    
                        <td><?php echo $alumno['documento']; ?></td>
                        <td><?php echo $alumno['nombre']; ?></td>
                        <td><?php echo $alumno['apellido']; ?></td>
                    </tr>
                    <?php } ?>     
                </tbody>
            </table>
        </div>
        <div class="col-2">
            <div class="form-group">
                <label for="fndDocumento"></label>
                <input type="text" class="form-control" name="fndDocumento" id="fndDocumento" hidden>
            </div>
            <div class="btn-toolbar">
                <button type="button" class="btn btn-primary btn-block mt-3 mb-3" style="width: 100%" onclick="location.href='alumnos/agregarAlumno.php'">Agregar</button> 
                <button type="submit" class="btn btn-primary btn-block mt-3 mb-3" style="width: 100%" name="accion" value="Modificar" id="Modificar" formaction="alumnos/modificarAlumno.php" disabled>Modificar</button>
                <button type="submit" class="btn btn-primary btn-block mt-3 mb-3" style="width: 100%" name="accion" value="Eliminar" id="Eliminar" formaction="alumnos/eliminarAlumno.php" disabled>Eliminar</button>
            </div>
        </div>
    </div>

</form>

<script src="<?php echo $url;?>/js/jquery-3.5.1.js"></script>
<script src="<?php echo $url;?>/js/jquery.dataTables.min.js"></script>
<script src="<?php echo $url;?>/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo $url;?>/js/popper.min.js"></script>

<script>
    $(document).ready(function () {
        var table = $('#tabla').DataTable({
            "language": {
                "url": "<?php echo $url;?>/json/spanish.json"
            }   
        });
        $('#tabla tbody').on('click', 'tr', function () {
            var pikDocumento = table.row( this ).data()[0];       
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
                document.getElementById("fndDocumento").value = "";
                document.getElementById("Modificar").disabled = true;
                document.getElementById("Eliminar").disabled = true;
            } else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
                document.getElementById("fndDocumento").value = pikDocumento;
                document.getElementById("Modificar").disabled = false;
                document.getElementById("Eliminar").disabled = false;
            }
        });
        $('#button').click(function () {
            table.row('.selected').remove().draw(false);
            console.log( table.row( this ).data() );
        });       
    });
</script>


<?php include("template/pie.php"); ?>