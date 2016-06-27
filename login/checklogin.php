<?php
session_start();
?>

<?php

// incluimos el archivo de configuracion
require '../config.php';
$tbl_name = "usuarios";

// Nos conectamos a la base de datos
 $conexion = new mysqli($servidor, $usuario, $pass, $bd);

if ($conexion->connect_error) {
 die("La conexion falló: " . $conexion->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];
 
$sql = "SELECT * FROM $tbl_name WHERE nombre_usuario = '$username'";

$result = $conexion->query($sql);


if ($result->num_rows > 0) {     
 
 $row = $result->fetch_array(MYSQLI_ASSOC);
 }
 $hash = $row['password'];
 
 if (password_verify($password, $hash)) { 
 
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username;
    $_SESSION['start'] = time();
    $_SESSION['expire'] = $_SESSION['start'] + (5 * 60);

    echo "Bienvenido! " . $_SESSION['username'];
    echo "<br><br><a href=panel_control.php>Panel de Control</a>"; 

 } else { 
   echo "Username o Password estan incorrectos.";


   echo "<br><a href='login.html'>Volver a Intentarlo</a>";
 }
 mysqli_close($conexion); 
 ?>
