$('#send').click(function(){
	var email=$('#email').val();
	var subject=$('#subject').val();
	var message=$('#message').val();
	if($('#reason').val()=='feedback'||$('#reason').val()=='report'){
	var reason=$('#reason').val();
	var link=$('#link').val();
	$.post('send.php',{reason:reason,link:link,email:email,subject:subject,message:message},function(data){
      if(data=='message sent'||data=='Report Sent'){
	    $('#check').slideUp('fast');
		$('#check').slideDown('fast');
		$('#red_x').hide();
		$('#return').css("color","green");
		$('#return').text(data);
		}else{
		$('#check').hide();
		$('#red_x').slideDown('fast');
		$('#return').css("color","red");
		$('#return').text(data);
		}
	})
    }else{
		alert('Please choose a reason');
	}
})
$('#reason').change(function(){
  if($('#reason').val()=='report'){
	$('#report_text').slideDown('fast');
  }else{
	$('#report_text').slideUp('fast');
	$('#link').value="";
  }
})