<!DOCTYPE html>
<html>
<head>
	<title>Bootstrap 1</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<style type="text/css">
		.red {
			color: white;
			background-color: red;
		}

		.green {
			color: white;
			background-color: green;
		}

		.blue {
			color: white;
			background-color: blue;
		}

	</style>
</head>
<body>

<div class="container-fluid ">
 	<h1>Bootstrap 01</h1>
 </div>

<div class="row justify-content-md-center" title="justify-content-md-center">
	<div class="col-xl-4 red" onclick="red();" id="r">Col 1</div>
	<div class="col-xl-4 green" onclick="green();" id="g">Col 2</div>
	<div class="col-xl-4 blue" onclick="blue();" id="b">Col 3</div>
</div>

<div class="row">
	<div class="col-sm-12" id="rgb">Hey</div>
</div>

</div>

</body>
<script type="text/javascript">
var Red = document.getElementById('r');
var Green = document.getElementById('g');
var Blue = document.getElementById('b');
var rgb = document.getElementById('rgb');

function red(){
	rgb.setAttribute('class','col-sm-12 red text-left');
}

function green(){
	rgb.setAttribute('class','col-sm-12 green text-center');
}

function blue(){
	rgb.setAttribute('class','col-sm-12 blue text-right');
}


</script>
<script type="text/javascript" src="css/bootstrap.min.js"></script>
</html>