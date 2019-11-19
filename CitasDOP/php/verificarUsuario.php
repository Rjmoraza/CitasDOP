<?php
	$usuario = $_GET['usuario'];
    $contrasenia = $_GET['contrasenia'];

    include("database.php");
    $sql = "SELECT * FROM `Persona`";
    $result = mysqli_query($conn, $sql);
		$mensaje = "";

		// Si el sistema no tiene usuarios registrados, reciba cualquier solicitud de autenticación como un usuario tipo Psicologa
		if($result->num_rows === 0)
		{
			$mensaje = "Admin";
			session_start();
			$_SESSION["usuarioActivo"] = "-1";
		}
		else {
	    $id = 0;
	    while($row = mysqli_fetch_assoc($result)) {
	    	if($row["usuario"] == $usuario and $row["contrasenia"] == $contrasenia){
	    		$id = $row["idPersona"];
	    	}
	    }
	    if($id != 0){
	    	$sql = "SELECT * FROM `Estudiante` where Persona_idPersona = ".$id."";
	    	$result = mysqli_query($conn, $sql);
	    	while($row = mysqli_fetch_assoc($result)) {
	            $idEstudiante = $row["idEstudiante"];
	    		$mensaje = "Estudiante";
	    	}
	        if($mensaje == "Estudiante"){
	            $fecha = date();
	            $sql = "SELECT Date_format(fecha, '%Y-%m-%d') FROM Cita WHERE Estudiante_idEstudiante = '".$idEstudiante."' ORDER BY fecha ASC";
	            $result = mysqli_query($conn, $sql);
	            while($row = mysqli_fetch_assoc($result)) {
	                $fecha = date($row["Date_format(fecha, '%Y-%m-%d')"]);
	            }
	            $fechaActual = date("Y-m-d");
	            if($fechaActual <= $fecha){
	                $mensaje = "Cita";
	            }
	            else{
	                session_start();
	                $_SESSION["usuarioActivo"] = $id;
	            }
	        }
	        else{
	            $sql = "SELECT * FROM `Psicologa` where Persona_idPersona = ".$id."";
	            $result = mysqli_query($conn, $sql);
	            while($row = mysqli_fetch_assoc($result)) {
	                $mensaje = "Psicologa";
	            }
	            session_start();
	            $_SESSION["usuarioActivo"] = $id;
	        }

	    }
		}

		echo $mensaje;
    mysqli_close($conn);
?>
