<?
session_start();
?>
<html>
<head>
	<title>[TV Show Planet]</title>
	<link href="favicon.png" rel="shortcut icon" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" media="all" href="js/fancybox/jquery.fancybox.css">  
    <link rel="stylesheet" type="text/css" media="all" href="css/custom.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" media="all" href="css/template.css">
    <!-- <link rel="stylesheet" href="css/font-awesome.min.css" > -->
	<script src='js/jquery-1.10.2.min.js'></script>
	<script src="js/jquery.tablesorter.js"></script> 
    <script src="js/fancybox/jquery.fancybox.js"></script>
    <script src="js/func.js"></script>
    <script src="js/pekeUpload.min.js"></script>
    <script src="js/jquery-ui.js"></script> 
    <script src="js/bootstrap.min.js"></script>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
<script>
    $(document).ready(function(){
    	//------------Scroll button----------------------------
    	$(window).scroll(function(){
    		if ($(this).scrollTop() > 0){
    			$('#scroller').fadeIn();
    		} 
    		else{
    			$('#scroller').fadeOut();
    		}
    	});
    	$('body').append ('<div id="scroller" class="b-top" style="display: none;"><span class="b-top-but"></span></div>');
		$('#scroller').click(function(){
			$('body,html').animate({scrollTop: 0}, 400); 
			return false;
		});
		///////////////////////////////////////////////////////
    	//-------------TABLESORTER--------------------------
    	$(".main_table").tablesorter({
        	headers: {
        		3:{
        			sorter: false
        		},
        		6:{
        			sorter: false
        		},
        		7:{
        			sorter: false
        		}
        	}
        });
        //------Paint tables(Blue,White,Blue,White.....)
        //And mouse actions: on over, on leave
        var tr_class = '';
        $('.main_table tr:nth-child(odd)').removeClass('lineOne').addClass('lineTwo');
        //OVER
      	$('tr').not('.firstLine').mouseenter(function(){
        	tr_class = $(this).attr('class');
        	$(this).removeClass(tr_class).addClass('lineSelected')
      	});
      	//LEAVE
      	$('tr').mouseleave(function(){
        	$(this).removeClass('lineSelected').addClass(tr_class);
         	tr_class = '';
      	});
      	//-----Home Button--------
      	$('#div_avatar').hover(
			function(){
				// l('hover div');
				$('#img_home').fadeIn("fast");
			},
			function(){
				$('#img_home').fadeOut("fast");
			}
		);
     });
</script>
	<div class='page-wrapper'>
		<div class='navbar navbar-inverse' style='margin: 20px 20px 20px 20px'>
			<nav class='navbar-inner'>
				<ul class='nav'>
					<li><img src=<?=$ava ?> style='width:30px;height:30px;margin-top:5px'></li>
					<li><a href='index.php'><b><?=$login ?></b></a></li>
					<li class='divider-vertical'></li>
					<li><a class='modalbox' href='#inline'>Добавить мнение</a>
					<li><a id='users_button' href='#'>Пользователи</a></li>
					<li><a id='friends_button' href='#'>Друзья</a></li>
					<li><a class='modalbox' id='options_button' href='#options'>Настройки</a></li>
					<li><a id='statistic_button' href='#statistic'>Статистика</a></li>
					<li ><a class='pull-right' href='exit.php'>Выход</a></li>
					<li class='brand pull-right'>TV Show Planet</li>
				</ul>
			</nav>
		</div>
	<!-- </div> -->
