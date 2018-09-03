<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Payment site | continue Payment</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/shop-item.css" rel="stylesheet">
	  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script type="text/javascript" src="assets/js/Utilities.js"></script>
  </head>

  <body class="" <?=$load_java; ?>>

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
              <i class="fa fa-credit-card"></i> 2. Continuar pago
            </div>
            <div class="card-body">
      			<div class="row">
	            	<div class="col-lg-3">&nbsp;</div>
	            	<div class="col-lg-6">

	            		<form id="register" action="continuePayment/redireccionaBanco" method="post">

                    <input type="hidden" name="interface" value="<?=$interface;?>">
                    <input type="hidden" name="banco" value="<?=$banco;?>">

                    <h4>Datos del pagador</h4>
	              		<div class="form-group col-lg-6" style="float: left;">
	              			<label>Tipo de documento:</label>
	              			<select class="form-control" required="true" name="doc_type_payment" id="doc_type_payment">
	              				<option value="">Seleccione un valor</option>
	              				<option value="CC">Cédula de ciudanía colombiana</option>
                        <option value="CE">Cédula de extranjería</option>                       
                        <option value="TI">Tarjeta de identidad</option>
                        <option value="PPN">Pasaporte</option>
                        <option value="NIT"> Número de identificación tributaria</option>
                        <option value="SSN">Social Security Number</option>
	              			</select>
	              		</div>
                    <div class="form-group col-lg-6" style="float: left;">
                      <label>Número de documento:</label>
                      <input type="number" name="num_doc_payment" id="num_doc_payment" class="form-control" required="true" placeholder="No. documento">
                    </div>

                    <div class="form-group col-lg-6" style="float: left;">
                      <label>Nombres:</label>
                      <input type="text" autocomplete="off" name="fist_name_payment" class="form-control" required="true" placeholder="Nombres">
                    </div>
                    <div class="form-group col-lg-6" style="float: left;">
                      <label>Apellidos:</label>
                      <input type="text" autocomplete="off" name="last_name_payment" class="form-control" required="true" placeholder="Apellidos">
                    </div>

                    <div class="form-group col-lg-12" style="float: left;">
                      <label>Empresa que representa o donde labora:</label>
                      <input type="text" autocomplete="off" name="company_payment" class="form-control" required="true" placeholder="Empresa">
                    </div>

                    <div class="form-group col-lg-12" style="float: left;">
                      <label>Correo:</label>
                      <input type="mail"  autocomplete="off" name="mail_payment" class="form-control" required="true" placeholder="Correo">
                    </div>

                    <div class="form-group col-lg-12" style="float: left;">
                      <label>Direccion postal completa:</label>
                      <input type="text"  autocomplete="off" name="addres_payment" class="form-control" required="true" placeholder="Dirección">
                    </div>

                    <div class="form-group col-lg-6" style="float: left;">
                      <label>Ciudad:</label>
                      <input type="text" autocomplete="off" name="city_payment" class="form-control" required="true" placeholder="Ciudad">
                    </div>
                    <div class="form-group col-lg-6" style="float: left;">
                      <label>Provincia:</label>
                      <input type="text" autocomplete="off" name="province_payment" class="form-control" required="true" placeholder="Provincia">
                    </div>

                    <div class="form-group col-lg-6" style="float: left;">
                      <label>Teléfono:</label>
                      <input type="number" autocomplete="off" name="phone_payment" class="form-control" required="true" placeholder="Teléfono">
                    </div>
                    <div class="form-group col-lg-6" style="float: left;">
                      <label>Celular:</label>
                      <input type="number" autocomplete="off" name="mobile_payment" class="form-control" required="true" placeholder="Celular">
                    </div>

                    <div style="clear:both;"></div>

                    <h4>Datos del destinatario</h4>
                    <div class="form-group col-lg-6" style="float: left;">
                      <label>Tipo de documento:</label>
                      <select class="form-control" required="true" name="doc_type_shipping" id="doc_type_shipping">
                        <option value="">Seleccione un valor</option>
                        <option value="CC">Cédula de ciudanía colombiana</option>
                        <option value="CE">Cédula de extranjería</option>                       
                        <option value="TI">Tarjeta de identidad</option>
                        <option value="PPN">Pasaporte</option>
                        <option value="NIT"> Número de identificación tributaria</option>
                        <option value="SSN">Social Security Number</option>
                      </select>
                    </div>
                    <div class="form-group col-lg-6" style="float: left;">
                      <label>Número de documento:</label>
                      <input type="number" autocomplete="off" name="num_doc_shipping" id="num_doc_shipping" class="form-control" required="true" placeholder="No. documento">
                    </div>

                    <div class="form-group col-lg-6" style="float: left;">
                      <label>Nombres:</label>
                      <input type="text" autocomplete="off" name="fist_name_shipping" class="form-control" required="true" placeholder="Nombres">
                    </div>
                    <div class="form-group col-lg-6" style="float: left;">
                      <label>Apellidos:</label>
                      <input type="text" autocomplete="off" name="last_name_shipping" class="form-control" required="true" placeholder="Apellidos">
                    </div>

                    <div class="form-group col-lg-12" style="float: left;">
                      <label>Empresa que representa o donde labora:</label>
                      <input type="text" autocomplete="off" name="company_shipping" class="form-control" required="true" placeholder="Empresa">
                    </div>

                    <div class="form-group col-lg-12" style="float: left;">
                      <label>Correo:</label>
                      <input type="mail" autocomplete="off" name="mail_shipping" class="form-control" required="true" placeholder="Correo">
                    </div>

                    <div class="form-group col-lg-12" style="float: left;">
                      <label>Direccion postal completa:</label>
                      <input type="text" autocomplete="off" name="addres_shipping" class="form-control" required="true" placeholder="Dirección">
                    </div>

                    <div class="form-group col-lg-6" style="float: left;">
                      <label>Ciudad:</label>
                      <input type="text" autocomplete="off" name="city_shipping" class="form-control" required="true" placeholder="Ciudad">
                    </div>
                    <div class="form-group col-lg-6" style="float: left;">
                      <label>Provincia:</label>
                      <input type="text" autocomplete="off" name="province_shipping" class="form-control" required="true" placeholder="Provincia">
                    </div>

                    <div class="form-group col-lg-6" style="float: left;">
                      <label>Teléfono:</label>
                      <input type="number" autocomplete="off" name="phone_shipping" class="form-control" required="true" placeholder="Teléfono">
                    </div>
                    <div class="form-group col-lg-6" style="float: left;">
                      <label>Celular:</label>
                      <input type="number" autocomplete="off" name="mobile_shipping" class="form-control" required="true" placeholder="Celular">
                    </div>

                    <h4> Datos de la transacción</h4>
                    <div class="form-group col-lg-12" style="float: left;">
                      <label>Referencia de pago:</label>
                      <input type="text" autocomplete="off" name="reference" class="form-control" required="true" placeholder="Referencia de pago">
                    </div>
                    <div class="form-group col-lg-12" style="float: left;">
                      <label>Total transacción:</label>
                      <input type="number" autocomplete="off" name="total_amount" class="form-control" required="true" placeholder="Total transacción ($)">
                    </div>

                    <div style="clear:both;"></div>

	              		<a href="<?= base_url(); ?>" class="btn btn-danger"><i class="fa fa-mail-reply"></i> Regresar</a>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-credit-card-alt"></i> Ir al sitio del banco</button>
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

    <div class="modal" id="loader" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Cargando ...</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <!-- Modal body -->
          <div class="modal-body">
            <img src="assets/img/loader.gif" class="img img-responsive" alt="cargando...">
          </div>
          <!-- Modal footer -->
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>

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
    <script src="assets/js/app/transaction.js"></script>

  </body>

</html>