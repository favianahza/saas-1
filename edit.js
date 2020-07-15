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


// IS INPUT NUMBER ?
 function isInputNumber(evt){
                
    var ch = String.fromCharCode(evt.which);
            
        if(!(/[0-9]/.test(ch))){
        evt.preventDefault();
    }                
}