<!-- //////////////////    ADD OPINION MODAL FORM BLOCK    //////////////////// -->
	<div id="inline">
  		<h2 id='form_title'>Добавить мнение</h2>
  		<img style="height:30px;width:30px;" src="img/alert.png"/>
  		Убедительная просьба брать названия сериалов с сайта <a href="http://kinopoisk.ru">Кинопоиск</a>
  		<!-- <img style="height:30px;width:30px;" src="img/alert.png"/> --><!-- <p></p> -->

		<form id="addform" class='form-horizontal' name="addform" action="#" method="post">
		    <div class='control-group'>
		    	<label class='control-label' for="name_en">Название(En):</label>
		    	<input class='inputs_width-2x'  type="text" id="name_en" name="name_en" placeholder='Название(En)'>
		    </div>
		    <div class='control-group'>
		    	<label class='control-label' for="name_ru">Название(Ru):</label>
		    	<input class='inputs_width-2x' type="text" id="name_ru" name="name_ru" value="" class="txt" placeholder='Название(Ru)'>
		    </div>
		    <div class='control-group'>
		    	<label class='control-label' for="stars">Оценка:</label>
				<select name="stars" id="stars">
					<option value='1'>1</option>
					<option value='2'>2</option>
					<option value='3'>3</option>
					<option value='4'>4</option>
					<option value='5'>5</option>
					<option value='6'>6</option>
					<option value='7'>7</option>
					<option value='8'>8</option>
					<option value='9'>9</option>
					<option value='10'>10</option>
				</select>
			</div>
			<div class='control-group'>
				<label class='control-label' for="status">Статус:</label>
				<select name='status' id="status" onclick="getSelect()">
					<option value='all'>Полностью просмотрен</option><!-- snotren -->
					<option value='now'>Смотрю</option><!-- nezakonch -->
					<option value='will'>Буду смотреть</option><!-- nesmotren -->
					<option value='notlike'>Смотрел, не понравилось</option><!-- govno -->
				</select>
			</div>
			<div id="stamp">
				<span class='remark'>Можно указать место на котором остановились</span><br/>
					Сезон:<input id="season" name="season" type="text" min="1" size="1" value="1">
					Эпизод:<input id="episode" name="episode" type="text" size="1" value="1">
					Минуты:Секунды
					<input id="min" name="min" type="text" size="2" value="1">:
					<input id="sec" name="sec" type="text" value="00" size="2">
			</div>
			<div class='control-group'>
				<label class='control-label' for="link">Ссылка(кинопоиск):</label>
				<input id="link" name="link" type="text" value="" class="txt">
			</div>
			<!-- <br /> -->
			<div class='control-group'>
				<label class='control-label tags_add_opinion'>Теги:</label>
				<a class='tags'>Боевик</a>
				<a class='tags'>Детектив</a>
				<a class='tags'>Драма</a>
				<a class='tags'>История</a>
				<a class='tags'>Комедия</a><br>
				<a class='tags'>Криминал</a>
				<a class='tags'>Мелодрама</a>
				<a class='tags'>Приключения</a>
				<a class='tags'>Спорт</a><br>
				<a class='tags'>Триллер</a>
				<a class='tags'>Ужасы</a>
				<a class='tags'>Фантастика</a>
				<a class='tags'>Фэнтези</a>
				<a class='tags'>Русский</a>
			</div>
			<div class='control-group'>
				<label class='control-label' for="comment">Комментарий:</label>
				<textarea name="comment" id="comment" rows="3" cols="20"></textarea>
			</div>
			<!-- <input type = 'submit' name = 'button_add' value = 'Добавить мнение'>     -->
			<div class='controls'>
		    	<button type='submit' id="send" class='btn'>Добавить мнение</button>
		    	<button type='submit' id="send_upd" class='btn' style="display:none">Обновить</button>
		    </div>
		</form>
	</div>
