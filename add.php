<?php
header('Content-Type: text/html;charset=utf-8');
session_start();
include 'connect_db.php';
include 'func.php';



if(user()){
	$login = $_SESSION['login'];
	//get data from form(post)
	$name_en = clearData($_POST['name_en']);
	$name_ru = clearData($_POST['name_ru']);
	
	if((!empty($name_en) and (!empty($name_ru)))) {	
		$stars = clearData($_POST['stars']);
		$status = clearData($_POST['status']);
		$season = (int)$_POST['season'];
		$episode = (int)$_POST['episode'];
		$min = (int)$_POST['min'];
		$sec = (int)$_POST['sec'];
		$SEMS = "Сезон $season Эпизод $episode Время $min:$sec";
		$groupa = getSt($status);
		$link = clearData($_POST['link']);
		$tags = clearData($_POST['tags']);
		$comment = nl2br(clearData($_POST['comment']));

		$sql = "insert into $login (NameEn, 
									NameRu, 
									Stars, 
									Status, 
									Season, 
									Episode, 
									Min, 
									Sec, 
									SEMS, 
									Groupa, 
									Comment, 
									Tags,
									Link) 
							values ('$name_en',
								'$name_ru',
								'$stars',
								'$status',
								'$season',
								'$episode',
								'$min',
								'$sec',
								'$SEMS',
								'$groupa',
								'$comment',
								'$tags',
								'$link')";
		mysql_query($sql) or die(mysql_error());
		$sql = "insert ignore into serial_db (NameEn,NameRu,Link) values ('$name_en','$name_ru','$link')";
		mysql_query($sql) or die(mysql_error());
		echo 'true';
	}
	else{
		echo 'false';
	}
}
else 
	echo 'net usera';
?>