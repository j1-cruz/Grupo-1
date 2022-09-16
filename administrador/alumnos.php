<?php include("template/cabecera.php"); ?>

<?php
    include("../config/conexionBD.php");
    $sentenciaSQL=$conexion->prepare("SELECT * FROM alumnos");
    $sentenciaSQL->execute(); 
    $listaAlumnos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION["varDocumento"] = (isset($_POST["fndDocumento"]))?$_POST["fndDocumento"]:"";
    $accion=(isset($_POST["accion"]))?$_POST["accion"]:"";

    switch ($accion) {
        case "Ver":
            echo '
            <script>
                window.onload = function () {
                    abrirModal();    
                };
                function abrirModal() {
                    $("#verModal").modal("show");
                }
            </script>
            ';
        break;
    }
?>

<div class="card-deck"> 
    <div class="card col-lg-12 mb-4">
        <div class="card-block">
            <h4 class="card-title">Menú de Alumnos</h4>
            <div class="card-body">
                <form method="post">
                    <div class="row">
                        <div class="col-10">
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
                                <button type="submit" class="btn btn-primary btn-block mt-3 mb-3" style="width: 100%" name="accion" value="Ver" id="Ver" disabled>Ver</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="verModal">
    <?php
    $sentenciaSQL=$conexion->prepare("SELECT * FROM alumnos WHERE documento=:documento");
    $sentenciaSQL->bindParam(':documento', $_SESSION["varDocumento"]);
    $sentenciaSQL->execute();
    $dato=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
    $txtTipo=$dato['tipo_documento'];
    $txtDocumento=$dato['documento'];
    $txtNombre=$dato['nombre'];
    $txtApellido=$dato['apellido'];
    $txtSexo=$dato['sexo'];
    $dateFecha_nacimiento=$dato['fecha_nacimiento'];
    $txtNacionalidad=$dato['nacionalidad'];
    $txtCodigo_postal=$dato['codigo_postal'];
    $txtLocalidad=$dato['localidad'];
    $txtProvincia=$dato['provincia'];
    $txtDomicilio=$dato['domicilio'];
    $txtNumero_domicilio=$dato['numero_domicilio'];
    $txtPiso=$dato['piso'];
    $txtDepartamento=$dato['departamento'];
    $txtTelefono=$dato['telefono'];
    $txtContacto_emergencia=$dato['contacto_emergencia'];
    $txtEmail=$dato['email'];
    $txtTitulo_secundario=$dato['titulo_secundario'];
    
    if ($txtSexo == "H"){
        $txtSexo = "Hombre";
    }elseif($txtSexo == "M"){
        $txtSexo = "Mujer";
    }else{
        $txtSexo = "Otro";
    }
    
    if ( $txtTitulo_secundario == "1"){
        $txtTitulo_secundario = "Si";
    }else{
        $txtTitulo_secundario = "No";
    }
    ?>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- cabecera del diálogo -->
            <div class="modal-header">
                <div class="card-header  text-center col-md-10">
                    <h3>Datos de <?php echo $txtApellido;echo" "; echo $txtNombre ?></h3> 
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- cuerpo del diálogo -->
            <div class="modal-body">
                
                <div class="card-body">
                    <div class="row" justif-content-center>
                        <div class="col-md-12">
                            <div class=" card-body ">
                                <p class="  text-capitalize text-center  text-sm-start "> <pre style="margin-bottom: 4px">
                                <b>Documento:</b> <?php echo $txtDocumento ?>    
                                <b>Tipo de Documento:</b> <?php echo $txtTipo ?>  
                                <b>Apellido:</b> <?php echo $txtApellido ?>  
                                <b>Nombre:</b> <?php echo $txtNombre ?>   
                                <b>Sexo:</b> <?php echo $txtSexo ?>    
                                <b>Fecha de Nacimiento:</b> <?php echo $dateFecha_nacimiento ?>  
                                <b>Nacionalidad:</b> <?php echo $txtNacionalidad ?>  
                                <b>Provincia:</b> <?php echo $txtProvincia ?>   
                                <b>Localidad:</b> <?php echo $txtLocalidad ?>  
                                <b>Código Postal</b>: <?php echo $txtCodigo_postal ?>  
                                <b>Domicilio:</b> <?php echo $txtDomicilio ?>  
                                <b>Número de Domicilio:</b> <?php echo $txtNumero_domicilio ?> 
                                <b>Piso:</b> <?php echo $txtPiso ?>  
                                <b>Departamento:</b> <?php echo $txtDepartamento ?>  
                                <b>Télefono:</b> <?php echo $txtTelefono ?>  
                                <b>Contacto De Emergencia:</b> <?php echo $txtContacto_emergencia ?>  
                                <b>Email:</b> <?php echo $txtEmail ?>  
                                <b>Título Secundario:</b> <?php echo  $txtTitulo_secundario ?> </pre></p>
                            
                            </div>
                            
                        </div>
                    </div>
                </div>
                
            </div>
            <!-- pie del diálogo -->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary cerrarVerModal">Cerrar</button>
            </div>
        </div>
    </div>
</div>       
        
<script src="<?php echo $url;?>/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo $url;?>/js/jquery-3.5.1.js"></script>
<script src="<?php echo $url;?>/js/jquery.dataTables.min.js"></script>
<script src="<?php echo $url;?>/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo $url;?>/js/popper.min.js"></script>

<script>
    $(document).ready(function () {
        var table = $('#tabla').DataTable({
            "language": {
                "url": "<?php echo $url;?>/json/spanish.json"
            },
            "pageLength": 8,
            "lengthChange": false,
            "pagingType": "full",   
        });
        $('#tabla tbody').on('click', 'tr', function () {
            var pikDocumento = table.row( this ).data()[0];       
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
                document.getElementById("fndDocumento").value = "";
                document.getElementById("Modificar").disabled = true;
                document.getElementById("Eliminar").disabled = true;
                document.getElementById("Ver").disabled = true;
            } else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
                document.getElementById("fndDocumento").value = pikDocumento;
                document.getElementById("Modificar").disabled = false;
                document.getElementById("Eliminar").disabled = false;
                document.getElementById("Ver").disabled = false;
            }
        });       
    });
</script>

<script>
    $(".cerrarVerModal").click(function(){
    $("#verModal").modal("hide")
    });
</script>

<?php include("template/pie.php"); ?>