<!-- /////////////////// UNVISIBLE MODAL FORM BLOCK ///////////////////////        -->
<!-- //////////////////    OPTIONS MODAL FORM BLOCK    //////////////////// -->
	<div id='options'>
		<h3>Настройки</h3>
		<div class='row'>
			<div class='span3'>
				<div class='control-group'>
					<label class='control-label' for='opt_first_name'>Имя</label>
					<input class='inputs_width' type='text' name='opt_first_name' id='opt_first_name'>
				</div>
				<div class='control-group'>
					<label class='control-label' for='opt_last_name'>Фамилия</label>
					<input class='inputs_width' type='text' name='opt_last_name' id='opt_last_name'>
				</div>
				<div class='control-group'>
					<label class='control-label' for='opt_email'>E-Mail</label>
					<input class='inputs_width' type='email' name='opt_email' id='opt_email'>
				</div>
				<div class='control-group'>
					<div class='controls'>
						<label class='checkbox'>
							<input  type='checkbox' name='opt_private' id='opt_private'>Приватная страница
						</label>
						
					</div>
				</div>
				<div class='control-group'>
					<label class='control-group' for='opt_avatar'>Аватар</label>
					<img id='opt_img_avatar' class='users_ava ava' src=<?=$ava?>>
					<input  type="file" name="opt_avatar" id="opt_avatar">
				</div>
				<div class='controls'>
					<button type='submit' class='btn' id='opt_data_send'>Изменить</button>
				</div>
			</div>	
			<div class='span3'>
				<div class='control-group'>
					<label class='control-label' for='opt_password_old'>Старый пароль</label>
					<input class='inputs_width' type='password' name='opt_password_old' id='opt_password_old'>
				</div>
				<div class='control-group'>
					<label class='control-label' for='opt_password_new'>Новый пароль</label>
					<input class='inputs_width' type='password' name='opt_password_new' id='opt_password_new'>
				</div>
				<div class='control-group'>
					<label class='control-label' for='opt_passsword2'>Повтор нового пароля</label>
					<input class='inputs_width' type='password' name='opt_password_new2' id='opt_password_new2'>
				</div>
				<div class='controls'>
					<button type='submit' id='opt_pass_send' class='btn'>Изменить пароль</button>
				</div>
				<br>
				<div class='controls'>
					<button type='submit' id='del_acc' class='btn'>Удалить аккаунт</button>
				</div>
			</div>
			<div class='span6'>
			</div>
		</div>
<!-- 		<div id='opt_div_message' style='visibility: none;'>
		</div> -->
<!-- 		<div id='opt_div_pass'>

		</div>
	<a id='del_acc' class='medium blue awesome' style='float: bottom; margin-top: 67px;'>Удалить аккаунт</a> -->
</div>
<!-- //////////////////    OPTIONS MODAL FORM BLOCK    //////////////////// -->
<!-- //////////////////    SEND EMAIL MODAL FORM BLOCK    //////////////////// -->
<div id='email_to_dev'>
	<h3>Оставить отзыв, пожелания или идеи</h3>
	<div>
		<textarea rows="10" cols="34" name='feedback' id='feedback'></textarea>
		<button id='feedback_send'>Отправить</button>
	</div>
