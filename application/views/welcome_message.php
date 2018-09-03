<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Payment site</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/shop-item.css" rel="stylesheet">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">Payment site</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Services</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">

      <div class="row">

        <div class="col-lg-12">

          <div class="card card-outline-secondary my-4">
            <div class="card-header" style="font-weight: bold;font-size: 14pt;">
              <i class="fa fa-credit-card"></i> 1. Seleccione una opción para continuar el pago
            </div>
            <div class="card-body">
      			<div class="row">
	            	<div class="col-lg-4">&nbsp;</div>
	            	<div class="col-lg-5">

	            		<div class="col-md-12" style="text-align: center;">
	              			<img src="assets/img/pse.png" class="img img-responsive" style="width: 40%;">
	            		</div>

	            		<form action="continuePayment" method="post">
		              		<div class="form-group">
		              			<label>Indique el tipo de persona con la cual realizará el pago:</label>
		              			<select class="form-control" required="true" name="interface">
		              				<option value="">Seleccione un valor</option>
		              				<option value="0">Personas</option>
		              				<option value="1">Empresa</option>	              				
		              			</select>
		              		</div>

		              		<div class="form-group">
		              			 <label>Seleccione de la lista la entidad financiera con la que desea realizar el pago:</label>	              			
	      				     	   <select class="form-control" required="true" name="banco">
		              				<?php
		              					if(isset($bancos))
		              					{
		              						if(!is_null($bancos))
		              						{
		              							foreach ($bancos as $banco) {
		              				?>
		              								<option value="<?=$banco->codigo;?>"><?=$banco->nombre;?></option>
									<?php

		              							}
		              						}
		              					}
		              				?>
		              			</select>
		              		</div>
		              		<button typ="submit" class="btn btn-success"><i class="fa fa-credit-card-alt"></i> Continuar</button>
	            		</form>
	            	</div>
	            	<div class="col-lg-3">&nbsp;</div>
	            </div>
            </div>
          </div>
          <!-- /.card -->

        </div>
        <!-- /.col-lg-12 -->
      </div>
    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Payment site 2018</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>