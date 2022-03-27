function FsitesMan() {
}

FsitesMan.prototype.onFaviconUpload = function(event, button) {
	if (!event.target.files[0].type.match(/^image\/(ico|x-icon|icon|vnd.microsoft.icon)/)) {
		alertDialog('Необходимо выбрать графический файл<br \/>с расширением ico.');
		return false;
	}
	if (event.target.files[0].size > 120*1024) {
		alertDialog('Необходимо выбрать графический файл<br \/>размером до 120 килобайт.');
		return false;
	}
	button.form.submit();
};

FsitesMan.prototype.onImageUpload = function(event, button) {
	if (!event.target.files[0].type.match(/^image\/(jpeg|jpg|gif|png|bmp)/)) {
		alertDialog('Необходимо выбрать графический файл<br \/>с расширением jpg, gif, png или bmp.');
		return false;
	}
	if (event.target.files[0].size > 1024*5*1024) {
		alertDialog('Необходимо выбрать графический файл<br \/>размером до 5 мегабайт.');
		return false;
	}
	button.form.submit();
};

FsitesMan.prototype.onFileUpload = function(event, button) {
	if (event.target.files[0].type.match(/(com|exe|bin|js|asp)/)) {
		alertDialog('Файлы с расширением com, exe, bin, js, asp<br \/>не разрешается закачивать.');
		return false;
	}
	button.form.submit();
};

window.sitesMan = new FsitesMan();