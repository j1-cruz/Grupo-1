<?php include("../template/cabecera.php"); ?>

<?php
    $url="http://".$_SERVER["HTTP_HOST"]."/instituto_87";
    $txtTipo=(isset($_POST["txtTipo"]))?$_POST["txtTipo"]:"";
    $txtDocumento=(isset($_POST["txtDocumento"]))?$_POST["txtDocumento"]:"";
    $txtNombre=(isset($_POST["txtNombre"]))?$_POST["txtNombre"]:"";
    $txtApellido=(isset($_POST["txtApellido"]))?$_POST["txtApellido"]:"";
    $txtSexo=(isset($_POST["txtSexo"]))?$_POST["txtSexo"]:"";   
    $dateFecha_nacimiento=(isset($_POST["dateFecha_nacimiento"]))?$_POST["dateFecha_nacimiento"]:"";
    $txtLugarNacimiento=(isset($_POST["txtLugarNacimiento"]))?$_POST["txtLugarNacimiento"]:"";   
    $txtNacionalidad=(isset($_POST["txtNacionalidad"]))?$_POST["txtNacionalidad"]:"";
    $txtProvincia=(isset($_POST["txtProvincia"]))?$_POST["txtProvincia"]:"";   
    $txtLocalidad=(isset($_POST["txtLocalidad"]))?$_POST["txtLocalidad"]:"";   
    $txtCodigo_postal=(isset($_POST["txtCodigo_postal"]))?$_POST["txtCodigo_postal"]:"";   
    $txtDomicilio=(isset($_POST["txtDomicilio"]))?$_POST["txtDomicilio"]:"";   
    $txtNumero_domicilio=(isset($_POST["txtNumero_domicilio"]))?$_POST["txtNumero_domicilio"]:"";   
    $txtPiso=(isset($_POST["txtPiso"]))?$_POST["txtPiso"]:"";   
    $txtDepartamento=(isset($_POST["txtDepartamento"]))?$_POST["txtDepartamento"]:"";   
    $txtTelefono=(isset($_POST["txtTelefono"]))?$_POST["txtTelefono"]:"";   
    $txtContacto_emergencia=(isset($_POST["txtContacto_emergencia"]))?$_POST["txtContacto_emergencia"]:"";   
    $txtEmail=(isset($_POST["txtEmail"]))?$_POST["txtEmail"]:"";   
    $txtTitulo_secundario=(isset($_POST["txtTitulo_secundario"]))?$_POST["txtTitulo_secundario"]:"";   

    
    $accion=(isset($_POST["accion"]))?$_POST["accion"]:"";

    echo($txtLugarNacimiento);

    include("../../config/conexionBD.php");

    switch ($accion) {
        case "Agregar":
            if (($txtDocumento=="") || ($txtTipo=="")  || ($txtNombre=="") || ($txtApellido=="") || ($txtSexo=="") || ($dateFecha_nacimiento=="") || 
            ($txtNacionalidad=="") || ($txtProvincia=="") || ($txtLocalidad=="") || ($txtCodigo_postal=="") || ($txtDomicilio=="")|| ($txtNumero_domicilio=="") || 
            ($txtTelefono=="") || ($txtContacto_emergencia=="") || ($txtEmail=="") || ($txtTitulo_secundario=="")) {
                
                echo '
                <script type="text/javascript">
                    $(document).ready(function(){
                        swal({
                            position: "center",
                            type: "error",
                            title: " Faltan Datos OBLIGATÓRIOS ",
                            showConfirmButton: false,
                            timer: 1500
                        })
                    });
                </script>
                ';
        
                $modal=false;
            }      
            else {
                $sentenciaSQL=$conexion->prepare("INSERT INTO alumnos (documento, tipo_documento, apellido, nombre, sexo, fecha_nacimiento, lugar_nacimiento, nacionalidad, provincia, localidad, codigo_postal, domicilio, numero_domicilio, piso, departamento, telefono, contacto_emergencia, email, titulo_secundario) VALUES (:documento, :tipo, :apellido, :nombre, :sexo, :fecha_nacimiento, :lugar_nacimiento, :nacionalidad, :provincia, :localidad, :codigo_postal, :domicilio, :numero_domicilio, :piso, :departamento, :telefono, :contacto_emergencia, :email, :titulo_secundario);");
                $sentenciaSQL->bindParam(':documento', $txtDocumento);
                $sentenciaSQL->bindParam(':tipo', $txtTipo);
                $sentenciaSQL->bindParam(':nombre', $txtNombre);
                $sentenciaSQL->bindParam(':apellido', $txtApellido);
                $sentenciaSQL->bindParam(':sexo', $txtSexo);
                $sentenciaSQL->bindParam(':fecha_nacimiento', $dateFecha_nacimiento);
                $sentenciaSQL->bindParam(':lugar_nacimiento', $txtLugarNacimiento);
                $sentenciaSQL->bindParam(':nacionalidad', $txtNacionalidad);
                $sentenciaSQL->bindParam(':provincia', $txtProvincia);
                $sentenciaSQL->bindParam(':localidad', $txtLocalidad);
                $sentenciaSQL->bindParam(':codigo_postal', $txtCodigo_postal);
                $sentenciaSQL->bindParam(':domicilio', $txtDomicilio);
                $sentenciaSQL->bindParam(':numero_domicilio', $txtNumero_domicilio);
                $sentenciaSQL->bindParam(':piso', $txtPiso);
                $sentenciaSQL->bindParam(':departamento', $txtDepartamento);
                $sentenciaSQL->bindParam(':telefono', $txtTelefono);
                $sentenciaSQL->bindParam(':contacto_emergencia', $txtContacto_emergencia);
                $sentenciaSQL->bindParam(':email', $txtEmail);
                $sentenciaSQL->bindParam(':titulo_secundario', $txtTitulo_secundario);

                
                $sentenciaSQL->execute();

                $modal=true;
            }    
            if ($modal==true){

                $_SESSION['varDocumento'] = $txtDocumento;
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
    }
?>

<div class="card">
    <div class="card-header">
        Datos del alumno
    </div>
    <div class="card-body">
        <div class="row" justif-content-center>
            <div class="col-md-12">
                <form method="POST">
                    <div class = "form-group row ">                    
                        <div class="col-md-3">
                            <label for="txtTipo">Tipo documento<span class="text-danger">*</span></label>
                            <select class="form-control" name="txtTipo" id="txtTipo">                            
                                <option>DNI</option>
                                <option>DU</option>
                                <option>LC</option>
                                <option>LE</option>
                            </select>   
                        </div>                       
                        <div class="col-md-3">
                            <label for="txtDocumento">Documento<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="txtDocumento" id="txtDocumento" placeholder="Número de documento">
                        </div>                   
                        <div class="col-md-3">
                            <label for="txtApellido">Apellido<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="txtApellido" id="txtApellido" placeholder="Apellido del alumno">
                        </div>                  
                        <div class="col-md-3">
                            <label for="txtNombre">Nombre<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="txtNombre" id="txtNombre" placeholder="Nombre del alumno">
                        </div> 
                    </div>
                    <div class="form-group row ">                   
                        <div class="col-md-3">
                            <label for="txtNacionalidad">Nacionalidad<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="txtNacionalidad" id="txtNacionalidad" placeholder="Nacionalidad">
                        </div>                   
                        <div class="col-md-3">
                            <label for="txtProvincia">Provincia<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="txtProvincia" id="txtProvincia" placeholder="Provincia">
                        </div>                   
                        <div class="col-md-3">
                            <label for="txtLocalidad">Localidad<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="txtLocalidad" id="txtLocalidad" placeholder="Localidad">
                        </div>                   
                        <div class="col-md-3">
                            <label for="txtCodigo_postal">Codigo postal<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="txtCodigo_postal" id="txtCodigo_postal" placeholder="Codigo postal">
                        </div>
                    </div>              
                    <div class="form-group row ">                    
                        <div class="col-md-3">
                            <label for="txtDomicilio">Domicilio del alumno<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="txtDomicilio" id="txtDomicilio" placeholder="Domicilio del alumno">
                        </div>                
                        <div class="col-md-3">
                            <label for="txtNumero_domicilio">Numero de Domicilio<span class="text-danger">*</span></label>                    
                            <input type="text" class="form-control" name="txtNumero_domicilio" id="txtNumero_domicilio" placeholder="Numero de Domicilio del alumno">
                        </div>                   
                        <div class="col-md-3">
                            <label for="txtPiso">Piso</label>
                            <input type="text" class="form-control" name="txtPiso" id="txtPiso" placeholder="Piso">
                        </div>                   
                        <div class="col-md-3">
                            <label for="txtDepartamento">Departamento</label>
                            <input type="text" class="form-control" name="txtDepartamento" id="txtDepartamento" placeholder="Departamento">
                        </div> 
                    </div>               
                    <div class="form-group row mx-auto ">                    
                        <div class="col-md-4">
                            <label for="txtSexo">Sexo<span class="text-danger">*</span></label>
                            <div class="col-md-4">
                                <input type="radio" class="form-check-input" name="txtSexo" id="txtSexo" value="M"> Masculino<br>
                                <input type="radio" class="form-check-input" name="txtSexo" id="txtSexo" value="F"> Femenino<br>
                                <input type="radio" class="form-check-input" name="txtSexo" id="txtSexo" value="O"> Otro<br>
                            </div>
                        </div>               
                        <div class="col-md-4">
                            <label for="dateFecha_nacimiento">Fecha de nacimiento<span class="text-danger">*</span></label>
                                <div class="col-md-4">
                                <input type="date" class="" name="dateFecha_nacimiento" id="dateFecha_nacimiento" placeholder="Fecha de nacimiento">
                            </div>
                        </div>               
                        <div class="col-md-4">
                            <label for="txtTitulo_secundario">Titulo secundario<span class="text-danger">*</span></label>
                            <div class="col-md-4">
                                <input type="radio" class="form-check-input" name="txtTitulo_secundario" id="txtTitulo_secundario" value="1"> Si<br>
                                <input type="radio" class="form-check-input" name="txtTitulo_secundario" id="txtTitulo_secundario" value="0"> No<br>
                            </div>
                        </div>
                    </div>                                
                    <div class="form-group row">                    
                        <div class="col-md-4">
                            <label for="txtTelefono">Telefono<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="txtTelefono" id="txtTelefono" placeholder="Telefono">
                        </div>                   
                        <div class="col-md-4">
                            <label for="txtContacto_emergencia">Telefono de emergencia</label>
                            <input type="text" class="form-control" name="txtContacto_emergencia" id="txtContacto_emergencia" placeholder="Telefono de emergencia">
                        </div>                   
                        <div class="col-md-4">
                            <label for="txtEmail">Email<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="txtEmail" id="txtEmail" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <h7><span class="text-danger bold">*</span>Datos obligatorios</h7>                        
                        <div class="col-md-12 pt-2">                             
                            <button type="button" class="btn btn-primary" onclick="location.href='../alumnos.php'">Volver</button>
                            <button type="submit" name="accion" value="Agregar" class="btn btn-primary float-right">Agregar Carrera</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo $url;?>/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo $url;?>/js/jquery-3.5.1.js"></script>
<script src="<?php echo $url;?>/js/jquery.dataTables.min.js"></script>
<script src="<?php echo $url;?>/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo $url;?>/js/popper.min.js"></script>



<div class="modal fade" id="verModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- cabecera del diálogo -->
            <div class="modal-header">
                <h4 class="modal-title">Carreras Disponibles</h4>
                <button type="button" class="close cerrarVerModal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <!-- cuerpo del diálogo -->
            <div class="modal-body">
                <table class="table table-striped table-bordered" style="width: 100%" id="tablaCarreras">
                    <thead>
                        <th>Codigo</th>
                        <th>Nombre de Carrera</th>
                        <th>Año de Inicio</th>
                    </thead>
                    <tbody>
                        <?php
                            $sentenciaSQL=$conexion->prepare("SELECT * FROM carreras");
                           
                            $sentenciaSQL->execute(); 
                            $filtroCarreras=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
                        ?>
                        <?php foreach($filtroCarreras as $filtro) { ?>
                        <tr>
                            <td><?php echo $filtro['codigo']; ?></td>
                            <td><?php echo $filtro['nombre']; ?></td>
                            <td><?php echo $filtro['anio_inicio']; ?></td>
                        </tr>
                        <?php } ?> 
                    </tbody>
                </table>
            </div>
            <!-- pie del diálogo -->
            <div class="modal-footer">
                <button type="submit" name="accion" value="inscripcionCarreras" id="inscripcionCarreras" class="btn btn-primary">Guardar Carreras</button>
                <button type="button" class="btn btn-primary cerrarVerModal">Cerrar</button>
            </div>
        </div>
    </div>
</div> 

<script>
    $(document).ready(function () {
        let tablaCarreras = $('#tablaCarreras').DataTable({
            "language": {
                "url": "<?php echo $url;?>/json/spanish.json"
            },
            "searching": false,
            "info": false,
            "pageLength": 8,
            "lengthChange": false,
            "pagingType": "simple",
        });
        
        let table = $('#tablaCarreras').DataTable();

        $('#tablaCarreras tbody').on( 'click', 'tr', function () {
            $(this).toggleClass('selected');
        } );

        $('#inscripcionCarreras').click( function () {
             let rowdata = table.rows('.selected').data();     
              for (let i = 0; i < rowdata.length; i++) {
                $.ajax({
                        type: "post",
                        url: "inscripcionCarreras.php",
                        data: {
                            
                            codigo: rowdata[i][0],
                            carrera: rowdata[i][1],
                            documento: "<?php echo $_SESSION['varDocumento']; ?>",   
                           
                        },
                    });
            }
        } );
        
    });
</script>
<script>
    $(".cerrarVerModal").click(function(){
    $("#verModal").modal("hide")
    });
</script>


<?php include("../template/pie.php"); ?>