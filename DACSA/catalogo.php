<?php 
  include_once("modelo\iniciar_sesion_db.php");
  include_once("modelo\producto.php");
  session_start();
  $sErr = "";
  $Usuario=new Usuario();
  $arrProdctos = null;
  $Producto = new Producto();
 
  if (isset($_SESSION["usu"])){
    $Usuario = $_SESSION["usu"];
    try {
      $arrProdctos = $Producto->search_all();
    } catch (Exception $e) {
      error_log($e->getFile()." ".$e->getLine()." ".$e->getMessage(),0);
      $sErr = "Error en base de datos, comunicarse con el administrador";
    }
  }
  else
    $sErr = "Debe estar firmado"
 ?>

<?php  include_once("menu.php");  ?><br><br>
<?php  include_once("header.html"); ?><br>

<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
</head>
<body>

  <br>

  <section class="container-fluid ">

    <form action="" method="post" class="form-inline ">
      <input type="text" placeholder="Buscar" class="form-control mr-sm-2">
      <button class="btn btn-success" type="submit">Buscar</button>
    </form>
    <br>
    <center><h3>Resultados:</h3></center><br>

    <article class="row">
      <div class="col">
        <table class="table table-bordered table-hover">
          <thead class="">
            <tr>
              <td>Producto</td>
              <td>Precio Total</td>
              <td>Existencia</td>
              <td></td>
            </tr>
          </thead>
          <?php 
            if ($arrProdctos != null) {
              foreach ($arrProdctos as $Producto) {
          ?>
                <tr>
                  <td><?php echo $Producto->getNombre(); ?></td>
                  <td><?php echo $Producto->getPrecio(); ?></td>
                  <td><?php echo $Producto->getExistencia(); ?></td>
                  <td>
                    <input type="submit" value="Agregar" class="btn btn-success"> 
                  </td>
                </tr>
          <?php
              }
            }else{
          ?>
              <tr>
                <td colspan="4">No hay datos</td>
              </tr>
          <?php
            }
          ?>
        </table>
      </div>
    </article>
  </section>
  <script src="js/popper.min.js"></script>
  <script src="js/jquery-3.3.1.slim.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>
</html>

<?php
include_once("footer.html");
?>
