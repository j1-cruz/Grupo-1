<?php include("../template/cabecera.php");?>

<?php 

    $sndDocumento=(isset($_POST["fndDocumento"]))?$_POST["fndDocumento"]:"";
    include("../../config/conexionBD.php");

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


<div class="card col-md-8 mx-auto">
    <div class="card-header text-center">
        <h3>Datos de <?php echo $txtApellido;echo" "; echo $txtNombre ?></h3> 
    </div>
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
                <br/>
                <button type="button" class="btn btn-primary" onclick="location.href='../alumnos.php'">Volver</button>
               
            </div>
        </div>
    </div>
</div>

