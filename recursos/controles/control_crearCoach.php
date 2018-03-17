<?php
 session_start();

 	if( isset($_SESSION['id']) and $_SESSION['tipo'] == 1 ){
		//Si la sesión esta seteada no hace nada
 		$us = $_SESSION['id'];
	} 	else{
		//Si no lo redirige a la pagina index para que inicie la sesion	
		header("location: ../../index.html");
		 	}      
	     
	require_once '../clases/Funciones.php';
	require_once '../clases/ClasePersona.php';

	try{
		$nom = $_POST['nom_co'];
		$correo = $_POST['correo_co'];
		$fono = $_POST['fono_co'];
		$super = 0;
		if(isset($_POST['super'])){
			$super = 1;
		}
		$vig = 1;
		
		$fun = new Funciones(); 
		
		$id = 1;//identificador de usuario coach

		if ($correo != ''){
		$val = $fun->validar_correo($correo, $id);

		if ($val <> ""){
			echo"<script type=\"text/javascript\">alert('El correo ya se encuentra en el sistema, favor utilizar otro correo o restablezca su contraseña'); window.location='../paginas_co/crear_co.php'; </script>";  
			
			
		}else{
			$nueva_pass = $fun->generaPass();

			$dao = new CoachDAO('',$nom, $correo, $fono, md5($nueva_pass),$vig,$super, '');
		
			$crear_co = $dao->crear_coach();
			
			if (count($crear_co)>0){
			echo"<script type=\"text/javascript\">alert('Error de base de datos, comuniquese con el administrador'); window.location='../paginas_co/crear_co.php';</script>";    
			} else {
				$enviar_pass = $fun->enviar_correo_pass($nom,$correo,$nueva_pass);
				echo"<script type=\"text/javascript\">alert('Coach ".$nom." Creado, favor verifique en su correo (Buzon de entrada, correos no deseados o spam) la contraseña para ingresar.'); window.location='../paginas_co/crear_co.php';		
				</script>"; 
					}
		}}else{
		echo"Error";
	}

	} catch (Exception $e) {
		echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_co/crear_co.php';</script>"; 



	}
	
?>