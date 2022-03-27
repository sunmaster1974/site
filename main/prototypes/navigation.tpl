	<div id="navigation">

		<a class="modalbox form_link" href="#div_contact1">Заказать звонок1</a>
		<div id="div_contact1" style="display: none;">
			<form id="user_contact" name="user_contact" action="#" method="post">
				<div class="form_field">Имя1 </div>
				<input type="text" id="user_name" name="user_name" class="form_text required" title="Обязательное поле" /><br />
				<div class="form_field">Email </div>
				<input type="text" id="user_email" name="user_email" class="form_text required" title="Обязательное поле" /><br />
				<input type="hidden" name="form_name" value="Заявка на звонок" />
				<input type="hidden" name="user_time" value="yes" />
				<input type="hidden" name="user_agent" value="<?php echo $_SERVER['HTTP_USER_AGENT']; ?>" />
				<input type="hidden" name="user_ip" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>" />
				<input type="hidden" name="user_referrer" class="input_referrer" value='' />
				<input type="button" name="user_send" id="user_send" class="form_submit" value="Послать заявку" />
			</form>
		</div> <!-- #div_contact1 -->
	</div> <!-- #navigation -->