<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<title>Выбор цвета</title>
	<link type="text/css" rel="stylesheet" href="css_generator.css" />
	<style type="text/css">
	.button_ok {
		min-width: 110px;
		height: 26px;
		background-color: #FDEFDF;
		border: 1px solid #DCDCDC;
		border-radius: 4px;
		-moz-border-radius: 4px;
		-webkit-border-radius: 4px;
		box-shadow: 1px 1px 0px 0px Gainsboro;
		-moz-box-shadow: 1px 1px 0px 0px Gainsboro;
		-webkit-box-shadow: 1px 1px 0px 0px Gainsboro;
		cursor: pointer;
		font-family: Georgia, "Century Schoolbook L", serif;
		font-size: 14px;
		color: Peru;
		text-align: center;
		text-shadow: 1px 1px Gainsboro;
	}
	</style>
	<script type="text/javascript">
<!--
var i;
var detail = 30;
var strhex = "0123456789ABCDEF";
function dechex(n) {
	return strhex.charAt(Math.floor(n/16)) + strhex.charAt(n%16);
}
function mouseClick(e) {
	x = e.offsetX ? e.offsetX : e.clientX-e.target.x;
	y = e.offsetY ? e.offsetY : e.clientY-e.target.y;
	
	var part_width = document.all ? document.all.color_picker.width/6 : document.getElementById('color_picker').width/6;
	var part_detail = detail/2;
	var im_height = document.all ? document.all.color_picker.height : document.getElementById('color_picker').height;
	var red = (x >= 0)*(x < part_width)*255 + (x >= part_width)*(x < 2*part_width)*(2*255 - x * 255 / part_width) + (x >= 4*part_width)*(x < 5*part_width)*(-4*255 + x * 255 / part_width) + (x >= 5*part_width)*(x < 6*part_width)*255;
	var blue = (x >= 2*part_width)*(x < 3*part_width)*(-2*255 + x * 255 / part_width) + (x >= 3*part_width)*(x < 5*part_width)*255 + (x >= 5*part_width)*(x < 6*part_width)*(6*255 - x * 255 / part_width);
	var green = (x >= 0)*(x < part_width)*(x * 255 / part_width) + (x >= part_width)*(x < 3*part_width)*255 + (x >= 3*part_width)*(x < 4*part_width)*(4*255 - x * 255 / part_width);
	var coef = (im_height-y)/im_height;
	
	red = 128+(red-128)*coef;
	green = 128+(green-128)*coef;
	blue = 128+(blue-128)*coef;

	changeFinalColor(dechex(red) + dechex(green) + dechex(blue));

	for (i = 0; i < detail; i++) {
		if ((i >= 0) && (i < part_detail)) {
			var final_coef = i/part_detail ;
			var final_red = dechex(255 - (255 - red) * final_coef);
			var final_green = dechex(255 - (255 - green) * final_coef);
			var final_blue = dechex(255 - (255 - blue) * final_coef);
		} else {
			var final_coef = 2 - i/part_detail ;
			var final_red = dechex(red * final_coef);
			var final_green = dechex(green * final_coef);
			var final_blue = dechex(blue * final_coef); }
		color = final_red + final_green + final_blue ;
		document.all ? document.all('gs'+i).style.backgroundColor = color : document.getElementById('gs'+i).style.backgroundColor = color;
	}
}
	
function changeFinalColor(color) {
	document.getElementById('body').style.backgroundColor = color;
}

function sendColor() {
	if (window.opener) {
		var new_color = document.getElementById('body').style.backgroundColor;
		exp_rgb = new RegExp("rgb","g");
		if (exp_rgb.test(new_color)) {
			exp_extract = new RegExp("[0-9]+","g");
			var tab_rgb = new_color.match(exp_extract);
			new_color = dechex(parseInt(tab_rgb[0]))+dechex(parseInt(tab_rgb[1]))+dechex(parseInt(tab_rgb[2]));
		}
		new_color = new_color.toUpperCase();
		var reg = new RegExp("#", "g"); 
		new_color = new_color.replace(reg, "");
		window.opener.document.forms['jg_form'].elements['<?=$_GET["name"]?>'].value = new_color;		
		window.opener.document.forms['jg_form'].elements['<?=$_GET["name"]?>'].onchange();
		window.opener.focus();
		window.close();
		//window.open(window.location, '_self').close();
	}
}
window.focus();
//-->
</script>
</head>
<body id="body" style="background-color: <?='#'.$_GET["color"]?>">
<form id="colpick_form" action="#" method="post">	
	<table id="colors">
		<tr>
			<td style="height: 50px;">&nbsp;</td>
			<td rowspan="3">
<script type="text/javascript">
<!--
document.write('<table id="shades">');
for (i = 0; i < detail; i++) {
	document.write('<tr><td id="gs'+i+'" style="background-color: #000; width: 20px; height: 3px; border-style: none; border-width: 0px;" onclick="changeFinalColor(this.style.backgroundColor)"><\/td><\/tr>');
}
document.write('<\/table>');
//-->
</script>
				</td>
		</tr>
		<tr>
			<td><img id="color_picker" src="color_picker.jpg" alt="Палитра" onclick="mouseClick(event);" /></td>
		</tr>	
		<tr>
			<td style="text-align: center;"><br /><input type="button" class="button_ok" name="btn_ok" value="Выбрать" onclick="sendColor();" /></td>
		</tr>
	</table>	
</form>
</body>
</html>