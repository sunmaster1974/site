<?php require "/home/taxilargus/web/taxilargus.ru/public_html/main/session_db.php"; ?><!doctype html>
<html lang="ru">
<head>
	<meta charset="utf-8" />
	<meta name="generator" content="WebWertex LandKit (Landing page constructor 1.0)" />
	<meta name="description" content="Мы оказываем услуги по перегону Вашего авто, если вы не можете водить автомобиль. Кроме того, услуга «Трезвый водитель» в Самаре работает круглосуточно, и вы сможете в любое время обратиться за профессиональной помощью" />
	<meta name="keywords" content="такси LARGUS Самара услуга трезвый водитель самара" />

	<title>Мы оказываем услуги по перегону Вашего авто, если вы не можете водить автомобиль. Кроме того, услуга «Трезвый водитель» в Самаре работает круглосуточно, и вы сможете в любое время обратиться за профессиональной помощью</title>


	<link type="image/x-icon" href="templates/landkit/favicon-6--2.ico" rel="shortcut icon" />
	<link type="image/x-icon" href="templates/landkit/favicon-6--2.ico" rel="icon" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	
	<!--Google Fonts-->
	<link href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700&subset=latin,cyrillic" rel="stylesheet" type="text/css">
	<!--Bootstrap 3.3.2-->
	<link href="styles/bootstrap.min.css" rel="stylesheet" media="screen">
	<!--Icon Fonts-->
	<link href="styles/font-awesome.min.css" rel="stylesheet" media="screen">
	<link href="styles/icon-moon.css" rel="stylesheet" media="screen">
	<!--Animations-->
	<link href="styles/animate.css" rel="stylesheet" media="screen">
	<!--Theme Styles-->
	<link href="styles/theme-styles.css" rel="stylesheet" media="screen">
	<!--Color Schemes-->
	<link href="styles/colors/color-default.css" class="color-scheme" rel="stylesheet" media="screen">
	<!--Modernizr-->
	<script src="scripts/libs/modernizr.custom.js"></script>
	<link type="text/css" href="scripts/lightbox/css/lightbox.css" rel="stylesheet">
	<!--Adding Media Queries and Canvas Support for IE8-->
	
	<!--[if lt IE 9]>
	  <script src="scripts/plugins/respond.min.js"></script>
	  <script src="scripts/plugins/excanvas.js"></script>
	<![endif]-->
	
	<script type="text/javascript" src="scripts/jquery.js"></script>
	<script type="text/javascript" src="scripts/placeholder.js"></script>
	<script type="text/javascript" src="scripts/sendmessage.js"></script>
	<script type="text/javascript" src="scripts/maskedinput.js"></script>
	
	<script type="text/javascript">
		$(document).ready(function() {
			$("input,textarea").placeholder();
			$(".input_phone").mask("+7 (999) 999-9999");
			sendMessage("#div_contact1", "true");
			sendMessage("#div_contact2", "false");
		});
	</script>
	<!-- Global site tag (gtag.js) - Google AdWords: 951139111 --> <script async src="https://www.googletagmanager.com/gtag/js?id=AW-951139111"></script> <script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());
	
	gtag('config', 'AW-951139111');
	</script>
	<!-- Event snippet for Сделанный заказ conversion page -->
	<script>
	gtag('event', 'conversion', {
	'send_to': 'AW-951139111/4RoUCKiGmIABEKf2xMUD',
	'value': 1.0,
	'currency': 'USD',
	'transaction_id': ''
	});
	</script>
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<script>
	  (adsbygoogle = window.adsbygoogle || []).push({
	    google_ad_client: "ca-pub-8474448558104753",
	    enable_page_level_ads: true
	  });
	</script>

	<link type="text/css" href="http://taxilargus.ru/templates/landkit/styles/index.css" rel="stylesheet" />



</head>
<body>
<!--Page Preloading-->
 <div id="preloader"><div id="spinner"></div></div>

