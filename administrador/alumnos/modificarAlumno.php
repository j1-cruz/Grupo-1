<?php include("../template/cabecera.php"); ?>

<?php
    $sndDocumento=(isset($_POST["fndDocumento"]))?$_POST["fndDocumento"]:"";
    $txtTipo=(isset($_POST["txtTipo"]))?$_POST["txtTipo"]:"";
    $txtDocumento=(isset($_POST["txtDocumento"]))?$_POST["txtDocumento"]:"";
    $txtNombre=(isset($_POST["txtNombre"]))?$_POST["txtNombre"]:"";
    $txtApellido=(isset($_POST["txtApellido"]))?$_POST["txtApellido"]:"";
    $txtSexo=(isset($_POST["txtSexo"]))?$_POST["txtSexo"]:"";   
    $dateFecha_nacimiento=(isset($_POST["dateFecha_nacimiento"]))?$_POST["dateFecha_nacimiento"]:"";
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

    include("../../config/conexionBD.php");

    switch ($accion) {
        case "Modificar":
            $sentenciaSQL=$conexion->prepare("SELECT * FROM alumnos WHERE documento=:documento");
            $sentenciaSQL->bindParam(':documento', $sndDocumento);
            $sentenciaSQL->execute();
            $dato=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
            $bdDocumento=(isset($dato["documento"]))?$dato["documento"]:"";
            if ($_POST["fndDocumento"]==$bdDocumento) {
                $_SESSION['varTemp'] = $sndDocumento;                
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

            }
            break;
        case "Guardar":
            if (($txtDocumento=="") || ($txtTipo=="") || ($txtNombre=="") || ($txtApellido=="") || ($txtSexo=="") || ($dateFecha_nacimiento=="") || ($txtNacionalidad=="") || ($txtCodigo_postal=="") || ($txtLocalidad=="") || ($txtProvincia=="") || ($txtDomicilio=="") || ($txtNumero_domicilio=="") || ($txtTelefono=="") || ($txtEmail=="") || ($txtTitulo_secundario=="")) {
                echo '
                <script type="text/javascript">
                    $(document).ready(function(){
                        swal({
                            position: "center",
                            type: "error",
                            title: "Faltan datos...",
                            showConfirmButton: false,
                            timer: 1500
                        })
                    });
                </script>
                ';
            }    
            else {
                $valido = true;
                $sentenciaSQL=$conexion->prepare("SELECT * FROM alumnos");
                $sentenciaSQL->execute(); 
                $listaAlumnos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
                foreach($listaAlumnos as $alumno) {
                    if (($alumno['documento']==$txtDocumento) && ($txtDocumento!= $_SESSION['varTemp'])) {
                        $valido = false;
                        echo '
                        <script type="text/javascript">
                            $(document).ready(function(){
                                swal({
                                    position: "center",
                                    type: "error",
                                    title: "Este alumno ya existe...",
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            });
                        </script>
                        ';
                        break;
                    }
                }
                if ($valido) {
                    $sentenciaSQL=$conexion->prepare("UPDATE alumnos SET documento=:documento, tipo_documento=:tipo_documento, apellido=:apellido, nombre=:nombre, sexo=:sexo, fecha_nacimiento=:fecha_nacimiento, nacionalidad=:nacionalidad, provincia=:provincia, localidad=:localidad, codigo_postal=:codigo_postal, domicilio=:domicilio, numero_domicilio=:numero_domicilio, piso=:piso, departamento=:departamento, telefono=:telefono, contacto_emergencia=:contacto_emergencia, email=:email, titulo_secundario=:titulo_secundario WHERE documento=:oldDocumento");
                    $sentenciaSQL->bindParam(':documento', $txtDocumento);
                    $sentenciaSQL->bindParam(':tipo_documento', $txtTipo);
                    $sentenciaSQL->bindParam(':nombre', $txtNombre);
                    $sentenciaSQL->bindParam(':apellido', $txtApellido);
                    $sentenciaSQL->bindParam(':sexo', $txtSexo);
                    $sentenciaSQL->bindParam(':fecha_nacimiento', $dateFecha_nacimiento);
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
                    $sentenciaSQL->bindParam(':oldDocumento', $_SESSION['varTemp']);
                    $sentenciaSQL->execute();
                    echo '
                    <script type="text/javascript">
                        $(document).ready(function(){
                            swal({
                                position: "center",
                                type: "success",
                                title: "Los datos fueron guardados",
                                showConfirmButton: false,
                                timer: 1500
                            })
                        });
                        setTimeout( function() { window.location.href = "../alumnos.php"; }, 1500 );
                    </script>
                    ';
                }    
            }
            break;
    }
?>

<div class="card">
    <div class="card-header">
        Datos del alumno a Modificar
    </div>
    <div class="card-body">
        <div class="row" justif-content-center>
            <div class="col-md-12">
                <input type="text" class="form-control" name="sndDocumento" value="<?php echo $sndDocumento; ?>" id="sndDocumento" hidden>
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
                            <input type="text" class="form-control" name="txtDocumento" value="<?php echo $txtDocumento; ?>"id="txtDocumento" >
                        </div>                   
                        <div class="col-md-3">
                            <label for="txtApellido">Apellido<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="txtApellido" value="<?php echo $txtApellido; ?>" id="txtApellido">
                        </div>                  
                        <div class="col-md-3">
                            <label for="txtNombre">Nombre<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="txtNombre" value="<?php echo $txtNombre; ?>" id="txtNombre">
                        </div> 
                    </div>
                    <div class="form-group row ">                   
                        <div class="col-md-3">
                            <label for="txtNacionalidad">Nacionalidad<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="txtNacionalidad" value="<?php echo $txtNacionalidad; ?>" id="txtNacionalidad">
                        </div>                   
                        <div class="col-md-3">
                            <label for="txtProvincia">Provincia<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="txtProvincia" value="<?php echo $txtProvincia; ?>" id="txtProvincia">
                        </div>                   
                        <div class="col-md-3">
                            <label for="txtLocalidad">Localidad<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="txtLocalidad" value="<?php echo $txtLocalidad; ?>" id="txtLocalidad">
                        </div>                   
                        <div class="col-md-3">
                            <label for="txtCodigo_postal">Codigo postal<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="txtCodigo_postal" value="<?php echo $txtCodigo_postal; ?>" id="txtCodigo_postal">
                        </div>
                    </div>              
                    <div class="form-group row ">                    
                        <div class="col-md-3">
                            <label for="txtDomicilio">Domicilio del alumno<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="txtDomicilio" value="<?php echo $txtDomicilio; ?>" id="txtDomicilio">
                        </div>                
                        <div class="col-md-3">
                            <label for="txtNumero_domicilio">Numero de Domicilio<span class="text-danger">*</span></label>                    
                            <input type="text" class="form-control" name="txtNumero_domicilio" value="<?php echo $txtNumero_domicilio; ?>" id="txtNumero_domicilio">
                        </div>                   
                        <div class="col-md-3">
                            <label for="txtPiso">Piso</label>
                            <input type="text" class="form-control" name="txtPiso" value="<?php echo $txtPiso; ?>" id="txtPiso">
                        </div>                   
                        <div class="col-md-3">
                            <label for="txtDepartamento">Departamento</label>
                            <input type="text" class="form-control" name="txtDepartamento" value="<?php echo $txtDepartamento; ?>" id="txtDepartamento">
                        </div> 
                    </div>               
                    <div class="form-group row mx-auto ">                    
                        <div class="col-md-4">
                            <label for="txtSexo">Sexo<span class="text-danger">*</span></label>
                            <div class="col-md-4">
                                <input type="radio" class="form-check-input" name="txtSexo" id="txtSexo" value="M" <?php echo $txtSexo=='M'?'checked':'';?>> Masculino<br>
                                <input type="radio" class="form-check-input" name="txtSexo" id="txtSexo" value="F" <?php echo $txtSexo=='F'?'checked':'';?>> Femenino<br>
                                <input type="radio" class="form-check-input" name="txtSexo" id="txtSexo" value="O" <?php echo $txtSexo=='O'?'checked':'';?>> Otro<br>
                            </div>
                        </div>               
                        <div class="col-md-4">
                            <label for="dateFecha_nacimiento">Fecha de nacimiento<span class="text-danger">*</span></label>
                                <div class="col-md-4">
                                <input type="date" class="" name="dateFecha_nacimiento" value="<?php echo $dateFecha_nacimiento; ?>" id="dateFecha_nacimiento">
                            </div>
                        </div>               
                        <div class="col-md-4">
                            <label for="txtTitulo_secundario">Titulo secundario<span class="text-danger">*</span></label>
                            <div class="col-md-4">
                                <input type="radio" class="form-check-input" name="txtTitulo_secundario" id="txtTitulo_secundario" value="1" <?php echo $txtTitulo_secundario=='1'?'checked':'';?>> Si<br>
                                <input type="radio" class="form-check-input" name="txtTitulo_secundario" id="txtTitulo_secundario" value="0" <?php echo $txtTitulo_secundario=='1'?'checked':'';?>> No<br>
                            </div>
                        </div>
                    </div>                                
                    <div class="form-group row">                    
                        <div class="col-md-4">
                            <label for="txtTelefono">Telefono<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="txtTelefono" value="<?php echo $txtTelefono; ?>" id="txtTelefono">
                        </div>                   
                        <div class="col-md-4">
                            <label for="txtContacto_emergencia">Telefono de emergencia</label>
                            <input type="text" class="form-control" name="txtContacto_emergencia" value="<?php echo $txtContacto_emergencia; ?>" id="txtContacto_emergencia">
                        </div>                   
                        <div class="col-md-4">
                            <label for="txtEmail">Email<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="txtEmail" value="<?php echo $txtEmail; ?>" id="txtEmail">
                        </div>
                    </div>
                    <div class="form-group row">
                        <h7><span class="text-danger bold">*</span>Datos obligatorios</h7>                        
                        <div class="col-md-12 pt-2">                             
                            <button type="button" class="btn btn-primary" onclick="location.href='../alumnos.php'">Volver</button>
                            <button type="submit" name="accion" value="Guardar" class="btn btn-primary float-right">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include("../template/pie.php"); ?>