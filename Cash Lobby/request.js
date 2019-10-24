$('#submit').click(function(){
   var amount=$('#amount').val();
   var type =$('#type').val();
   if(type=='P' || type=='A'){
   var email=$('#email').val();
   var password=$('#password').val();
   $.post('req.php',{amount:amount,type:type,email:email,password:password},function(data){
    $('#return').slideUp(20);
    if(data=='Request Sent') {
	$('#return').text(data);  
    $('#return').css('color','green');
	$('#return').slideDown('fast');
	
	} else{
    $('#return').text(data);  
    $('#return').css('color','red');
	$('#return').slideDown('fast');
	}
   })
  }else{
  alert('Please choose a valid payment type');
  }
})