$(function(){
	
	$(document).ajaxStart(function () {
	    $('#loader').modal('show');
	});

	$(document).ajaxStop(function () {
	    $('#loader').modal('hide');
	    setTimeout(function(){
	        $('body').css('padding-right', '0px');
	    }, 600);
	});

	$(document).on('submit', '#register', function(e){
		e.preventDefault();
		
		$.ajax({
            type: $(this).attr('method'),
            url: base_path + $(this).attr('action'),
            data: $(this).serialize(), 
            success: function(resp) { 
                if(resp != '')
                {
                    try {
                    	var info = jQuery.parseJSON(resp);
                    	location.href = info.urlRedirect;
                    }
                    catch(e) {
                    	alert(resp);
                    }
                }
                else
                    alert("No se obtuvo resultado de la transacción.");
            },
            error: function(result){
                alert("Se generó un inconveniente procesando la petición: " + result.status + ' ' + result.statusText);
            }
        });
	});

	$(document).on('blur', '#num_doc_payment', function(){

		if($('#doc_type_payment').val() != "" && $('#num_doc_payment').val() != "")
		{
			$('input[name="fist_name_payment"]').val("");
			$('input[name="last_name_payment"]').val("");
			$('input[name="company_payment"]').val("");
			$('input[name="mail_payment"]').val("");
			$('input[name="addres_payment"]').val("");
			$('input[name="city_payment"]').val("");
			$('input[name="province_payment"]').val("");
			$('input[name="phone_payment"]').val("");
			$('input[name="mobile_payment"]').val("");

			$.ajax({
	            type: "POST",
	            url: base_path + "getInfoPerson",
	            data: {type: $('#doc_type_payment').val(), docu: $('#num_doc_payment').val()},
	            success: function(resp) { 
	                if(resp != '')
	                {
	                    try {
	                    	var info = jQuery.parseJSON(resp);
	                    	$('input[name="fist_name_payment"]').val(info.nombres);
	                    	$('input[name="last_name_payment"]').val(info.apellidos);
	                    	$('input[name="company_payment"]').val(info.empresa);
	                    	$('input[name="mail_payment"]').val(info.correo);
	                    	$('input[name="addres_payment"]').val(info.direccion);
	                    	$('input[name="city_payment"]').val(info.ciudad);
	                    	$('input[name="province_payment"]').val(info.provincia);
	                    	$('input[name="phone_payment"]').val(info.telefono);
	                    	$('input[name="mobile_payment"]').val(info.celular);
	                    	$('input[name="fist_name_payment"]').focus();
	                    }
	                    catch(e) {
	                    }
	                }
	                else
	                    alert("No se obtuvo resultado de la transacción.");
	            },
	            error: function(result){
	                alert("Se generó un inconveniente procesando la petición: " + result.status + ' ' + result.statusText);
	            }
	        });
		}
	});

	
	$(document).on('blur', '#num_doc_shipping', function(){

		if($('#doc_type_shipping').val() != "" && $('#num_doc_shipping').val() != "")
		{
			$('input[name="fist_name_shipping"]').val("");
			$('input[name="last_name_shipping"]').val("");
			$('input[name="company_shipping"]').val("");
			$('input[name="mail_shipping"]').val("");
			$('input[name="addres_shipping"]').val("");
			$('input[name="city_shipping"]').val("");
			$('input[name="province_shipping"]').val("");
			$('input[name="phone_shipping"]').val("");
			$('input[name="mobile_shipping"]').val("");

			$.ajax({
	            type: "POST",
	            url: base_path + "getInfoPerson",
	            data: {type: $('#doc_type_shipping').val(), docu: $('#num_doc_shipping').val()},
	            success: function(resp) { 
	                if(resp != '')
	                {
	                    try {
	                    	var info = jQuery.parseJSON(resp);
	                    	$('input[name="fist_name_shipping"]').val(info.nombres);
	                    	$('input[name="last_name_shipping"]').val(info.apellidos);
	                    	$('input[name="company_shipping"]').val(info.empresa);
	                    	$('input[name="mail_shipping"]').val(info.correo);
	                    	$('input[name="addres_shipping"]').val(info.direccion);
	                    	$('input[name="city_shipping"]').val(info.ciudad);
	                    	$('input[name="province_shipping"]').val(info.provincia);
	                    	$('input[name="phone_shipping"]').val(info.telefono);
	                    	$('input[name="mobile_shipping"]').val(info.celular);
	                    	$('input[name="fist_name_shipping"]').focus();
	                    }
	                    catch(e) {
	                    }
	                }
	                else
	                    alert("No se obtuvo resultado de la transacción.");
	            },
	            error: function(result){
	                alert("Se generó un inconveniente procesando la petición: " + result.status + ' ' + result.statusText);
	            }
	        });
		}
	});
})