<!--Header-->
<header class="header" id="main">
	
	<div class="container">
		<div class="row">
			
			<div class="col-md-3">
				<a href="/trezvyi-voditel.php">
				<img class="logo2" src="/templates/landkit/images/logo-1.png" alt="VipTaxiSonata">
				</a>
			</div>

			<div class="col-md-6 text-center">
				<h1>Такси LARGUS Самара.</h1> <h2>Услуга трезвый водитель по Самаре и области</h2>
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
			  
			<input type="hidden" name="form_name" value="Трезвый водитель (всплывающая форма)" />
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

<!--Features-->
    <section id="features">
    	<div class="container">

        <div class="row features text-light text-uppercase">
          <div class="col-lg-4 col-md-4 col-sm-4 wow fadeInLeft">
            <div class="feature-img"><img src="/templates/landkit/images/features/i1-6.png" alt="Низкие тарифы"/></div>
            <h3>Низкие тарифы</h3>			  
          </div>
			
          <div class="col-lg-4 col-md-4 col-sm-4 wow fadeInDown">
            <div class="feature-img"><img src="/templates/landkit/images/features/i2-5.png" alt="Минимальное время ожидания"/></div>
            <h3>Минимальное время&nbsp;ожидания</h3>            
          </div>
			
          <div class="col-lg-4 col-md-4 col-sm-4 wow fadeInRight">
            <div class="feature-img"><img src="/templates/landkit/images/features/i3-6.png" alt="Безопасность"/></div>
            <h3>Безопасность</h3>            
          </div>
			
        </div>
		<div class="row text-center taxi">
          <img src="/templates/landkit/images/features/taxi1.png" alt="Безопасность"/>          
        </div>		
		
		</div>
   </section>

	<div class="container">
		<div class="row text-center">
			<h2 text-uppercase>Такси LARGUS Самара – удобное такси для грузов и людей</h2>          
		</div>
	</div>

