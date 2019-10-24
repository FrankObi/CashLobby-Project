$('#login_text').click(function(){
	if(this.value=="Username"){
	this.value="";
  }
});
$('#login_text').blur(function(){
	if(this.value==''){
	this.value="Username";
  }
});
$('#login_textpass').click(function(){
	if(this.value=="Password"){
	this.value="";
  }
});
$('#login_textpass').blur(function(){
	if(this.value==''){
	this.value="Password";
  }
});
$(document).ready(function() {
$('#menu_list').slideDown('slow');
});

$('#rename_file').click(function() {
$('#rename_box').fadeIn('slow');
});

$('#close_rename').click(function() {
$('#rename_box').fadeOut('fast');
});

$('#rename_button').click(function() {
    var name=$('#rename_text').val();
	if(name.length<=50){
	$.post('rename.php',{name:name},function(data){
	$('#new_name').text('file name: '+name);
	$('#rename_box').fadeOut('fast');
	$('#long').text('');
  });
 }else{
   alert('file name is too long');
 }
});
$('#close_forgot').click(function(){
	$('#forgot_box').slideUp('fast');
});

$('#forgot').click(function(){
	$('#forgot_box').slideDown('fast');
});

$('#forgot_button').click(function(){
 var email=$('#forgot_text').val();
	$.post('forgot.php',{email:email},function(data){
		if(data.indexOf('Invalid Email Address')!=1){
			if(data.indexOf('There is no user registered with that email')!=1){
			
			}else{
			alert('There is no user registered with that email');
			}
		}else{
		alert('Invalid Email Address');
		}
	})
});






