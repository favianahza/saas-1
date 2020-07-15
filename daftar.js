
// DATEPICKER
$(document).ready(function(){
        setDatePicker()
        setDateRangePicker(".startdate", ".enddate")
        setMonthPicker()
        setYearPicker()
        setYearRangePicker(".startyear", ".endyear")
    })
    $(document).ready(function(){
  	$('[data-toggle="tooltip"]').tooltip();
});


// CHK BOX
var chck   = document.getElementById('nw-c');
var nw_i   = document.getElementById('nama-wali');
var uw_i   = document.getElementById('umur-wali');
var pw_i   = document.getElementById('pekerjaan-wali');
var ppw_i  = document.getElementById('pp-wali');
var agw_i  = document.getElementById('agama-wali');
var alw_i  = document.getElementById('alamat-wali');
var kpaw_i = document.getElementById('kode-pos-aw');
var tw_i   = document.getElementById('telepon-wali');

chck.addEventListener('click', function(){
	chck.classList.toggle('on');
	if( chck.classList.contains('on') ){
		nw_i.setAttribute("disabled", "");
		uw_i.setAttribute("disabled", "");
		pw_i.setAttribute("disabled", "");
		ppw_i.setAttribute("disabled", "");
		agw_i.setAttribute("disabled", "");
		alw_i.setAttribute("disabled", "");
		kpaw_i.setAttribute("disabled", "");
		tw_i.setAttribute("disabled", "");
		nw_i.setAttribute("value", "--");
		uw_i.setAttribute("value", "--");
		pw_i.setAttribute("value", "--");
		ppw_i.setAttribute("value", "--");
		alw_i.setAttribute("value", "--");
		kpaw_i.setAttribute("value", "--");
		tw_i.setAttribute("value", "--");

		var opt_nw = document.createElement("option");
		opt_nw.text = '--';
		opt_nw.classList.add('nw_option');
		agw_i.add(opt_nw);
		agw_i.getElementsByTagName('option')[5].selected = 'selected';


	} else {
		var opt_del = document.querySelector('.nw_option');
		opt_del.remove();
		agw_i.getElementsByTagName('option')[0].selected = 'selected';		

		nw_i.removeAttribute("disabled");
		uw_i.removeAttribute("disabled");
		pw_i.removeAttribute("disabled");
		ppw_i.removeAttribute("disabled");
		agw_i.removeAttribute("disabled");
		alw_i.removeAttribute("disabled");
		kpaw_i.removeAttribute("disabled");
		tw_i.removeAttribute("disabled");
		nw_i.removeAttribute("value");
		uw_i.removeAttribute("value");
		pw_i.removeAttribute("value");
		ppw_i.removeAttribute("value");
		agw_i.removeAttribute("value");
		alw_i.removeAttribute("value");
		kpaw_i.removeAttribute("value");
		tw_i.removeAttribute("value");
	}
});

// SHOW PASSWORD
var spc = document.getElementById('spc');
var password = document.getElementById('password');
var kpassword = document.getElementById('kpassword');

spc.addEventListener('click', function(){
	spc.classList.toggle('sh');
	if ( spc.classList.contains('sh') ) {
		password.type = 'text';
		kpassword.type = 'text';
	} else{
		password.type = 'password';
		kpassword.type = 'password';
	}
});


// PREVIEW PICT
function triggerClick() {
	document.getElementById('foto').click();
}

function preview(e) {
	if(e.files[0]){
		var reader = new FileReader();

		reader.onload = function(e) {
			document.getElementById('preview-img').setAttribute('src', e.target.result);
		}
		reader.readAsDataURL(e.files[0]);
	}
}


