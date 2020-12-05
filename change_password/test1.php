<!DOCTYPE HTML>
<html>
<head>
<title>Password strength checker in jQuery</title>
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script><!-- jQuery Library-->
<style>
body{
margin: 0;
padding: 0;
font-family: 'Raleway', sans-serif;
font-size: 15px;
line-height: 1.5;
}
#container {
width: 535px;
background: #ffffff;
padding: 20px;
margin: 90px auto;
border-radius: 5px;
height: 150px;
border: 2px solid gray;
}
#header {
text-align: center;
background-color: #FEFFED;
border-radius: 5px;
margin: -39px -20px 10px -20px;
}
h2{
padding-top: 10px;
}
#content {
margin-left: 57px;
margin-top: 40px;
}
#register label{
margin-right:5px;
}
#register input {
padding: 5px 14px;
border: 1px solid #d5d9da;
box-shadow: 0 0 9px #0E34F5 inset;
width: 272px;
font-size: 1em;
height: 25px;
}
#register .short{
font-weight:bold;
color:#FF0000;
font-size:larger;
}
#register .weak{
font-weight:bold;
color:orange;
font-size:larger;
}
#register .good{
font-weight:bold;
color:#2D98F3;
font-size:larger;
}
#register .strong{
font-weight:bold;
color: limegreen;
font-size:larger;
}
</style>
</head>
<body>
<div id="container">
<div id="header">
<h2>Password Strength Checking with jQuery</h2>
<hr>
</div>
<div id="content">
<form id="register">
<label for="password"><b>Password : </b></label>
<input name="password" id="password" maxlength="8" type="password" placeholder="Type Your Password here"/>&nbsp;&nbsp;
<span id="result"></span>
</form>
</div>
</div>
</body>
</html>
<script>
$(document).ready(function() {
$('#password').keyup(function() {
$('#result').html(checkStrength($('#password').val()))
})
function checkStrength(password) {
var strength = 0
if (password.length < 6) {
$('#result').removeClass()
$('#result').addClass('short')
return 'Too short'
}
if (password.length > 7) strength += 1
// If password contains both lower and uppercase characters, increase strength value.
if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) strength += 1
// If it has numbers and characters, increase strength value.
if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) strength += 1
// If it has one special character, increase strength value.
if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
// If it has two special characters, increase strength value.
if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
// Calculated strength value, we can return messages
// If value is less than 2
if (strength < 2) {
$('#result').removeClass()
$('#result').addClass('weak')
return 'Weak'
} else if (strength == 2) {
$('#result').removeClass()
$('#result').addClass('good')
return 'Good'
} else {
$('#result').removeClass()
$('#result').addClass('strong')
return 'Strong'
}
}
});
</script>