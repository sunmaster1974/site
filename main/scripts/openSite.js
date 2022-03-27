function openSite(page, type, href) {
	var result;
	
	$('#link_view').addClass('disabled');
	
	$.ajax({
	  method: "get",
	  async: false,
	  url: "index.php?page="+page+"&type="+type+"&step=create_site"
	})
	.done(function(data) {
		if (data.indexOf('class="error"') > -1) {
			var re = /message_text(.*?)\>(.*?)\<\/div\>/ig;
			var res = re.exec(data);
			
			var div = document.createElement('div');
			div.innerHTML = res[2];
			div.className = 'caption border message content';
			div.id = 'message_text';
			var width = $('#'+page).css('width');
			width = parseInt(width.replace(/px/i, '')) - 20;
			div.style.width = width + 'px';
			document.getElementById('center_panel').appendChild(div);
			result = false;
		} else {
			$('#link_view').attr('href', href);
			result = true;
		}
	});
	
	$('#link_view').removeClass('disabled');
	
	return result;
}