$(document).ready(function() {
	var $jqDate = jQuery('input[name="date"]');
	$jqDate.attr('maxlength','10');

	$jqDate.bind('keyup','keydown', function(e){

		if(e.which !== 8) { 
	        var numChars = $jqDate.val().length;
	        if(numChars === 2 || numChars === 5){
	            var thisVal = $jqDate.val();
	            thisVal += '/';
	            $jqDate.val(thisVal);
	        }
	  }
	});

	var $jqDate = jQuery('input[name="dt_collected"]');
	$jqDate.attr('maxlength','10');

	$jqDate.bind('keyup','keydown', function(e){

		if(e.which !== 8) { 
	        var numChars = $jqDate.val().length;
	        if(numChars === 2 || numChars === 5){
	            var thisVal = $jqDate.val();
	            thisVal += '/';
	            $jqDate.val(thisVal);
	        }
	  }
	});

	var $cpf = jQuery('input[name="cpf"]');
	$cpf.attr('maxlength', '14');

	$cpf.bind('keyup','keydown', function(e){

		if(e.which !== 8) { 
	        var numChars = $cpf.val().length;
	        if(numChars === 3 || numChars === 7){
	            var thisVal = $cpf.val();
	            thisVal += '.';
	            $cpf.val(thisVal);
	        }
	        else if(numChars === 11){
	        	var thisVal = $cpf.val();
	            thisVal += '-';
	            $cpf.val(thisVal);
	        }
	  }
	});

	var $cnpj = jQuery('input[name="cnpj"]');
	$cnpj.attr('maxlength', '18');

	$cnpj.bind('keyup','keydown', function(e){

		if(e.which !== 8) { 
	        var numChars = $cnpj.val().length;
	        if(numChars === 2 || numChars === 6){
	            var thisVal = $cnpj.val();
	            thisVal += '.';
	            $cnpj.val(thisVal);
	        }
	        else if(numChars === 10){
	        	var thisVal = $cnpj.val();
	            thisVal += '/';
	            $cnpj.val(thisVal);
	        }
	        else if(numChars === 15){
	        	var thisVal = $cnpj.val();
	            thisVal += '-';
	            $cnpj.val(thisVal);
	        }
	  }
	});

	var $home_phone = jQuery('input[name="home_phone"]');
	$home_phone.attr('maxlength','12');

	$home_phone.bind('keyup','keydown', function(e){
		if(e.which !== 8) { 
	        var numChars = $home_phone.val().length;
	        if(numChars === 2){
	            var thisVal = $home_phone.val();
	            thisVal += ' ';
	            $home_phone.val(thisVal);
	        }
	        else if(numChars === 7){
	        	var thisVal = $home_phone.val();
	            thisVal += '-';
	            $home_phone.val(thisVal);
	        }
	  }
	});

	var $corp_phone = jQuery('input[name="corp_phone"]');
	$corp_phone.attr('maxlength','12');

	$corp_phone.bind('keyup','keydown', function(e){
		if(e.which !== 8) { 
	        var numChars = $corp_phone.val().length;
	        if(numChars === 2){
	            var thisVal = $corp_phone.val();
	            thisVal += ' ';
	            $corp_phone.val(thisVal);
	        }
	        else if(numChars === 7){
	        	var thisVal = $corp_phone.val();
	            thisVal += '-';
	            $corp_phone.val(thisVal);
	        }
	  }
	});

	var $mobile_phone = jQuery('input[name="mobile_phone"]');
	$mobile_phone.attr('maxlength', '14');


	$mobile_phone.bind('keyup','keydown', function(e){

		if(e.which !== 8) { 
	        var numChars = $mobile_phone.val().length;
	        if(numChars === 2){
	            var thisVal = $mobile_phone.val();
	            thisVal += ' ';
	            $mobile_phone.val(thisVal);
	        }
	        else if(numChars === 6 || numChars === 10){
	        	var thisVal = $mobile_phone.val();
	            thisVal += '-';
	            $mobile_phone.val(thisVal);
	        }
	  }
	});

	var $id_cep = jQuery('input[name="id_cep"]');
	$id_cep.attr('maxlength', '9');


	$id_cep.bind('keyup','keydown', function(e){

		if(e.which !== 8) { 
	        var numChars = $id_cep.val().length;
	        if(numChars === 5){
	            var thisVal = $id_cep.val();
	            thisVal += '-';
	            $id_cep.val(thisVal);
	        }
	  }
	});

});