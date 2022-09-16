<?php
    include("../../config/conexionBD.php");

    $txtCodigo = $_POST['codigo'];
    $txtCarrera = $_POST['carrera'];
    $txtDocumento = $_POST['documento'];
   
    $sentenciaSQL=$conexion->prepare("INSERT INTO alumno_carrera (codigo, carrera, documento) VALUES (:codigo, :carrera, :documento);");
    
    $sentenciaSQL->bindParam(':codigo', $txtCodigo);
    $sentenciaSQL->bindParam(':carrera', $txtCarrera);
    $sentenciaSQL->bindParam(':documento', $txtDocumento);
    $sentenciaSQL->execute();
?>