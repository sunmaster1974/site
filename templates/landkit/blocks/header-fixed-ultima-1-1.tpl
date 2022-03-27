<!--Header-->
<header class="header" id="main">
	
	<div class="container">
		<div class="row">
			
			<div class="col-md-3">
				<a href="/6-mestnoe-taksi.php">
				<img class="logo2" src="{$string-50}" alt="VipTaxiSonata">
				</a>
			</div>

			<div class="col-md-6 text-center">
				<h1>Такси LARGUS Самара.</h1> <h2>Шестиместное такси по Самаре и области</h2>
			</div>
			
			<div class="col-md-3 text-center">				
					<h3><a href="tel:89277454232" style="color:#000;">8 927 745 42 32</a></h3>
					<h4 class="wow infinite pulse"><a class="btn btn-primary btn-block text-uppercase" href="#" data-toggle="modal" data-target="#loginModal">Заказать такси</a></h4> 

			</div>
		</div>
		
	</div>
	<div class="mainmenu">
		<div class="container">
			<ul class="nav">
				<li class="active"><a href="#main">Главная</a></li>
				<li><a href="#charts">Наши услуги</a></li>
				<li><a href="#pricing">Тарифы</a></li>
				<li><a href="#testimonials">Отзывы</a></li>
				<li><a href="#footer-custom">Контакты</a></li>
			</ul>
		</div>
	</div>
	
</header>

<!-- HTML code modal window-->
<div id="loginModal" class="modal fade">
	<div id="div_contact1">
  <div class="modal-dialog">
    <div class="modal-content">
      
		<div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        	<div class="h3 modal-title">Заказ такси</div>
     	</div>
      
		<div class="modal-body">
		  <form action="#" method="post" id="user_contact" name="user_contact">
			   <div class="form-group">
				<label class="sr-only" for="user_phone">Контактный телефон*</label>
				<input type="text" id="user_phone" name="user_phone" title="Обязательное поле" class="form-control input-lg input_text input_phone required" placeholder="Контактный телефон*">
			  </div>
			  
			  <div class="form-group">
				<label class="sr-only" for="user_from">Откуда*</label>
				<input type="text" id="user_from" name="user_from" title="Обязательное поле" class="form-control input-lg input_text required" placeholder="Откуда*">
			  </div>
			  
			  <div class="form-group">
				<label class="sr-only" for="user_to">Куда*</label>
				<input type="text" id="user_to" name="user_to" title="Обязательное поле" class="form-control input-lg input_text required" placeholder="Куда*">
			  </div>
			  
			  <div class="form-group">
				<label class="sr-only" for="user_date">Дата, время*</label>
				<input type="text" id="user_date" name="user_date" title="Обязательное поле" class="form-control input-lg input_text required" placeholder="Дата, время*">
			  </div>
			  
			<input type="hidden" name="form_name" value="Шестиместное такси (всплывающая форма)" />
			<input type="hidden" name="user_time" value="yes" />
			<input type="hidden" name="user_agent" value="yes" />
			<input type="hidden" name="user_ip" value="yes" />
			<input type="hidden" name="user_referrer" value="yes" />
			  
     		<button type="button" class="btn btn-danger btn-lg btn-block button_submit" name="user_send" id="user_send">Заказать такси</button>
		  </form>   
      </div>      
    </div>
  </div>
</div>
</div>