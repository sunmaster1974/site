var next_data_url;
var prev_data_url;
var next_data_cache;
var prev_data_cache;
var last_scroll = 0;
var is_loading  = 0;
var hide_on_load = false;

function loadFollowing() {
	if (next_data_url != "") {
		is_loading = 1;
		
		function showFollowing(data) {
			$('div.listitemblock:last').after(data.response);
			eval(data.script);
			
			next_data_url = data.next_data_url;
			next_data_cache = false;
			$.getJSON(next_data_url, function(preview_data) {
				next_data_cache = preview_data;
			});
		}

		if (next_data_cache) {
			showFollowing(next_data_cache);
			is_loading = 0;
		} else {
			$.getJSON(next_data_url, function(data) {
				showFollowing(data);
				is_loading = 0;
		  });
		}
	}
};

function loadPrevious() {
	if (prev_data_url != "") {
		is_loading = 1;
		
		function showPrevious(data) {
			$('div.listitemblock:first').before(data.response);
			eval(data.script);
			
			var block_height = $("div.listitemblock:first").height();
			window.scrollTo(0, $(window).scrollTop() + block_height);
			
			prev_data_url = data.prev_data_url;
			prev_data_cache = false;
			$.getJSON(prev_data_url, function(preview_data) {
				prev_data_cache = preview_data;
			});
			if (hide_on_load) {
				$(hide_on_load).hide();
				hide_on_load = false;
			}
		}
		
		if (prev_data_cache) {
			showPrevious(prev_data_cache);
			is_loading = 0;
		} else {
			$.getJSON(prev_data_url, function(data) {
				showPrevious(data);
				is_loading = 0;
			});
		}
	}
};

function mostlyVisible(element) {
	var scroll_pos = $(window).scrollTop();
	var win_height = $(window).height();
	var el_top 	   = $(element).offset().top;
	var el_height  = $(element).height();
	var el_bottom  = el_top + el_height;
	return ((el_bottom - el_height*0.25 > scroll_pos) && (el_top < (scroll_pos+0.5*win_height)));
}

function initBlock() {
	$(window).scroll(function() {
		var scroll_pos = $(window).scrollTop();
		var doc_height = $(document).height();
		var win_height = $(window).height();
		
		var h_top = 70;
		var h_bot = 0.9*(doc_height - win_height);
		
		if (is_loading == 0) {
			if (scroll_pos <= h_top) {
				loadPrevious();
			}
			if (scroll_pos >= h_bot) {
				loadFollowing();
			}
		}

		if (Math.abs(scroll_pos - last_scroll) > $(window).height()*0.1) {
			last_scroll = scroll_pos;
			$(".listitemblock").each(function(index) {
				if (mostlyVisible(this)) {
					var url = $(this).attr("data-url");
					url = url.replace(/item\.php\?block\=/g, "") + ".html";
					history.replaceState(null, null, url);
					return(false);
				}
			});
		}
	});
  
	$(document).ready(function () {
		if ($(window).height() > $("#listitems").height()) {
			if (next_data_url != "") {
				loadFollowing();
			} else {
				var filler = document.createElement("div");
				filler.id = "filler";
				filler.style.height = ($(window).height() - $("#listitems").height())+ "px";
				$("#listitems").after(filler);
				hide_on_load = "filler";
			}
		}
		if (prev_data_url != "") {
			loadPrevious();
		}
	});
}