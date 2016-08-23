<?php

// $fecha_inicial = new DateTime($_POST['from']);
// $fecha_final = new DateTime($_POST['to']);
$fecha_i = $_POST['from'];
$fecha_f = $_POST['to'];
// Se extraen las fechas originales para que queden en el formato yyyy-mm-dd
$fecha_inicial = (substr($fecha_i, 6, 4)."-".substr($fecha_i, 3, 2)."-".substr($fecha_i, 0, 2));
$fecha_final = (substr($fecha_f, 6, 4)."-".substr($fecha_f, 3, 2)."-".substr($fecha_f, 0, 2));
if ($fecha_inicial != $fecha_final) {
    // se extraen las horas
    $hora_inicial = (substr($fecha_i, 10, 6));
    $hora_final = (substr($fecha_f, 10, 6));
    // Se convierten las fechas a objetos date
    $datetime1 = date_create($fecha_inicial);
    $datetime2 = date_create($fecha_final);
    //se encuentra la diferencia entre las fechas $datetime2 - $datetime1
    $interval = date_diff($datetime1, $datetime2);
    $contador = (int)$interval->format('%R%a');

    //esta es la suma
    /*$mas_uno = strtotime ('+ 1 day', strtotime($fecha_inicial));
    $un_dia = date('d/m/Y',$mas_uno);*/

    //$un_dia = date ('d/m/Y', strtotime ('+ 1 day', strtotime($fecha_inicial)));
    //echo "<br />-------------------";
    // Este es el ciclo
    $cnt=0;

    while ($cnt <= $contador) {
        $aumento="+ ".$cnt." day";//se aumentan los dias
        $mas_uno = strtotime($aumento, strtotime($fecha_inicial));// se le aumenta a la fechas los dias
        $un_dia = date('d/m/Y', $mas_uno);
        $final_1 = $un_dia.$hora_inicial;//se le agrega la hora a la fecha inicial
        $final_2 = $un_dia.$hora_final; //se le agrega la hora  ala fecha final


        // Aqui va la información

        $user_id = $_SESSION['id'];

        // Recibimos el fecha de inicio y la fecha final desde el form

        $inicio = _formatear($final_1);
        // y la formateamos con la funcion _formatear

        $final  = _formatear($final_2);

        // Recibimos el fecha de inicio y la fecha final desde el form

        $inicio_normal = $final_1;

        // y la formateamos con la funcion _formatear
        $final_normal  = $final_2;

        // Recibimos los demas datos desde el form
        $titulo = evaluar($_POST['title']);

        //Recibimos los datos del responsable
        $responsable_nombre = htmlentities(evaluar($_POST['responsable_nombre']));
        $responsable_apellido = htmlentities(evaluar($_POST['responsable_apellido']));

        // y con la funcion evaluar
        $body   = htmlentities(evaluar($_POST['event']));

        // reemplazamos los caracteres no permitidos
        $clase  = htmlentities(evaluar($_POST['class']));

        // insertamos el evento
        $query="INSERT INTO eventos VALUES(null, '$user_id', '$titulo', '$responsable_nombre' , '$responsable_apellido' , '$body','','$clase','$inicio','$final','$inicio_normal','$final_normal','','','','','',0,0,0,0,0,0,0,0,'','','','','',0,'',0,'')";

        // Ejecutamos nuestra sentencia sql
        $conexion->query($query);

        // Obtenemos el ultimo id insertado
        $im=$conexion->query("SELECT MAX(id) AS id FROM eventos");
        $row = $im->fetch_row();
        $id = trim($row[0]);

        // para generar el link del evento
        $link = "$base_url"."descripcion_evento.php?id=$id";

        //Guardamos el id del primer evento de la serie
        if ($cnt == 0) {
            $id_unico =$id;
        }

        // y actualizamos su link y el vento seriado
        $query="UPDATE eventos SET url = '$link', serie = '$id_unico' WHERE id = $id";

        // Ejecutamos nuestra sentencia sql
        $conexion->query($query);

        $cnt++; //se aumenta el contador en 1
    } // final del while
} else {
    $user_id = $_SESSION['id'];

      // Recibimos el fecha de inicio y la fecha final desde el form

      $inicio = _formatear($_POST['from']);
      // y la formateamos con la funcion _formatear

      $final  = _formatear($_POST['to']);

      // Recibimos el fecha de inicio y la fecha final desde el form

      $inicio_normal = $_POST['from'];

      // y la formateamos con la funcion _formatear
      $final_normal  = $_POST['to'];

      // Recibimos los demas datos desde el form
      $titulo = evaluar($_POST['title']);
      //Recibimos los datos del responsable
      $responsable_nombre = htmlentities(evaluar($_POST['responsable_nombre']));
    $responsable_apellido = htmlentities(evaluar($_POST['responsable_apellido']));

      // y con la funcion evaluar
      $body   = htmlentities(evaluar($_POST['event']));

      // reemplazamos los caracteres no permitidos
      $clase  = htmlentities(evaluar($_POST['class']));

      // insertamos el evento
      $query="INSERT INTO eventos VALUES(null, '$user_id', '$titulo', '$responsable_nombre' , '$responsable_apellido' , '$body','','$clase','$inicio','$final','$inicio_normal','$final_normal','','','','','',0,0,0,0,0,0,0,0,'','','','','',0,'',0,0)";

      // Ejecutamos nuestra sentencia sql
      $conexion->query($query);


      // Obtenemos el ultimo id insertado
      $im=$conexion->query("SELECT MAX(id) AS id FROM eventos");
    $row = $im->fetch_row();
    $id = trim($row[0]);

      // para generar el link del evento
      $link = "$base_url"."descripcion_evento.php?id=$id";

      // y actualizamos su link
      $query="UPDATE eventos SET url = '$link' WHERE id = $id";

      // Ejecutamos nuestra sentencia sql
      $conexion->query($query);
}// final del if
;
