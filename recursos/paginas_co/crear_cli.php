<?php 
session_start(); 
if( isset($_SESSION['id']) and ($_SESSION['tipo'] == 1 or $_SESSION['tipo'] == 2 ) ){
    //Si la sesión esta seteada no hace nada
    $id = $_SESSION['id'];
  }
  else{
    //Si no lo redirige a la pagina index para que inicie la sesion 
    header("location: ../../index.html");
  }      
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>D3 - Crear Cliente</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>

  <script>
function validar(f){
f.btnAc.value="Creando Cliente";
f.btnAc.disabled=true;
return true}
</script>
</head>

<body>

  
  
      <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
              <a  href="entrenamiento.php"><img class="img-fluid" src="../img/logo/logo_d3safio3.png" alt="D3safio" width="150" height="30"></a>
              <ul class="navbar-nav ml-auto" >
                <!-- Dropdown -->
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Clientes</a>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="crear_cli.php">Crear Cliente</a>
                        <a class="dropdown-item" href="mod_cli.php">Modificar Cliente</a>
                      </div>
                    </li>
                <li class="nav-item"><a class="nav-link" href="entrenamiento.php">Entrenamiento</a></li>
                <li class="nav-item"><a class="nav-link" href="nutricion.php">Nutrición</a></li>
                <!-- Dropdown -->
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Coach</a>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="crear_co.php">Crear Coach</a>
                        <a class="dropdown-item" href="mod_co.php">Modificar Coach</a>
                      </div>
                    </li>
                <li class="nav-item"><a class="nav-link" href="../controles/logout.php" onclick="return confirm('¿Deseas finalizar sesión?');">Cerrar Sesión</a></li>
              </ul>
</nav>
<div class="container" style="padding-top: 5px">
  <div class="row">
  <div class="col-12">
    <h3>Crear Cliente</h3>
    <hr>
  </div>
  </div>
  <div class="row">
    <div class="col-6">
          <form role="form" action="../controles/control_crearCli.php" method="post" id="new_cli" name="new_cli" onsubmit="return validar(this)">
            <div class="form-group">
              <label for="nom">Nombre:</label>
              <input type="text" class="form-control" name="nom_cli" maxlength="150" required>
            </div>
            <div class="form-group">
              <label for="nom">Correo:</label>
              <input type="text" class="form-control" name="correo_cli" maxlength="100" required>
            </div>
            <div class="form-group">
               <label for="fono">Telefono (8 digitos):</label>
              <input type="tel"  class="form-control" name="fono_cli" pattern="[0-9]{8}" placeholder="+56 9" required>
            </div>
            <div class="form-group">
               <label for="fec_nac">Fecha Nacimiento:</label>
              <input type="date" class="form-control" name="fec_nac_cli" required>
            </div>
    </div>
    <div class="col-6">
          <div class="form-group">
              <label for="est">Estatura (CM):</label>
              <input type="number" class="form-control" name="est_cli"  required>
            </div>
            <div class="form-group">
              <label for="peso">Peso (KG):</label>
              <input type="number" class="form-control" name="peso_cli"  required>
            </div>
            <div class="form-group">
               <label for="fec_plan">Fecha Inicio del Plan(fecha de termino +1 mes):</label>
              <input type="date" class="form-control" name="fec_plan_cli" required>
            </div>
            <div>
              <label for="ser_cli">Plan: </label>
              <label class="radio-inline">
              <input type="radio"  name="ser" value="1" required>Entrenamiento
              </label>
              <label class="radio-inline">
              <input type="radio"  name="ser" value="2">Nutrición
              </label>
              <label class="radio-inline">
              <input type="radio"  name="ser" value="3">Full
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
              <input class="form-check-input" type="checkbox" name="gym" id="gym"> Gimnasio
              </label>
            </div>
            
            <input type="submit" class="btn btn-outline-success" id="btnAc" value="Crear Cliente">
          </form>
    </div>
    </div>
</body>
</html>