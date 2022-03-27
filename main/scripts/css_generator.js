function jg() { /* Fonction antibug */ }
function setEqualHeightContent() {
	var tallestColumn = 0;
	var action, currentHeight, paddingTop, paddingBottom, paddingTopTallest, paddingBottomTallest, newHeight;
		
	var list = document.getElementsByClassName('content'); 
	for (var i = 0; i < list.length; i++) {
		paddingTop    = parseInt(list[i].style.paddingTop);
		paddingBottom = parseInt(list[i].style.paddingBottom);
		currentHeight = parseInt(list[i].style.height);
		if (currentHeight > tallestColumn) {
			tallestColumn        = currentHeight;
			paddingTopTallest    = paddingTop;
			paddingBottomTallest = paddingBottom;
		}	
	}
		
	for (i = 0; i < list.length; i++) {
		currentHeight = parseInt(list[i].style.height);		
		if (currentHeight < tallestColumn) {
			newHeight = tallestColumn + paddingTopTallest + paddingBottomTallest;
			action = "document.getElementById('"+list[i].id+"').style.height='"+newHeight+"px';";			
		} else {
			action = "document.getElementById('"+list[i].id+"').style.height='"+tallestColumn+"px';";
		}		
		eval(action);
    }
}
function jg_popicker(color_value, color_name) {
	window.open('color_picker.php?color='+color_value+'&name='+color_name, 'cp', 'width=400, height=270, menubar=no, toolbar=no, location=no, directories=no, status=no, resizable=no, scrollbars=no');
}
function aptag(tagName, styleName, styleValue) {
	var action = "var list = document.getElementsByTagName('"+tagName+"'); for (var i = 0; i < list.length; i++) { list[i].style."+styleName+"='"+styleValue+"'; }";
	eval(action);
}
function apid(id, styleName, styleValue) {
	var action = "document.getElementById('"+id+"').style."+styleName+"='"+styleValue+"';";	
	eval(action);
}
function apidch(id, check, styleName, styleValue1, styleValue2) {
	if (check===false) { apid(id, styleName, styleValue2) }
	else { apid(id, styleName, styleValue1) }
}
function apcl(className, styleName, styleValue) {
	var action = "var list = document.getElementsByClassName('"+className+"'); for (var i = 0; i < list.length; i++) { list[i].style."+styleName+"='"+styleValue+"'; }";
	eval(action);	
}
function apclch(className, check, styleName, styleValue1, styleValue2) {
	if (check===false) { apcl(className, styleName, styleValue2) }
	else { apcl(className, styleName, styleValue1) }
}
function apv(id, value) {
	document.getElementById(id).value = value;
}
function apvch(id, check, value1, value2) {
	if (check===false) { apv(id, value2) }
	else { apv(id, value1) }
}
function apclu(className) {
	var list = document.getElementsByClassName(className);
	
	eval("var borderStyle = document.getElementById('aBorderStyle').value; var borderColor = document.getElementById('aBorderColor').value; var borderWidth = document.getElementById('aBorderWidth').value;");
	
	switch (borderStyle) {
		case "none": // Подчёркивание отсутствует
			for (var i = 0; i < list.length; i++) {
				list[i].style.textDecoration = "none";
				list[i].style.borderBottom   = "medium none #000";
			}
			break;
		case "normal": // Обычная линия ссылки
			for (var i = 0; i < list.length; i++) {
				list[i].style.textDecoration = "underline";
				list[i].style.borderBottom   = "medium none #000";
			}
			break;
		default: // Линия сплошная, пунктиром или точками
			for (var i = 0; i < list.length; i++) {
				list[i].style.textDecoration = "none";
				list[i].style.borderBottom   = borderWidth + ' ' + borderStyle + ' ' + borderColor;
			}
	}
}
var hexa = new Array('0','1','2','3','4','5','6','7','8','9','A','B','C','D','E','F');
function generate(hexacolor, r,v,b, name) {
	var rvb = new Array(r,r,v,v,b,b);
	var curseur = 0;
	var hexacolor2 = "";
	for (g = 0; g < 6; g++) {
		for (i = 0; i <= 15; i++) {
			if (hexacolor.substring(curseur, curseur+1) == hexa[i]) {
				var nrvb = eval(i+rvb[g]);
				if (nrvb < 0) { hexacolor2 += '0'; }
				else if (nrvb > 15) { hexacolor2 += 'F'; }
				else { hexacolor2 += hexa[nrvb]; }
				curseur++; 
				break;
			}
		}
	}
	
	eval("document.jg_form."+name+".value='"+hexacolor2+"'; document.jg_form."+name+".onchange();");	
}
function generateall(color, s, rand) {
	var p, m;	
	
	color = (rand==1) ? hexa[Math.floor(Math.random()*15)+1]+hexa[Math.floor(Math.random()*15)+1]+hexa[Math.floor(Math.random()*15)+1]+hexa[Math.floor(Math.random()*15)+1]+hexa[Math.floor(Math.random()*15)+1]+hexa[Math.floor(Math.random()*15)+1] : color.toUpperCase();	
	
	if (s == 0) {
		p = "+";
		m = "-";
	} else {
		p = "-";
		m = "+";
	}
	
	generate(color, p+'0', p+'0', p+'0', "color_dominante"); // Цвет фона
	generate(color, m+'7', m+'7', m+'7', "color_txt"); // Цвет текста	
	generate(color, p+'7', p+'7', p+'7', "color_titres"); // Цвет заголовков

	generate(color, m+'6', m+'6', m+'6', "color_link"); // Цвет шрифта ссылки ненаведённой
	generate(color, m+'5', m+'5', m+'5', "color_underlink"); // Цвет подчёркивающей линии ненаведённой ссылки
	generate(color, m+'1', m+'1', m+'1', "bgcolor_link"); // Подсвечивание ненаведённой ссылки
	generate(color, m+'4', m+'4', m+'4', "color_hoverlink"); // Цвет шрифта ссылки наведённой
	generate(color, p+'5', p+'5', p+'5', "color_underhoverlink"); // Цвет подчёркивающей линии наведённой ссылки
	generate(color, p+'1', p+'1', p+'1', "bgcolor_hoverlink"); // Подсвечивание наведённой ссылки
	
	document.getElementById("bgcolor_link_no").checked = "checked"; // Отсутствует подсвечивание простой ссылки
	document.getElementById("bgcolor_link_no").onclick();
	document.getElementById("bgcolor_hoverlink_no").checked = "checked"; // Отсутствует подсвечивание простой ссылки при наведении мыши
	document.getElementById("bgcolor_hoverlink_no").onclick();
	
	backch("example", "no", "");
}
function rgbch(name, mode) {
	var value  = "document.jg_form."+name+".value";	
	switch (mode) {
		case "r+":
			generate(eval(value), '+1','+0','+0', name); 
			break;
		case "r-":
			generate(eval(value), '-1','+0','+0', name); 
			break;
		case "g+":
			generate(eval(value), '+0','+1','+0', name); 
			break;
		case "g-":
			generate(eval(value), '+0','-1','+0', name); 
			break;
		case "b+":
			generate(eval(value), '+0','+0','+1', name); 
			break;
		case "b-":
			generate(eval(value), '+0','+0','-1', name); 
			break;
	}
}
function getNumber(lettre) {
	var hexa = new Array('0','1','2','3','4','5','6','7','8','9','A','B','C','D','E','F');
	for (var i = 0; i < 16; i++) {
		if (lettre == hexa[i]) return i;
	}
}
function opasch(name, mode, id) {
	var color16, opacity, iRed, iGreen, iBlue, rgba, extra;
	var iOpacity = 1;
	var iOpacity_new = 1;
	
	var action = "color16 = document.jg_form."+name+".value; opacity = document.jg_form.o_"+name+".value;";
	eval(action);
	
	iOpacity = parseFloat(opacity, 10) * 10;
	
	action = "iOpacity_new = " + iOpacity + mode + "1;";
	eval(action);	

	if (iOpacity_new < 0)  iOpacity_new = 0;
	if (iOpacity_new > 10) iOpacity_new = 10;
	
	if (iOpacity_new == 10) opacity = "1" 
		else if (iOpacity_new == 0) opacity = "0" 
		else opacity = "0." + iOpacity_new;
		
	iRed   = getNumber(color16.substring(0,1))*16 + getNumber(color16.substring(1,2));
	iGreen = getNumber(color16.substring(2,3))*16 + getNumber(color16.substring(3,4));
	iBlue  = getNumber(color16.substring(4,5))*16 + getNumber(color16.substring(5,6));

	if (iOpacity_new == 0) extra = " document.jg_form.no_" + name + ".checked = true;"
		else extra = " document.jg_form.no_" + name + ".checked = false;"
	rgba   = 'rgba('+iRed+', '+iGreen+', '+iBlue+', '+opacity+')';
	action = "document.getElementById('"+id+"').style.backgroundColor='"+rgba+"'; document.jg_form.o_"+name+".value='"+opacity+"';" + extra;
	eval(action);
}
function sizech(name, mode, onlyPositive) {
	if (onlyPositive == undefined) onlyPositive = true;
		
	var sizepx = '';
	var action = "sizepx = document.jg_form."+name+".value";
	eval(action);
		
	var size = sizepx.replace(/px/i, '');
	var size_new = 0;
	action = "size_new = " + size + mode + "1;";
	eval(action);
	
	if (onlyPositive)
		if (size_new < 0) size_new = 0;
	if (size_new > 999) size_new = 999;
	
	action = "document.jg_form."+name+".value='"+size_new+"px'; document.jg_form."+name+".onchange()";
	eval(action);
}
function computedStyle(id, property) {
	var compStyle;
	var element = document.getElementById(id);
	if (getComputedStyle) {
		compStyle = getComputedStyle(element, '');
	} else {
		compStyle = element.currentStyle;
	}
	var result;
	switch (property) {
		case "height":
						result = compStyle.height;
						break;
		case "width" :
						result = compStyle.width;
						break;
		case "marginLeft":
						result = compStyle.marginLeft;
						break;
		case "marginRight":
						result = compStyle.marginRight;
						break;
	}
	return result;
}
function fontch(name, mode) {
	var sizepx = '';
	var action = "sizepx = document.jg_form."+name+".value";
	eval(action);
		
	var size = sizepx.replace(/px/i, '');
	var size_new = 0;
	action = "size_new = " + size + mode + "1;";
	eval(action);
	
	if (size_new < 0)  size_new = 0;
	if (size_new > 99) size_new = 99;
	
	action = "document.jg_form."+name+".value='"+size_new+"px'; document.jg_form."+name+".onchange()";
	eval(action);
}
function logoch(value) {
	var action;
	if (value == 'no') {
		action = "document.getElementById('slogo').style.backgroundImage = 'none'; parent.frames['tp'].window.document.jg_form.width_sitelogo.value  = '0px';	parent.frames['tp'].window.document.jg_form.height_sitelogo.value = '0px';";
		eval(action);
	} else {
		var url = 'url("/images/'+value+'")';
		var img = new Image();
		img.src = '/images/' + value;
		img.onload = function() {
			action = "var divLogo = document.getElementById('slogo'); divLogo.style.backgroundImage = '" + url + "'; divLogo.style.backgroundRepeat = 'no-repeat'; divLogo.style.width = '" + this.width + "px'; divLogo.style.height = '" + this.height + "px'; parent.frames['tp'].window.document.jg_form.width_sitelogo.value  = '" + this.width + "px';	parent.frames['tp'].window.document.jg_form.height_sitelogo.value = '" + this.height + "px';";
			eval(action);
		};
	}
}
function backch(id, value, repeatValue) {
	if (value == 'no') {
		eval("document.getElementById(id).style.backgroundImage='none';");
	} else {
		eval("document.getElementById(id).style.backgroundImage='url(" + value + ")'; document.getElementById(id).style.backgroundRepeat='" + repeatValue + "';");
	}
}
function shadch(object) {
	var bNoChecked = false;
	var sColor = '666';
	var iShadowShiftX = '2px';
	var iShadowShiftY = '2px';
	var iShadowBlur   = '0px';
		
	var action = "bNoChecked = document.jg_form."+object+"_shadow_no.checked; sColor = document.jg_form."+object+"_shadow.value; iShadowShiftX = document.jg_form."+object+"_shadow_shiftx.value; iShadowShiftY = document.jg_form."+object+"_shadow_shifty.value; iShadowBlur = document.jg_form."+object+"_shadow_blur.value;";
	eval(action);
	
	if (!bNoChecked) {
		if (object == "text")  apid('example', 'textShadow', iShadowShiftX+' '+iShadowShiftY+' '+iShadowBlur+' #'+sColor);
		if (object == "title") apcl('titles', 'textShadow', iShadowShiftX+' '+iShadowShiftY+' '+iShadowBlur+' #'+sColor);
	} else {
		if (object == "text")  apid('example', 'textShadow', 'none');
		if (object == "title") apcl('titles', 'textShadow', 'none');
	}
}
function radch(id) {
	var bChecked = false;
	var clColor = '666';
	var iShadowShiftX = '0px';
	var iShadowShiftY = '0px';
	var iShadowBlur   = '5px';
	var iShadowSpread = '5px';
	var iRadius = '5px';
	var bShadowInset = false;
	
	var action = "bChecked = document.jg_form."+id+"_corners.checked; clColor = document.jg_form."+id+"_color_corners.value; iRadius = document.jg_form."+id+"_radius.value; iShadowShiftX = document.jg_form."+id+"_shadow_shiftx.value; iShadowShiftY = document.jg_form."+id+"_shadow_shifty.value;	iShadowBlur = document.jg_form."+id+"_shadow_blur.value; iShadowSpread = document.jg_form."+id+"_shadow_spread.value; bShadowInset = document.jg_form."+id+"_shadow_inset.checked;";
	eval(action);
	
	sShadowInset = '';
	if (bShadowInset) sShadowInset = 'inset';
		
	if (bChecked) {
		apid(id, 'boxShadow', iShadowShiftX+' '+iShadowShiftY+' '+iShadowBlur+' '+iShadowSpread+' #'+clColor+' '+sShadowInset);
		apid(id, 'borderRadius', iRadius);
	} else {
		apid(id, 'boxShadow', 'none');
		apid(id, 'borderRadius', '0px');
	}
}
function widthch(id, value) {
	var action, paddingLeft, paddingRight, margin;
	
	action = "paddingLeft  = document.getElementById('" + id + "').style.paddingLeft; paddingRight = document.getElementById('" + id + "').style.paddingRight;";
	eval(action);	

	if (id == "colmn1") {
		margin = "marginLeft";
	}
	if (id == "colmn2") {
		margin = "marginRight";
	}

	var newWidth = parseInt(value) + parseInt(paddingLeft) + parseInt(paddingRight);
	apid(id, "width", value);
	apid('center1', margin, newWidth + 'px');
}
function padhorzch(id, style, value) {
	var action, paddingStyle, paddingValue, marginStyle, marginValue, name;
	
	if (id == "colmn1") {
		marginStyle = "marginLeft";
		name = "left_width";
	}
	if (id == "colmn2") {
		marginStyle = "marginRight";
		name = "right_width";
	}
	if (style == "paddingLeft") {
		paddingStyle = "paddingRight";
	}
	if (style == "paddingRight") {
		paddingStyle = "paddingLeft";
	}
		
	action = "paddingValue = document.getElementById('" + id + "').style." + paddingStyle + "; marginValue = document.getElementById('center1').style." + marginStyle + ";";
	eval(action);
	
	var newWidth = parseInt(marginValue) - parseInt(value) - parseInt(paddingValue);
	apid(id, style, value);
	apid(id, "width", newWidth + 'px');
	
	action = "parent.frames['tp'].window.document.jg_form." + name + ".value='" + newWidth + "px'";
	eval(action);
}
function indexch(name, mode) {
	var value = "";
	var action = "value = document.jg_form." + name + ".value";
	eval(action);
	
	if ((value == "") || (value == undefined)) {
		value = "0";
	}
		
	var value_new = 0;
	action = "value_new = " + value + mode + "1;";
	eval(action);
		
	action = "document.jg_form." + name + ".value='" + value_new + "'; document.jg_form." + name + ".onchange()";
	eval(action);
}