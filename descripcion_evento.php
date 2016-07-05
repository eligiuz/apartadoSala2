<?php

/**
**
**  BY iCODEART
**
**********************************************************************
**                      REDES SOCIALES                            ****
**********************************************************************
**                                                                ****
** FACEBOOK: https://www.facebook.com/icodeart                    ****
** TWIITER: https://twitter.com/icodeart                          ****
** YOUTUBE: https://www.youtube.com/c/icodeartdeveloper           ****
** GITHUB: https://github.com/icodeart                            ****
** TELEGRAM: https://telegram.me/icodeart                         ****
** EMAIL: info@icodeart.com                                       ****
**                                                                ****
**********************************************************************
**********************************************************************
**/
    
    //incluimos nuestro archivo config
    include 'config.php'; 

    // Incluimos nuestro archivo de funciones
    include 'funciones.php';

    // Obtenemos el id del evento
    $id  = evaluar($_GET['id']);

    // y lo buscamos en la base de dato
    $bd  = $conexion->query("SELECT * FROM eventos WHERE id=$id");

    // Obtenemos los datos
    $row = $bd->fetch_assoc();

    // titulo 
    $titulo=$row['title'];
	
	// responsable
	$responsable=$row['responsable'];

    // cuerpo
    $evento=$row['body'];

    // Fecha inicio
    $inicio=$row['inicio_normal'];

    // Fecha Termino
    $final=$row['final_normal'];
    
    // Clase de evento
    switch ($row['class']) {
        case "event-videoconferencia":
            $clase_evento = "Videconferencia";
            break;
        case "event-conferencia":
            $clase_evento = "Conferencia";
            break;
        case "event-convenio":
            $clase_evento = "Convenio";
            break;
        case "event-reunion":
            $clase_evento = "Reunión";
            break;
        case "event-pelicula":
            $clase_evento = "Pelicula";
            break;
        case "event-capacitacion":
            $clase_evento = "Capacitación";
            break;
        case "event-presentacionLibro":
            $clase_evento = "Presentación de Libro";
            break;
        case "event-mesaLectura":
            $clase_evento = "Mesa de Lectura";
            break;
        case "event-otro":
            $clase_evento = "Otro";
            break;
        
    }
   
// Eliminar evento
if (isset($_POST['eliminar_evento'])) 
{
    $id  = evaluar($_GET['id']);
    $sql = "DELETE FROM eventos WHERE id = $id";
    if ($conexion->query($sql)) 
    {
        echo "Evento eliminado";
    }
    else
    {
        echo "El evento no se pudo eliminar";
    }
}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?=$titulo?></title>
</head>
<body>
	 <h3><?=$titulo?></h3>
	 <hr>
     <p><b>Responsable del evento: </b><?=$responsable?></p>
     <p><b>Tipo de evento: </b><?=$clase_evento?></p>
     <b>Fecha inicio:</b> <?=$inicio?>
     <b>Fecha termino:</b> <?=$final?>
 	<p><?=$evento?></p>
</body>
<form action="" method="post">
    <button type="submit" class="btn btn-danger" name="eliminar_evento">Eliminar</button>
</form>
</html>
