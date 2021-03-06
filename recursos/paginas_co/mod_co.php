<?php
session_start(); 
if( isset($_SESSION['id']) and ($_SESSION['tipo'] == 1 or $_SESSION['tipo'] == 2 )and  $_SESSION['super'] == 1 ){
    //Si la sesión esta seteada no hace nada
    $id = $_SESSION['id'];
  }
  else{
    //Si no lo redirige a la pagina index para que inicie la sesion 
    header("location: ../../index.html");
  } 
  require_once '../clases/Funciones.php';
  
  

  $fun = new Funciones(); 
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>D3 - Modificar Coach</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>


  <script language="JavaScript" type="text/javascript">
function validar(f){
f.btnAc.value="Modificando Coach";
f.btnAc.disabled=true;
return true}



function mod(co) {
    
     $.ajax({
      url: '../controles/control_cargarDatosCo.php',
      type: 'POST',
      data: {"co":co},
      dataType:'json',
      success:function(result){
        console.log(result);
        $('#nom_co').val(result[0].nom_coach);
        $('#correo_co').val(result[0].correo_coach);
        $('#fono_co').val(result[0].fono_coach);
        $('#fb_co').val(result[0].fb_coach);


        if ((result[0].vig_coach)==1) {  
          $('#vig').prop('checked', true);
              }else  {
                $('#vig').prop('checked', false);
              }

        if ((result[0].super)==1) {  
          $('#super').prop('checked', true);
              } else  {
                $('#super').prop('checked', false);
              }

        if ((result[0].tipo_coach)==1) {  
          $('#tipo_e').prop('checked', true);
              } else if ((result[0].tipo_coach)==2) {
                $('#tipo_n').prop('checked', true);
              }

  }
  })
    

}

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
<form action="../controles/control_modCo.php" method="post" id="mod_co" name="mod_co" onsubmit="return validar(this)">
  <div class="row">
  <div class="col-12">
    <h3>Modificar Coach</h3>
    <hr>
  </div>
  </div>
  <div class="col-12">
  <label for="cli">Coach:</label>
  <select class="form-control" id="coach" name="coach" style="width: 500px" onchange="mod(this.value)">
      <option value="" selected disabled>Seleccione Coach</option>
                 <?php 
                  $re = $fun->cargar_co(0);   
                  foreach($re as $row)      
                      {
                        ?>
                        
                         <option value="<?php echo $row['id_coach'] ?> ">
                         <?php echo $row['nom_coach'] ?>
                         </option>
                            
                        <?php
                      }    
                  ?>  
  </select><hr>
</div>
  <div class="row" id="form_co">
  <div class="col-6">

          <div class="form-group">
            <label for="nom">Nombre:</label>
            <input type="text" class="form-control" id="nom_co" name="nom_co" maxlength="200" required>
          </div>
          <div class="form-group">
              <label for="nom">Correo:</label>
              <input type="text" class="form-control" name="correo_co" id="correo_co" maxlength="100" required>
            </div>
          <div class="form-group">
             <label for="fono">Telefono (8 digitos):</label>
             <input type="tel"  class="form-control" id="fono_co" name="fono_co" pattern="[0-9]{8}" required>
          </div>
          <div class="form-group">
             <label for="fb">Nombre de Facebook:</label>
             <input type="text"  class="form-control" id="fb_co" name="fb_co" maxlength="50" required>
          </div>
  </div>
  <div class="col-6">
          <div class="form-check">
            <label class="form-check-label">
            <input class="form-check-input" type="checkbox" name="super" id="super"> Super Usuario
            </label>
          </div>
           <div>
            <label class="radio-inline">
              <input type="radio"  name="tipo" id="tipo_e" value="1" required>Entrenador
            </label>
            <label class="radio-inline">
              <input type="radio"  name="tipo" id="tipo_n" value="2">Nutricionista
            </label>
          </div>
          <div class="form-check">
            <label class="form-check-label">
            <input class="form-check-input" type="checkbox" name="vig" id="vig"> Vigencia
            </label>
          </div>
          <input type="submit" name="btnAc" id="btnAc" class="btn btn-outline-success" value="Modificar Coach">
        </form>
  </div>
  </div>


</div>

</body>
</html>