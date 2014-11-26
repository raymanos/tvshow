<?php
//Добавить поле hash и проверить login
//Русские символы в базе
//Подумать за pid и hash
include 'connect_db.php';
include 'func.php';
// print_r($_POST);

 if($_POST['action'] == 'login'){//if(isset($_POST['enter'])){
 	//Enter
 	if(!empty($_POST['login']) and (!empty($_POST['password']))) {

 		$login = clearData($_POST['login']); //без ClearData
 		$password  = clearData($_POST['password']);

 		$sql = "select login,password,pid,salt from users where login='$login'";
 		$res = mysql_query($sql) or die(mysql_error());

 		if(mysql_num_rows($res) > 0){
 			$data = mysql_fetch_array($res);
 			$password_bd = $data['password'];
 			$login_bd = $data['login'];
 			$salt = $data['salt'];
 			if(($login == $login_bd) and (md5(md5($password).$salt) == $password_bd) ){
 				session_start();
 				$_SESSION['login'] = $login;
 				$_SESSION['password'] = $password;
 				//При входе нужно в любом случае генерить новый pid
 				$pid = md5($login.$salt.uniqid());
 				$sql = "update users set pid='$pid' where login='$login'";
 				mysql_query($sql) or die(mysql_error());	
 				//Если стоит галочка запомнить меня, то кидаем куку			
 				if(isset($_POST['remember'])){	
 					setcookie('pid',$pid,time()+5000);
 				}
 				//пароль подходит все норм
 				echo 'true';
 				//header('Location: index.php');
 				//exit();
 			}
 			//пароль не подходит
 			else{
 				// echo 'tut2';
 				echo 'false';
 				// header('Location: index.php');
 			}
 		}
 		else{
 			// echo 'tut3';
 			// header('Location: index.php');
 			echo 'false';
 		}
 	}
 }
 if($_POST['action'] == 'registr'){// if(isset($_POST['registr'])){
 	// print_r($_POST);
 	// echo 'Регистрация';
 	if(!empty($_POST['login']) and !empty($_POST['password'])) {
 		$login = clearData($_POST['login']);
 		$password = clearData($_POST['password']);

 		//Узнаем, не было ли такого юзера уже
 		$count = mysql_query("select login from `users` where `login`='".$login."'");
 		//Если 0, значит нету таких логинов
 		if(mysql_num_rows($count) == 0){
 			$email = clearData($_POST['email']);
 			$name = clearData($_POST['name']);
 			$last_name = clearData($_POST['last_name']);
 			$private = 0;
 			if(isset($_POST['private'])){
 				$private = 1;
 			}
 			$salt = mt_rand(100, 999);
			$tm = time();
			$password = md5(md5($password).$salt);
			$pid = md5($login.$salt.uniqid());
			if( ($_FILES['avatar']['size']) != 0 ) {
				$filename = $_FILES['avatar']['name'];
				$ext = pathinfo($filename);//jpg
				// echo $ext['extension'];
				$source = $_FILES['avatar']['tmp_name'];
				$target = 'avatars/'.$login.'.'.$ext['extension'];
				move_uploaded_file($source, $target);
			}
			else{
				$target = 'avatars/def_avatar.png';
			}
			mysql_query("insert into `users` (`login`,
											  `password`,
											  `salt`,
											  `mail`,
											  `reg_date`,
											  `page`,
											  `name`,
											  `last_name`,
											  `private`,
											  `pid`,
											  `avatar`) 
									values ('".$login."',
										    '".$password."',
										    '".$salt."',
										    '".$email."',
										    '".$tm."',
										    '".$page."',
										    '".$name."',
										    '".$last_name."',
										    '".$private."',
										    '".$pid."',
										    '".$target."')");
			//Создание таблицы с контентом юзера
			$sql = 'CREATE TABLE IF NOT EXISTS '.$login.' (
						`id` int(11) not null auto_increment, 
						`NameEn` varchar(100), 
						`NameRu` varchar(100), 
						`Groupa` int(3),
						`Season` varchar(5),
						`Episode` varchar(5),
						`Min` varchar(5),
						`Sec` varchar(5),
						`SEMS` varchar(30),
						`Ended` int(1),
						`Stars` int(3), 
						`Status` varchar(10), 
						`Link` varchar(50),		
						`Tags` varchar(50),		
						`Comment` varchar(255), 
						PRIMARY KEY (`id`),
						UNIQUE id (`id`)
					)';
			mysql_query($sql) or die(mysql_error());
			$sql = "insert friends (login) values ('$login')";
			mysql_query($sql) or die(mysql_error());
			session_start();
 			$_SESSION['login'] = $login;
 			$_SESSION['pass'] = $password;
 			echo "true";
 			// header('Location: index.php');
 		}
 		else{
 			//Такой логин уже есть в базе!
 			echo "duplicate_login";
 			// header('Location: registr.php');
 		}
 		

 	}
 }

?>