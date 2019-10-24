 $('#username').blur(function(){
 var username=$('#username').val();
   if(username!=''){
    $.post('register_form.php',{username:username},function(data){
	   if(data.indexOf('Username Available')!==-1){
		$('#username1').css('color','green');
     	$('#username1').text('Username Available');
		}else{
		$('#username1').css('color','red');
     	$('#username1').text('Username Unavailable');
		}
	})
   }
 })

  $('#email').blur(function(){
   var email=$('#email').val();
   if(email!=''){
    $.post('register_form.php',{email:email},function(data){
	   if(data.indexOf('Email Available')!==-1){
		$('#email1').css('color','green');
     	$('#email1').text('Email Available');
		}else{
		if(data.indexOf('Invalid Email Address')!==-1){
			$('#email1').css('color','red');
			$('#email1').text('Invalid Email Address');
			}else{
			$('#email1').css('color','red');
			$('#email1').text('Email already registered');
			}
		}
	})
   }
 })
 
    $('#password').blur(function(){
    if($('#password1').val()!=''){
	  if($('#password').val()!=$('#password1').val()){
		$('#password_check').css('color','red');
		$('#password_check').text('Passwords do not Match');
	  }else{
		$('#password_check').css('color','green');
		$('#password_check').text('Passwords Match');
	  }
	}else{
		$('#password_check').text('');
	}
 })
 
  $('#password1').blur(function(){
  if($('#password').val()!=''){
	  if($('#password').val()!=$('#password1').val()){
		$('#password_check').css('color','red');
		$('#password_check').text('Passwords do not Match');
	  }else{
		$('#password_check').css('color','green');
		$('#password_check').text('Passwords Match');
	  }
	}else{
	   $('#password_check').text('');
	}
 })
  
  $('#number').blur(function(){
  var number=$('#number').val();
  if(!parseFloat(number)){
  $('#number1').css('color','red');
  $('#number1').text('Please enter a valid contact number');
  }else{
  $('#number1').text('');
  }
 })
