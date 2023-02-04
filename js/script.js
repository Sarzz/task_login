$(function(){

	$("#register_info").click(function(){
		$("#login").modal('hide');
		$("#registration").modal('show');
	})
	$("#forgot_password_info").click(function(){
		$("#login").modal('hide');
		$("#forgot_password").modal('show');
	})

	$("#register_but").click(function () {
		console.log("dshjfkzv");
		if($("#f_name").val() == ""){
			$(".error_reg").text("First Name cant't be blank"); exit();
		}
		if($("#l_name").val() == ""){
			$(".error_reg").text("Last Name cant't be blank"); exit();
		}
		if($("#email_reg").val() == ""){
			$(".error_reg").text("Email cant't be blank"); exit();
		}

		if(validateEmail($("#email_reg").val()) !== true){
			$(".error_reg").text("Wrong Email"); exit();
		}
		
		if($("#pass_reg").val() == ""){
			$(".error_reg").text("Password cant't be blank"); exit();
		}if($("#pass2_reg").val() == ""){
			$(".error_reg").text("Password cant't be blank"); exit();
		}
		if($("#pass_reg").val() != $("#pass2_reg").val()){
			$(".error_reg").text("Password don't match"); exit();
		}
		$.ajax('./ajax.php', {
		    type: 'POST',  // http method
		    data: { 
		    	f_name: $("#f_name").val(),
		    	l_name: $("#l_name").val(),
		    	mail: $("#email_reg").val(),
		    	pass: $("#pass_reg").val(),
		    	reg: ''

    		},  // data to submit
		    success: function (data, status, xhr) {
		        info = JSON.parse(data);
		        if(info["success"] === true){
		        	$("#registration_success").modal('show');
					$("#registration").modal('hide');
		        }else{
		        	$(".error_reg").text(info["error"]);
		        }
		    },
		    error: function (jqXhr, textStatus, errorMessage) {
		        
		    }
		});
	});



	$("#login_but").click(function () {
		if($("#email_login").val() == ""){
			$(".error_login").text("Email cant't be blank"); exit();
		}

		if(validateEmail($("#email_login").val()) !== true){
			$(".error_login").text("Wrong Email"); exit();
		}
		
		if($("#pass_login").val() == ""){
			$(".error_login").text("Password cant't be blank"); exit();
		}

		$.ajax('./ajax.php', {
		    type: 'POST',  // http method
		    data: { 
		    	mail: $("#email_login").val(),
		    	pass: $("#pass_login").val(),
		    	login: ''

    		},  // data to submit
		    success: function (data, status, xhr) {
		        info = JSON.parse(data);
		        if(info["success"] === true){
		        	$(".content").append("<h4>Name: " + info["f_name"] + " " + info["l_name"] + " </h4>");
		        	$(".login").html('<span onclick="logout()">Logout</span>');
		        	$("#login").modal('hide');

		        }else{
		        	$(".error_login").text(info["error"]);
		        }
		    },
		    error: function (jqXhr, textStatus, errorMessage) {
		        
		    }
		});
	});

	$("#forget_but").click(function () {
		if($("#email_forgot").val() == ""){
			$(".forgot_error").text("Email cant't be blank"); exit();
		}

		if(validateEmail($("#email_forgot").val()) !== true){
			$(".forgot_error").text("Wrong Email"); exit();
		}

		$.ajax('./ajax.php', {
		    type: 'POST',  // http method
		    data: { 
		    	mail: $("#email_forgot").val(),
		    	forgot: ''

    		},  // data to submit
		    success: function (data, status, xhr) {
		        info = JSON.parse(data);
		        if(info["success"] === true){
					$("#forgot_password").modal('hide');
					$("#forgot_passkey").modal('show');
					$("#forgot_email_copy").val( $("#email_forgot").val() );
		        }else{
		        	$(".forgot_error").text(info["error"]);
		        }
		    },
		    error: function (jqXhr, textStatus, errorMessage) {
		        
		    }
		});
	});

	$("#forget_key").click(function () {
		if($("#pass_key").val() == ""){
			$(".forgot_error").text("Code cant't be blank"); exit();
		}

		$.ajax('./ajax.php', {
		    type: 'POST',  // http method
		    data: { 
		    	code: $("#pass_key").val(),
		    	mail: $("#forgot_email_copy").val(),
		    	pass_key: ''

    		},  // data to submit
		    success: function (data, status, xhr) {
		        info = JSON.parse(data);
		        if(info["success"] === true){
					$("#forgot_passkey").modal('hide');
					$("#new_passkey").modal('show');
		        }else{
		        	$(".forgot_key_error").text(info["error"]);
		        }
		    },
		    error: function (jqXhr, textStatus, errorMessage) {
		        
		    }
		});
	});

	$("#new_pass_but").click(function () {
		if($("#pass_rep").val() == ""){
			$(".new_pass_error").text("Password cant't be blank"); exit();
		}if($("#pass2_rep").val() == ""){
			$(".new_pass_error").text("Password cant't be blank"); exit();
		}
		if($("#pass_rep").val() != $("#pass2_rep").val()){
			$(".new_pass_error").text("Password don't match"); exit();
		}

		$.ajax('./ajax.php', {
		    type: 'POST',  // http method
		    data: { 
		    	pass: $("#pass_rep").val(),
		    	new_pass: ''

    		},  // data to submit
		    success: function (data, status, xhr) {
		        info = JSON.parse(data);
		        if(info["success"] === true){
					$("#password_success").modal('show');
					$("#new_passkey").modal('hide');
		        }else{
		        	$(".forgot_key_error").text(info["error"]);
		        }
		    },
		    error: function (jqXhr, textStatus, errorMessage) {
		        
		    }
		});
	});


});

function logout() {
	$.ajax('./ajax.php', {
	    type: 'POST',  // http method
	    data: { 
	    	logout: ''

		},  // data to submit
	    success: function (data, status, xhr) {
        	$(".content").text("");
        	$(".login").html('<span data-toggle="modal" data-target="#login">Login</span>');
	    },
	    error: function (jqXhr, textStatus, errorMessage) {
	        
	    }
	});
}


function validateEmail($email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  return emailReg.test( $email );
}