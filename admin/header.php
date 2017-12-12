<!DOCTYPE html>
<html>
<head>
	<title>Depósito Vázquez</title>
  <link rel="shortcut icon" href="../../images/icon.png" type="image/x-icon">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js">
	</script>

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
<?php
  if (isset($_SESSION['validado'])) :
?>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><?php echo $_SESSION['usuario']['email']; ?></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="/deposito/admin/cliente">Clientes</a></li>
        <li><a href="/deposito/admin/empleado">Empleados</a></li>
        <li><a href="/deposito/admin/producto">Productos</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Catalogos<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="/deposito/admin/marca">Marca</a></li>
            <li><a href="/deposito/admin/proveedor">Proveeedor</a></li>
            <li><a href="/deposito/admin/sucursal">Sucursal</a></li>
            <li><a href="/deposito/admin/categoria">Categorias</a></li>
            <li><a href="/deposito/admin/unidad_medida">Unidad medida</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="/deposito/admin/rol">Roles</a></li>
          </ul>
        </li>
      </ul>
      <form class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="/deposito/admin/promocion">Promociones</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cuenta<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="/deposito/admin/detalles">Detalles</a></li>
            <li><a href="/deposito/admin/login/logout.php">Log out</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<?php
  endif;
?>
<?php
  if (isset($mensaje) and isset($color)) {
    echo '<div class="alert alert-'.$color.'" role="alert">'.$mensaje.'</div>';
  }
?>
