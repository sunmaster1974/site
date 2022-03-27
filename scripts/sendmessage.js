function verifyValue(fieldId, text, field2Id) {
	var field = $(fieldId);
	if (field.length) {
		if (field.hasClass("required")) {
			var value = field.val().replace(/\s/g, "");
			if (value.length == 0) {
				if (fieldId.indexOf("permail") > -1) {
					var value2 = $(field2Id).val().replace(/\s/g, "");
					if (value2.length == 0)	alert(text);
				}
				else {
					alert(text);
				}
				return false;
			} else {
				if (fieldId.indexOf("email") > -1) {
					var re = /.+@.+\..+/i;
					if (!re.test(value)) {
						alert("Введён некорректный электронный адрес");
						return false;
					}
				}
				if (fieldId.indexOf("phone") > -1) {
					var str = value.replace(/\D/img, "");
					if (str.length < 7) {
						alert('В номере телефона должно быть не менее семи цифр');
						return false;
					} else {
						if (
							(str.length == 7) || 
							(str.length == 10)  || 
							((str.length == 11) && ((str[0] == '7') || ((str[0] == '8'))))
							) {
							} else {
								alert('В номере телефона должно быть 7, 10 или 11 цифр');							
								return false;
							}
					}
				}
			}	
		}
	}
	return true;
}

function sendMessage(id) {
	$(id+" #user_contact").submit(function() {
		return false;
	});
	
	$(id + " #user_send").on("click", function() {
		var display = $(id).css("display");
		
		if (!verifyValue(id+" #user_phone", "Заполните, пожалуйста, поле «Контактный телефон»!")) return;
		if (!verifyValue(id+" #user_from", "Заполните, пожалуйста, поле «Откуда»!")) return;
		if (!verifyValue(id+" #user_to", "Заполните, пожалуйста, поле «Куда»!")) return;
		if (!verifyValue(id+" #user_date", "Заполните, пожалуйста, поле «Дата, время»!")) return;
		if (!verifyValue(id+" #user_childs", "Заполните, пожалуйста, поле «Количество детей до 7 лет»!")) return;
		if (!verifyValue(id+" #user_adults", "Заполните, пожалуйста, поле «Количество взрослых»!")) return;
		
		$(id+" #user_send").replaceWith("<div id='sending'>Идёт отправка...</div>");
		
		var messageSuccess, messageError;
		messageSuccess = "<div id='send_success'>Спасибо за обращение!<br />Ваша заявка успешно отправлена.</div>";
		messageError   = "<div id='send_error'>Извините, Ваша заявка не может быть отправлена.<br />Попробуйте, пожалуйста, позже!</div>";
				
		$.ajax({
			type: 'POST',
			url: 'http://taxilargus.ru/scripts/sendmessage.php',
			data: $(id + " #user_contact").serialize(),
			success: function(data) {
				if (data == "true") {
					if (display == "none") {
						$(id + " #user_contact").fadeOut("fast", function() {
							$(this).before(messageSuccess);
						});
					}
					if (display == "block") {
						$(id + " #sending").replaceWith(messageSuccess);
					}
				}
			},
			error: function(msg) {
				var textError = "<div id='send_error'>Произошла ошибка при отправке: " + JSON.stringify(msg) + "</div>";
				if (display == "none") {
					$(id + " #user_contact").fadeOut("fast", function() {
						$(this).before(textError);
					});
				}
				if (display == "block") {
					$(id + " #sending").replaceWith(textError);
				}
			}
		});
	});
}