</div>
<!-- //////////////////    SEND EMAIL MODAL FORM BLOCK    //////////////////// -->
<!-- ///////////////////////////////////JS CODE///////////////////////////////////////////////////////////////////////////// -->
<script>
	//support functions
	function getLineTable(tr){
		var NameEn = $(tr).children('.NameEn').text();
		var NameRu = $(tr).children('.NameRu').text();
		var Sems = $(tr).children('.Sems').text().split(' ');
		var Season = Sems[1];
		var Episode = Sems[3];
		var Time = String(Sems[5]).split(':');
		var Min = Time[0];
		var Sec = Time[1];
		var Stars = $(tr).children('.Stars').text().split('/')[0];
		var Comment = $(tr).children('.Comment').text();
		var link = $(tr).children('.link').children('a').attr('href');
		var Status = $(tr).children('.action').children('a').attr('href');
		var Tags = $(tr).children('.tag_field').text().split(' ');

		var data = {
			NameEn: NameEn,
			NameRu: NameRu,
			Season: Season,
			Episode: Episode,
			Min: Min,
			Sec: Sec,
			Stars: Stars,
			Comment: Comment,
			link: link,
			Status: Status,
			Tags: Tags
		}
		return data;
	 }
	function getSelect(){
		var status = $('#status').val();
		if(status == 'now'){
			$('#stamp').css('display','block');
			$('#inline').css('height','600');
		}
		if(status != 'now'){
			$('#stamp').css('display','none');
			$('#inline').css('height','550');
		}
	 }
	function l(str){
		console.log(str);
	 }
	function clearForm(){
		// Очистка формы после Update
		$('#name_en').val('');
		$('#name_ru').val('');
		$('#stars').val('');
		$('#status').val('');
		// $('#status :contains("'+elem['Status']+'")').attr('selected','selected');
		$('#link').val('');
		$('#comment').val('');
		//---------------------------------------------------
		// modificate Form & SEND button
		$('#form_title').replaceWith('<h2>Добавить мнение</h2>');
		$('#send').css('display','block');
		$('#send_upd').css('display','none');
		//---------------------------------------------------
	 }

	$(document).ready(function(){
		//-------  FANCY BOX SETTINGS MODAL FORMS --------//
		$('.emailbox').fancybox({
			padding: 10,
			height: 300,
			width: 500,
			topRatio: 0,
			afterClose: function(){
				$('#feedback').val('');
			}
		});
		$('.update').fancybox({
			topRatio: 0,
			afterClose: clearForm,
		});
		$('#option').fancybox({
			padding: 10,
			height: 300,
			width: 500,
			topRatio: 0,
		});
  		$(".modalbox").fancybox({
   			padding : 10,
   			height : 550,
   			width : 500,
   			topRatio: 0,	
		});
		$("#addform").submit(function(){return false;});
		$('#option_form').submit(function(){return false;});
		//////////////--------BUTTONS--------///////////////
		//------------------Feedback Button----------------
		$('#feedback_send').on('click', function(){
			var message = $('#feedback').val();
			$.ajax({
				type: 'POST',
				url: 'del_upd.php',
				data: 'message='+message+'&action=feedback&',
				success: function(data){
					console.log('!Sended!');
					console.log(data);
					if(data == 1){
						// alert('Запись успешно удалена');
						setTimeout("document.location.href='index.php'",500);
					}
				}
			})
		});
		//show all users registred on site
		$('#users_button').on('click', function(){
			setTimeout("document.location.href='index.php?users=1'",500);
		});
		//show your friends
		$('#friends_button').on('click', function(){
			setTimeout("document.location.href='index.php?users=2'",500);
		});
		//back to home
		$('#img_home').on('click', function(){
			setTimeout("document.location.href='index.php'", 500);
		});
		$('#back_button').on('click', function(){
			setTimeout("document.location.href='index.php'",500);
		});
		$('#statistic_button').on('click', function(){
			setTimeout("document.location.href='index.php?statistic=1'",200);
		});

		//Tables actions delete, update
		$('.delete').click(function(){
			// console.log('Delete: '+$(this).attr('href'));
			var id = $(this).attr('href')+'&action=del&';
			id = 'id='+id.substring(1,id.length);
			// var b = 'id='+id_;
			// console.log(id);
			$.ajax({
				type: 'POST',
				url: 'del_upd.php',
				data: id,
				success: function(data){
					console.log('!Sended!');
					console.log(data);
					if(data == 'true'){
						// alert('Запись успешно удалена');
						setTimeout("document.location.href='index.php'",500);
					}
				}
			})
		});

		// TAGS<>TAGS<>TAGS
		$('.tags').on('click', function(){
			console.log($(this).text());
			$(this).toggleClass('tag_clicked');
		});
		$('.tag_link').on('click', function(){
			// l($(this).text());
		})
		// SEND AJAX ON SERVER OPINION
		$("#send").on("click", function(){	
			//get tags
			var tags = [];
			$('.tag_clicked').each(function(){
				tags.push($(this).text());
			});
			var tags_str = tags.join();
			var a = $("#addform").serialize();
			a += '&tags='+tags_str+'&';
			console.log(a);	
			$.ajax({
				type: 'POST',
				url: 'add.php',
				data: a,
				success: function(data) {
					console.log('!!!!!!!!sended');
					console.log(data);
					if(data == "true") {
						$("#addform").fadeOut("fast", function(){
							$(this).before("<p><strong>Успешно!</strong></p>");
							setTimeout("$.fancybox.close()", 1000);
							setTimeout("document.location.href='index.php'",2000);
						});
					}
					if(data == "false"){
						$("#addform").fadeOut("fast", function(){
							$(this).before("<p><strong>Поля нужно заполнять! :(</strong></p>");
							setTimeout("$.fancybox.close()", 1000);
							setTimeout("document.location.href='index.php'", 2000);
						});
					}
				}

			});
  		});
  		//SEND AJAX UPDATE ON SERVER
		$('.update').click(function(){
			//---------------------------------------------------
			//Берем инфу из таблицы на странице
			//---------------------------------------------------
			var id = $(this).attr('id');//id
			var tr = $(this).parent().parent();//tr - data elements from table
			var Data = getLineTable(tr);
			// Загоняем данные в форму
			$('#name_en').val(Data['NameEn']);
			$('#name_ru').val(Data['NameRu']);
			$('#stars').val(Data['Stars']);
			$('#status').val(Data['Status']);
			$('#status :contains("'+Data['Status']+'")').attr('selected','selected');
			$('#link').val(Data['link']);
			$('#comment').val(Data['Comment']);
			// Для статуса "смотрю"
			$('#season').val(Data['Season']);
			$('#episode').val(Data['Episode']);
			$('#min').val(Data['Min']);
			$('#sec').val(Data['Sec']);

			$('.tags').each(function(){
				if( in_array($(this).text(), Data['Tags']) ){
					$(this).toggleClass('tag_clicked');
				}
			});

			// modificate Form & SEND button
			if(Data['Status'] == 'Смотрю'){
				$('#stamp').css('display','block');
				$('#inline').css('height','500');
			}
			if(Data['Status'] != 'Смотрю'){
				$('#stamp').css('display','none');
				$('#inline').css('height','400');
			}
			$('#form_title').replaceWith('<h2>Обновить мнение</h2>');
			$('#send').css('display','none');
			$('#send_upd').css('display','block');

			// onClick 
			$('#send_upd').click(function(){
				// Снова зачитываем данные с формы
				var name_en = $('#name_en').val();
				var name_ru = $('#name_ru').val();
				var stars = $('#stars').val();
				var status = $('#status').val();
				var comment = $('#comment').val();
				var link = $('#link').val();
				var season = $('#season').val();
				var episode = $('#episode').val();
				var min = $('#min').val();
				var sec = $('#sec').val();
				//get tags
				var tags = [];
				$('.tag_clicked').each(function(){
					tags.push($(this).text());
				});
				var tags_str = tags.join();
				data = 'NameEn='+name_en+'&NameRu='+name_ru+'&Stars='+stars
				 	 +'&Status='+status+'&Season='+season+'&Episode='+episode
				 	 +'&Min='+min+'&Sec='+sec+'&Comment='+comment+'&Link='+link+'&tags='+tags_str+'&id='+id+'&action=upd&';
				$.ajax({
					type: 'POST',
					url: 'del_upd.php',
					data: data,
					success: function(data){
								console.log('!Sended!');
								console.log(data);
								if(data == 'true'){
									// alert('Запись успешно обновлена');
									setTimeout("document.location.href='index.php'", 500);
								}
					}
				});

			});			
		});
		//----------------------------Users Operations-------------------------------------//
		//----------------------------Add Friend-------------------------------------------//
		$('#add_friend').on('click', function(){
			var user_login = $('#user_login').text();
			var data = 'user_login='+user_login+'&action=add_del_friend&';
			$.ajax({
				type: 'POST',
				url: 'del_upd.php',
				data: data,
				success: function(data){
							console.log('!Sended!');
							console.log(data);
							var obj = $.parseJSON(data);
							if(obj.action == 'added'){
								$('#add_friend').text('Удалить из друзей');
							}
							if(obj.action == 'deleted'){
								$('#add_friend').text('Добавить в друзья');
							}
				}
			});			
		});

		//---------------------------------------------------------------------------------//
		//----------------------------Begin  Options---------------------------------------//
		//---------------------------------------------------------------------------------//
		$('#del_acc').on('click', function(){
			l("DEL_ACC");
			$.ajax({
				type: 'POST',
				url: 'del_upd.php',
				data: 'action=del_acc&;',
				success: function(data){
							l(data);
							if(data == 'true'){
								setTimeout("document.location.href='index.php'", 500);
							}
							else{
								alert('Возникла ошибка при удалении аккаунта.');
								setTimeout("document.location.href='index.php'", 500);
							}
				}
			});	
		});
		$("#opt_avatar").pekeUpload({
			btnText: 'Выбрать аватар',
			url: 'del_upd.php',
			multu: false,
			field: 'ava_file',
			onFileSuccess: function(file,data){
				//При успешной загрузке меняем картинку аватара
				var ext = file.name.split('.')[1];
				var filename = "<?= $login ?>"+"."+ext;
				$('#opt_img_avatar').attr('src','avatars/'+filename);
			}
		});

		$('#options_button').on('click', function(){
			$.ajax({
				type: 'POST',
				url: 'del_upd.php',
				data: 'action=opt_load&',
				success: function(data){
					console.log('!Sended!');
					console.log(data);
					var obj = $.parseJSON(data);
					//Fill Data Fields
					$('#opt_first_name').val(obj.name);
					$('#opt_last_name').val(obj.last_name);
					$('#opt_email').val(obj.mail);
					$('#opt_avatar').val(obj.avatar);
					if(obj.private == 1){
						$('#opt_private').attr('checked','checked');
					}
				}
			})
		});

		$('#opt_data_send').on('click', function(){
			var first_name = $('#opt_first_name').val();
			var last_name = $('#opt_last_name').val();
			var email = $('#opt_email').val();
			var opt_private = Number($('#opt_private').is(':checked'));
			var data = 'first_name='+first_name+'&last_name='+last_name+
					   '&email='+email+'&opt_private='+opt_private+'&action=opt_save&';
			$.ajax({
				type: 'POST',
				url: 'del_upd.php',
				data: data,
				success: function(data){
					console.log('!Sended!');
					console.log(data);
					if(data == 'true'){
						$("#options").fadeOut("fast", function(){
							// $(this).before("<p><strong>Успешно!</strong></p>");
							setTimeout("$.fancybox.close()", 1000);
							setTimeout("document.location.href='index.php'",500);
						});

					}
				}
			});
		});
		$('#opt_pass_send').on('click', function(){
			if($('#opt_password_old').val() != "" && 
			   $('#opt_password_new').val() != "" &&
			   $('#opt_password_new2').val() != ""){
			   		var data = 'opt_password_old='+$('#opt_password_old').val()+'&'+
			   				   'opt_password_new='+$('#opt_password_new').val()+'&'+
			   				   'opt_password_new2='+$('#opt_password_new2').val()+'&'+
			   				   'action=change_pass&';
					$.ajax({
						type: 'POST',
						url: 'del_upd.php',
						data: data,
						success: function(data){
							console.log('!Sended!');
							console.log(data);
							var obj = $.parseJSON(data);
							$('#opt_div_message').html('<h2>'+obj.message+'</h2>');//.fadeIn("slow");
							$('#opt_div_pass').fadeOut("slow").delay(3000).fadeIn("slow");
							$('#opt_div_pass :input').val('');
							$('#opt_div_message').fadeIn("slow").delay(3000).fadeOut("slow");
						}
					});
				}
					
		
		});
		
		//---------------------------------------------------------------------------------//
		//----------------------------END Options---------------------------------------//
		//---------------------------------------------------------------------------------//


  		// AUTOCOMPLETE<><><><><><><><><><><><><><><><><><><><><><><><><><><>><><><><><><><><><>
		$("#name_en").autocomplete( {
    		// source: arr
    		source: function(req, add){
    			 $.post("autocomplete.php", {action: 'autocomplete', name:'en',req: req, add: add},
    			 function(data){
    			 	l(data);
    			 	data = $.parseJSON(data);
    			 	add(data);
    			 }
    			 // return data;
    			)
    		},
    		select: function(event, ui){
    			l('click!');
    			l(ui.item.key);
    			$.post("autocomplete.php", {key: ui.item.key, action: 'get_auto_data'},
    				function(data){
    					data = $.parseJSON(data);
    					$('#name_ru').val(data[0].NameRu);
    					$('#link').val(data[0].Link);
    				});
    		}
        });
		$("#name_ru").autocomplete( {
    		// source: arr
    		source: function(req, add){
    			 $.post("autocomplete.php", {action: 'autocomplete', name:'ru',req: req, add: add},
    			 function(data){
    			 	l(data);
    			 	data = $.parseJSON(data);
    			 	add(data);
    			 }
    			)
    		},
    		select: function(event, ui){
    			$.post("autocomplete.php", {key: ui.item.key, action: 'get_auto_data'},
    				function(data){
    					data = $.parseJSON(data);
    					$('#name_en').val(data[0].NameEn);
    					$('#link').val(data[0].Link);
    				});
    		}
        });
        // AUTOCOMPLETE<><><><><><><><><><><><><><><><><><><><><><><><><><><>><><><><><><><><><><><><><>
  	}); 
