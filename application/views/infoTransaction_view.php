<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Payment site | confirmación de pago</title>

    <!-- Bootstrap core CSS -->
    <link href="<?=base_url();?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?=base_url();?>assets/css/shop-item.css" rel="stylesheet">
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
              <i class="fa fa-credit-card"></i> Estado de la transacción
            </div>
            <div class="card-body">
      			<div class="row">
	            	<div class="col-lg-4">&nbsp;</div>
	            	<div class="col-lg-5">

                  <?php

                    if(isset($result))
                    {
                  ?>
                    <div class="alert alert-<?=($result['responseReasonText'] != 'Aprobada' ? 'danger' : 'success');?>">
                      <strong style="font-size: 15pt;"><i class="fa fa-bell"></i> Resultado de transacción:</strong><br><br>
                      
                      <small style="font-weight: bold;">TransactionID:</small> <?=$result["transactionID"]?><br>
                      <small style="font-weight: bold;">Código de trazabilidad:</small> <?=$result["trazabilityCode"]?><br>
                      <small style="font-weight: bold;">Referencia de pago:</small> <?=$result["reference"]?><br>
                      <small style="font-weight: bold;">Fecha Transacción banco:</small> <?=$result["bankProcessDate"]?><br>
                      <small style="font-weight: bold;">Estado de Transacción:</small> <?=$result["responseReasonText"]?><br>
                    </div>
                  <?php                      
                    }
                    else if(isset($info_message))
                    {
                  ?>
                    <div class="alert alert-info">
                      <strong>Información:</strong>
                      <?=$info_message;?>
                    </div>
                  <?php
                    }
                    else if(isset($err_message))
                    {
                  ?>
                      <div class="alert alert-error">
                        <strong>Mesaje de error:</strong>
                        <?=$err_message;?>
                      </div>
                  <?php
                    }
                  ?>
                  
                  <div style="clear:both;">&nbsp;</div>
                  <div style="clear:both;">&nbsp;</div>
                  <div style="clear:both;">&nbsp;</div>
                  
                  <a href="<?=base_url();?>" class="btn btn-lg btn-success"><i class="fa fa-home"></i> Ir a la página principal</a>
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
    <script src="<?=base_url();?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?=base_url();?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>