<div id="callback" class="clearfix">
		<div class="container">
           <div class="row">
               <div class="col-md-6">
                   <div class="mail-form text-center wow fadeIn">
                       <h3>
                           Заполните форму <br>прямо сейчас!
                       </h3>
                       
					   <div id="div_contact2">
                      	 <form id="user_contact" name="user_contact" action="#" method="post">
                           	<input class="wow flipInX input_phone required" type="tel" id="user_phone" name="user_phone" placeholder="Контактный телефон*">
                           	<input class="wow flipInX required" type="text" id="user_from" name="user_from" placeholder="Откуда*">
                           	<input class="wow flipInX required" type="text" id="user_to" name="user_to" placeholder="Куда*">
                           	<input class="wow flipInX required" type="text" id="user_date" name="user_date" placeholder="Дата, время*">
							
						    <input type="hidden" name="form_name" value="Трезвый водитель (встроенная форма)">
                           	<input type="hidden" name="user_time" value="yes">
							<input type="hidden" name="user_agent" value="yes">
							<input type="hidden" name="user_ip" value="yes">
							<input type="hidden" name="user_referrer" value="yes">
							
						   <input class="wow flipInX" type="submit" id="user_send" name="user_send" value="Заказать такси">
                      	 </form>
					   </div> <!-- #div_contact2 -->
					   
                   </div>
                   <img src="/templates/landkit/images/strela-2.png" alt="" class="arrow-form wow zoomIn">
               </div>
               <div class="col-md-6 advantages">
                   <div class="row">
                       <div class="col-xs-12 wow fadeInRight">
                           <img src="/templates/landkit/images/i21-1.png" alt="будильник">
                           <h4>Оперативное выполнение заказа</h4>
                           <p>Принимаем вызовы ко времени. Гарантируем максимальную скорость выполнения заказа.</p>
                       </div>
                       <div class="col-xs-12 wow fadeInRight">
                           <img src="/templates/landkit/images/i22-1.png" alt="будильник">
                           <h4>24 часа в сутки</h4>
                           <p>Работаем круглосуточно, на связи 24 часа, 7 дней в неделе. Ваш заказ будет выполнен в удобное для Вас время по предварительному согласованию.</p>
                       </div>
                       <div class="col-xs-12 wow fadeInRight">
                           <img src="/templates/landkit/images/i23-1.png" alt="будильник"> 
                           <h4>Просторный салон автомобиля. Кондиционер.</h4>
                           <p>В Вашем распоряжении все возможности автомобиля Lada LARGUS. Наши авто – чистые и опрятные, 100% готовые к выполнению Ваших заказов.</p>
                       </div>
                       <div class="col-xs-12 wow fadeInRight">
                           <img src="/templates/landkit/images/i24-1.png" alt="будильник">   
                           <h4>С нами — безопасно!</h4>
                           <p>Ежедневная проверка автомобилей на техническую исправность и опытные водители. Сохранность грузов гарантирована.</p>
                       </div>
                   </div>
               </div>
           </div><!--row-->
       </div><!--container-->
	</div> <!-- #callback -->

	<!--Charts-->
    <section class="page-block less-space-bottom" id="charts">
    	<div class="container">
        <div class="row page-header">
          <h2>Наши услуги</h2>
          <span>Вам нужно доставить приобретенную бытовую технику? Ваш багаж не умещается в обычное такси? Нужен трансфер до аэропорта? Транспортировка негабаритных товаров? Мы Вам поможем! Такси LARGUS Самара – идеальное решение для перевозок небольших грузов или объемного багажа!</span>
        </div>
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 chart">
			<div class="img">
				<img src="/templates/landkit/images/malogabarit.png" class="">
			</div>
            <h3>Доставка малогабаритных грузов</h3>
            <p>Мы примем Ваш груз согласно предоставленной заранее Вашей описи, проверим наличие и целостность поставки.  Доставим груз по указанному Вами адресу.</p>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 chart">
			 <div class="img">
			  <img src="/templates/landkit/images/transfer.png" class="">
			</div>
            <h3>Трансфер в аэропорт</h3>
            <p>
				Вы можете быть уверены в том, что машина будет подана точно в срок и весь Ваш багаж будет размещен.
			  </p>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 chart">
			<div class="img">
			  <img src="/templates/landkit/images/kurer.png" class="">
			</div>
            <h3>Грузовой курьер</h3>
            <p>Вы можете поручить нам транспортировку товара от одного лица к другому в пределах Самарской области. Гарантируем сохранность груза и конфиденциальность.</p>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 chart">
			<div class="img">
			  <img src="/templates/landkit/images/passagir.png" class="">
			</div>
            <h3>Пассажирские перевозки по городу</h3>
            <p>
				Наше такси будет удобно для пассажиров с большим багажом – для дачников, туристов, музыкантов, спортсменов.
			  </p>
          </div>
        </div>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 chart">
				<p>
					Встретим проводим отвезем 24 часа без выходных:<br>
					Ж/Д Вокзал, Аэропорт Курумоч, Автовокзал;<br>
					МЕЖГОРОД: Самара-Тольятти-Оренбург-Казань-Москва<br>
					К Вашим услугам - Детское Такси (детское кресло, адаптер)
				</p>
			<p>
				Приглашаем к сотрудничеству рестораны, пиццерии, цветочные магазины и магазины подарков и сувениров для доставки заказов по городу и области по предварительному согласованию.
			</p>
			</div>
		</div>
      </div>
    </section>

	<!--Pricing Plans--> 
    <section class="page-block" id="pricing">
    	<div class="container">
        <div class="row page-header">
          <h2>ТАРИФЫ</h2>
		  <span>Тарифы в городе и межгород</span>
        </div>
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-12">
          	<div class="">
            	<div class="header">
              	<h3>Тарифы Такси LARGUS Самара в городе:</h3>
              </div>
              <div class="body">
              	<uL>
                  <br>
                  <li>Стоимость 1-го часа – 600р.</li>
                  <br>
                </uL>
                <p>
					Время ожидания – 4р. минута (платное время ожидания по требованию абонента на промежуточных остановках), бесплатное время ожидания – 5 мин (выход клиента, по прибытии т.с.), 5 мин на промежуточных остановках. Время погрузки и разгрузки не оплачивается.
				</p>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-12">
          	<div class="">
            	<div class="header">
              	<h3>Тарифы Такси LARGUS Самара межгород:</h3>
              </div>
              <div class="body">
              	<uL>
                  <li>Стоимость посадки (погрузки) грузтакси – 100р.</li>
                  <li>Стоимость посадки легкового такси – 0р.</li>
                  <li>Стоимость 1-го км. пробега – 30р.</li>
                </uL>
                <p>
					Время ожидания – 4р. Минута (платное время ожидания по требованию абонента на промежуточных остановках), бесплатное время ожидания – 5 мин (выход клиента, по прибытии т.с.), 5 мин на промежуточных остановках. Время погрузки и разгрузки не оплачивается.
				</p>
              </div>
            </div>
          </div>
		  <h3 class="text-center">
			  Примечание: тарифы за вывоз клиентов из труднодоступных районов пригород – 250р.
		  </h3>
        </div>
      </div>
    </section>

	<div id="gallery">
		<div class="container">
			<div class="row"> 
				<div class="col-sm-3">
					<a href="/templates/landkit/images/viber-image01.jpg" data-lightbox="lbox" class="lbox"><img src="/templates/landkit/images/viber-image01-r.jpg" class="img-responsive"></a>
				</div>
				<div class="col-sm-3">
					<a href="/templates/landkit/images/viber-image02.jpg"  data-lightbox="lbox" class="lbox"><img src="/templates/landkit/images/viber-image02-r.jpg" class="img-responsive"></a>
				</div>
				<div class="col-sm-3">
					<a href="/templates/landkit/images/viber-image03.jpg"  data-lightbox="lbox" class="lbox"><img src="/templates/landkit/images/viber-image03-r.jpg" class="img-responsive"></a>
				</div>
				<div class="col-sm-3">
					<a href="/templates/landkit/images/viber-image04.jpg"  data-lightbox="lbox" class="lbox"><img src="/templates/landkit/images/viber-image04-r.jpg" class="img-responsive"></a>
				</div>
			</div>
			<p>
				&nbsp;
			</p>
			<div class="row"> 
				<div class="col-sm-3">
					<a href="/templates/landkit/images/viber-image05.jpg"  data-lightbox="lbox" class="lbox"><img src="/templates/landkit/images/viber-image05-r.jpg" class="img-responsive"></a>
				</div>
				<div class="col-sm-3">
					<a href="/templates/landkit/images/viber-image06.jpg"  data-lightbox="lbox" class="lbox"><img src="/templates/landkit/images/viber-image06-r.jpg" class="img-responsive"></a>
				</div>
				<div class="col-sm-3">
					<a href="/templates/landkit/images/viber-image07.jpg"  data-lightbox="lbox" class="lbox"><img src="/templates/landkit/images/viber-image07-r.jpg" class="img-responsive"></a>
				</div>
				<div class="col-sm-3">
					<a href="/templates/landkit/images/viber-image08.jpg"  data-lightbox="lbox" class="lbox"><img src="/templates/landkit/images/viber-image08-r.jpg" class="img-responsive"></a>
				</div>
			</div>
		</div>
	</div> <!-- #gallery -->

	<!--Testimonials-->
    <section class="page-block color" id="testimonials">
    	<div class="container">
        <div class="row page-header">
          <h2 class="text-light wow fadeInDown">Что говорят о нас клиенты:</h2>
          <span class="text-light">Такси LARGUS Самара – удобное такси для грузов и людей</span>
        </div>
        <div class="row">
          <div id="testimonials-slider" class="testimonials-slider carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
              <li data-target="#testimonials-slider" data-slide-to="0" class="active"></li>
              <li data-target="#testimonials-slider" data-slide-to="1"></li>
              <li data-target="#testimonials-slider" data-slide-to="2"></li>
            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
              <div class="item active">
                <div class="container">
                  <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-4">
                      <img class="img-center" src="templates/landkit/images/testimonials/sljd1.png" width="150" height="150" alt="Dexter Dirk"/>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8">
                      <blockquote>
                        <p class="text-light">Рекомендую такси Лада Ларгус – оценила по достоинству большой салон. Очень удобен для тех кто собирается на большой шопинг – лично я покупала велосипеды сыновьям и много чего по мелочи. Машина пришла во время, с погрузкой-разгрузкой мне очень любезно помогли. Спасибо!</p><br>
                        <footer class="text-light">Татьяна Макарова </footer>
                      </blockquote>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="container">
                  <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-4">
                      <img class="img-center" src="templates/landkit/images/testimonials/slajd2.png" width="150" height="150" alt="Richard Roe"/>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8">
                      <blockquote>
                        <p class="text-light">Мы перевозили бытовую технику в новый дом в Кинеле. Получилось дешевле и быстрее чем на Газели. Рекомендую такси Ларгус самара!</p><br>
                        <footer class="text-light">Матвей</footer>
                      </blockquote>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="container">
                  <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-4">
                      <img class="img-center" src="templates/landkit/images/testimonials/slajd3.png" width="150" height="150" alt="Jonathan Doe"/>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8">
                      <blockquote>
                        <p class="text-light">Работаю оргом в совместных покупках. Заказала доставку груза – очень удобно! Даже не надо самой мотаться – такси Ларгус все привезли, отчитались. Очень культурно! Спасибо!</p>
                        <footer class="text-light">Марина Кислова</footer>
                      </blockquote>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

	<div id="footer-custom" class="text-center container">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<a href="/">
					<img class="logo2" src="/templates/landkit/images/logo-1.png" alt="VipTaxiSonata">
					</a>
				</div>
				<div class="col-md-5">
					<h2 style="color:#000;">Такси LARGUS Самара.</h2>
				</div>
				<div class="col-md-4">				
					<h2><a href="tel:89277454232" style="color:#000;">8 927 745 42 32</a></h2>
				</div>
			</div>
		</div>
		
		<p>Создание сайтов - <a href="http:\\webvertex.pro">webvertex.pro</a> © 2016 | Все права защищены.</p>
	</div> <!-- #footer-custom -->

