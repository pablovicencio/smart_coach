<?php
session_start(); 
if( isset($_SESSION['id']) ){
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
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>D3 - Mi Cuenta</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>


  <script language="JavaScript" type="text/javascript">
  function validar(f){
f.btnAc.value="Modificando Cuenta";
f.btnAc.disabled=true;
return true}

function evo() {
  if($("#cambio").is(':checked')) { 
        $('#est_cli').removeAttr('readonly');
        $('#peso_cli').removeAttr('readonly');
        }else{
          $('#est_cli').prop('readonly','readonly');
          $('#peso_cli').prop('readonly','readonly');
        }
}


</script>
<style>
 
@media (max-width: 800px) {
    
        body{font-size: 2.5vw;}
        


}

</style>


</head>

<body>

  
  
       <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
              <a  href="index_usu.php"><img class="img-fluid" src="../img/logo/logo_d3safio3.png" alt="D3safio" width="150" height="30"></a>
              <button class="navbar-toggler navbar-toggler-right collapsed" type="button" data-toggle="collapse" data-target="#navb" aria-expanded="false">
              <span class="navbar-toggler-icon"></span>
              </button>
              <div class="navbar-collapse collapse" id="navb" style="">
                  <ul class="navbar-nav ml-auto">
                  <li class="nav-item"><a class="nav-link" href="index_usu.php">Hoy</a></li>
                    <li class="nav-item"><a class="nav-link" href="calendario.php">Calendario</a></li>
                    <li class="nav-item"><a class="nav-link" href="nutricion.php">Nutrición</a></li>
                    <li class="nav-item"><a class="nav-link" href="evolucion.php">Evolución</a></li>
                    <li class="nav-item"><a class="nav-link" href="mi_cuenta.php">Mi Cuenta</a></li>
                    <li class="nav-item"><a class="nav-link" href="../controles/logout.php" onclick="return confirm('¿Deseas finalizar sesión?');">Cerrar Sesión</a></li>
                  </ul>
              </div>
            </nav>
<div class="container" style="padding-top: 5px">
<form action="../controles/control_modCli_MC.php" method="POST" onsubmit="return validar(this)">
  <div class="row">
  <div class="col-12">
    <h3>Mis Datos</h3>
    <hr>
  </div>
  </div>
                  <?php
                  $re = $fun->cargar_cli($id);   
                  foreach($re as $row)      
                      {
                         
                      }    
                  ?>  
  <div class="row" id="form_cli">
  <div class="col-6">

          <div class="form-group">
            <label for="nom">Nombre:</label>
            <input type="text" class="form-control" id="nom_cli" name="nom_cli" maxlength="200" value="<?php echo $row['nom_cli'] ?>" required>
          </div>
          <div class="form-group">
              <label for="nom">Correo:</label>
              <input type="text" class="form-control" name="correo_cli" id="correo_cli" value="<?php echo $row['correo_cli'] ?>"   maxlength="100" required>
            </div>
          <div class="form-group">
             <label for="fono">Telefono (8 digitos):</label>
             <input type="tel"  class="form-control" id="fono_cli" name="fono_cli" value="<?php echo $row['fono_cli'] ?>"  pattern="[0-9]{8}" required>
          </div>
          <div class="form-group">
             <label for="fec_nac">Fecha Nacimiento:</label>
             <input type="date" class="form-control" id="fec_nac_cli" name="fec_nac_cli" value="<?php echo $row['fec_nac_cli'] ?>"  required>
          </div>
  </div>
  <div class="col-6">
        <div class="form-check">
            <label class="form-check-label">
            <input class="form-check-input" type="checkbox" name="cambio" id="cambio" onchange="evo()"> Agregar evolución
            </label>
          </div>
        <div class="form-group">
            <label for="est">Estatura (CM):</label>
            <input type="number" class="form-control" id="est_cli" name="est_cli" step="any" required readonly>
          </div>
          <div class="form-group">
            <label for="peso">Peso (KG):</label>
            <input type="number" class="form-control" id="peso_cli" name="peso_cli" step="any" required readonly>
          </div>
          <input type="submit" name="btnAc" id="btnAc" class="btn btn-outline-success" value="Modificar Cuenta">
        </form>
  </div>
  </div>
<form action="../controles/control_modPassCli.php" method="POST" onsubmit="return validar(this)">
<div class="row">
<div class="col-12">
   <hr>
    <h3>Modificar Contraseña</h3>
    <div class="col-12">
      <div class="form-group">
            <label for="nom">Contraseña Actual:</label>
            <input type="password" class="form-control" id="pass" name="pass" maxlength="6" required>
          </div>
    </div>
    <div class="col-12">
      <div class="form-group">
            <label for="nom">Nueva Contraseña (6 caracteres):</label>
            <input type="password" class="form-control" id="nueva_pass" name="nueva_pass" maxlength="6" required>
          </div>
    </div>
    <div class="col-12">
      <div class="form-group">
            <label for="nom">Confirmar Nueva Contraseña (6 caracteres)</label>
            <input type="password" class="form-control" id="nueva_pass1" name="nueva_pass1" maxlength="6" required>
          </div>
          <input type="submit" name="btnAc" id="btnAc" class="btn btn-outline-success" value="Modificar Contraseña">
        </form>
    </div>
    
</div>
</div>



</div>

</body>
</html>