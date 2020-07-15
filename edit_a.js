var chck = document.getElementById('show');
var pass = document.getElementById('pass');
var cpass = document.getElementById('cpass');

chck.addEventListener('click', function(){
	chck.classList.toggle('show');
	if( chck.classList.contains('show') ){
		pass.type = 'text';
		cpass.type = 'text';
	} else {
		pass.type = 'password';
		cpass.type = 'password';
	}
});