<!--Scroll To Top Button-->
<div id="scroll-top" class="scroll-up"><i class="icon-arrow-up"></i></div>
<!--WowJs-->
<script src="https://cdn.jsdelivr.net/wow/1.1.2/wow.min.js"></script>
<script>
    var wow = new WOW(
  {
    boxClass:     'wow',      // animated element css class (default is wow)
    animateClass: 'animated', // animation css class (default is animated)
    offset:       150,          // distance to the element when triggering the animation (default is 0)
    mobile:       true,       // trigger animations on mobile devices (default is true)
    live:         true,       // act on asynchronously loaded content (default is true)
    callback:     function(box) {
      // the callback is fired every time an animation is started
      // the argument that is passed in is the DOM node being animated
    },
    scrollContainer: null // optional scroll container selector, otherwise use window
  }
);
wow.init();
</script>
<script type="text/javascript" src="scripts/lightbox/js/lightbox.min.js"></script>


	<script src="scripts/libs/jquery.easing.1.3.js"></script>
	<script src="scripts/plugins/bootstrap.min.js"></script>
	<script src="scripts/plugins/jquery.touchSwipe.min.js"></script>
	<script src="scripts/plugins/jquery.placeholder.js"></script>
	<script src="scripts/plugins/icheck.min.js"></script>
	<script src="scripts/plugins/jquery.validate.min.js"></script>
	<script src="scripts/plugins/gallery.js"></script>
	<script src="scripts/plugins/jquery.fitvids.js"></script>
	<script src="scripts/plugins/jquery.bxslider.min.js"></script>
	<script src="scripts/plugins/chart.js"></script>
	<script src="scripts/plugins/waypoints.min.js"></script>
	<script src="scripts/plugins/smoothscroll.js"></script>
	<script src="scripts/landing2.js"></script>

</body>
</html>