</script>
	<div id='conteiner'>
	<? 
	// echo $state;	
	// error_reporting(E_ALL);
	if($_GET['statistic'] == 1){
		// Все существующие тэги
		$all_arr_tags = array('Боевик','Детектив','Драма','История','Комедия',
				 'Мелодрама','Приключения','Спорт','Триллер','Ужасы',
				 'Фантастика','Фэнтези','Русский');
		$tags_arr = getTagsCount($login, $all_arr_tags);
		PaintTagsCount($tags_arr, $all_arr_tags);
		echo "<div id='content'><div class='chart'><img src='chart1.png'/></div></div></div></div>";
		footer();
		exit;
	}
	if(!empty($_GET['name_ru'])){
		$data_name = getSerialByName(urldecode($_GET['name_ru']), true);
		echo PaintTable2($data_name['Header'],$data_name['Fields'],$data_name['Res'],$data_name['Class'],$data_name['Status']);
		echo "</div></div>";
		footer();
		exit;
	}
	if(!empty($_GET['name_en'])){
		$data_name = getSerialByName(urldecode($_GET['name_en']));
		echo PaintTable2($data_name['Header'],$data_name['Fields'],$data_name['Res'],$data_name['Class'],$data_name['Status']);
		echo "</div></div>";
		footer();
		exit;
	}

	if(!empty($_GET['tag'])){
			echo "<div id='content'><div style='margin-left:30px;'><a class='tag_link' href='index.php?tag=Боевик'>Боевик</a>
			<a class='tag_link' href='index.php?tag=Детектив'>Детектив</a>
			<a class='tag_link' href='index.php?tag=Драма'>Драма</a>
			<a class='tag_link' href='index.php?tag=История'>История</a>
			<a class='tag_link' href='index.php?tag=Комедия'>Комедия</a>
			<a class='tag_link' href='index.php?tag=Криминал'>Криминал</a>
			<a class='tag_link' href='index.php?tag=Мелодрама'>Мелодрама</a>
			<a class='tag_link' href='index.php?tag=Приключения'>Приключения</a>
			<a class='tag_link' href='index.php?tag=Спорт'>Спорт</a>
			<a class='tag_link' href='index.php?tag=Триллер'>Триллер</a>
			<a class='tag_link' href='index.php?tag=Ужасы'>Ужасы</a>
			<a class='tag_link' href='index.php?tag=Фантастика'>Фантастика</a>
			<a class='tag_link' href='index.php?tag=Фэнтези'>Фэнтези</a>
			<a class='tag_link' href='index.php?tag=Русский'>Русский</a>
			</div></div>
			<br>";
		$data_tag = getSerialsByTag($_GET['tag']);
		echo PaintTable2($data_tag['Header'],$data_tag['Fields'],$data_tag['Res'],$data_tag['Class'],$data_tag['Status']);
		echo "</div></div>";
		footer();
		exit;
	}

	if( !empty($_GET['login']) ){
		// echo 'Paint Data from login'.$_GET['login'];
		getDataFromLogin($_GET['login'], isUserFriend($login, $_GET['login']));

		$data = getUserContent_Now($_GET['login']);
		$fields = array('Название(En)','Название(Ru)','Остановился на','Оценка','Комментарий','Ссылка','Теги');
		$class = array('NameEn','NameRu','Sems','Stars','Comment','link','Tags','Min');
		echo PaintTable2($data['Header'],$fields,$data['Res'],$class,$data['Status']);

		$data = getUserContent_Will($_GET['login']);
		$fields = array('Название(En)','Название(Ru)','Остановился на','Оценка','Комментарий','Ссылка','Теги');
		$class = array('NameEn','NameRu','Sems','Stars','Comment','link','Tags','Min');
		echo PaintTable2($data['Header'],$fields,$data['Res'],$class,$data['Status']);

		$data = getUserContent_All($_GET['login']);
		$fields = array('Название(En)','Название(Ru)','Остановился на','Оценка','Комментарий','Ссылка','Теги');
		$class = array('NameEn','NameRu','Sems','Stars','Comment','link','Tags','Min');
		echo PaintTable2($data['Header'],$fields,$data['Res'],$class,$data['Status']);

		$data = getUserContent_Notlike($_GET['login']);
		$fields = array('Название(En)','Название(Ru)','Остановился на','Оценка','Комментарий','Ссылка','Теги');
		$class = array('NameEn','NameRu','Sems','Stars','Comment','link','Tags','Min');
		echo PaintTable2($data['Header'],$fields,$data['Res'],$class,$data['Status']);
		echo '</div></div>';
		footer();

		exit;
	}
	if(($_GET['users'] != 1) and ($_GET['users'] != 2)){
		$data = getUserContent_Now($login);
		echo PaintTable2($data['Header'],$data['Fields'],$data['Res'],$data['Class'],$data['Status']);

		$data = getUserContent_Will($login);
		echo PaintTable2($data['Header'],$data['Fields'],$data['Res'],$data['Class'],$data['Status']);

		$data = getUserContent_All($login);
		echo PaintTable2($data['Header'],$data['Fields'],$data['Res'],$data['Class'],$data['Status']);

		$data = getUserContent_Notlike($login);
		echo PaintTable2($data['Header'],$data['Fields'],$data['Res'],$data['Class'],$data['Status']);
		echo "</div></div>";
		footer();

		exit;

		
	}
	if($_GET['users'] == 1){
		// echo "Show Users $login";
		echo "<div id='content'>";
		getUsers($login);
		echo "</div></div></div>";
		footer();
		exit;
	}
	if($_GET['users'] == 2){
		echo "<div id='content'>";
		getUsers($login, true, getFriendsList($login));
		echo "</div></div></div>";
		footer();
	}

	// echo '<footer>raymanos - 2013</footer>';
	// footer();
	?>
	</div>
</body>
</html>