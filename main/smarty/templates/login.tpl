	<div id="top_caption" class="login_window text">
		Конструктор лендингов LandKit
	</div>
	
	<div class="login_window">
	{if $is_restore eq "true"}
		<div class="text caption">Восстановление пароля</div>
		<div id="icon_main">&nbsp;</div>
		<div class="window">
			<form action="index.php" method="post" name="restore_form">
			<table>
				<tr><td width="25%"><span class="text">Логин:</span></td><td><input class="input_text" name="user_login" type="text" value="{$user_login}" /></td></tr>
				<!--tr><td><span class="text">Email:</span></td><td><input class="input_text" name="user_email" type="text" value="{$user_email}" /></td></tr-->
				<tr><td>&nbsp;</td><td><input class="button_submit" type="submit" name="restore_submit" value="Выслать пароль" /></td></tr>
			</table>
			</form>
		</div>
	{/if}
	{if $is_restore eq "false"}<div class="text caption">Вход</div>
		<div id="icon_main">&nbsp;</div>
		<div class="window">
			<form action="index.php" method="post" name="login_form">
			<table>
				<tr><td width="25%"><span class="text">Логин:</span></td><td><input class="input_text" name="user_login" type="text" value="{$user_login}" /></td></tr>
				<tr><td><span class="text">Пароль:</span></td><td><input class="input_text" name="user_pass" type="password" /></td></tr>
				<tr><td>&nbsp;</td><td><input type="submit" name="login_submit" class="button_submit" value="Войти" /></td></tr>
			</table>
			</form>
			<div id="link_restore">
				<form action="index.php" method="post" name="show_restore_form">
					<input type="hidden" name="user_login" value="{$user_login}" />
					<input type="hidden" name="user_email" value="{$user_email}" />
					<input type="hidden" name="show_restore_submit" />
					<a href="#" class="links" onclick="document.show_restore_form.submit(); return false;">Восстановить пароль</a>
				</form>
			</div>		
		</div>
	{/if}
	{if $is_error != ""}
		<br />
		<div id="icon_info">&nbsp;</div>
		<div class="window">{$is_error}</div>
	{/if}<div id="bottom_caption">
			<a class="links" href="http://www.webvertex.ru">&#169;&nbsp;&nbsp;Студия веб-дизайна «WebVertex»</a>
		</div>
	</div>