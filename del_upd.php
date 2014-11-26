<?
header('Content-Type: text/html;charset=utf-8');
session_start();
include 'connect_db.php';
include 'func.php';

if(user()){
	$login = $_SESSION['login'];
	$id = (int)$_POST['id'];

	if(isset($_FILES['ava_file'])){
		$tempFile = $_FILES['ava_file']['tmp_name'];
		// $filename = $_FILES['ava_file']['name'];
		// $ext = pathinfo($filename);//jpg
		// echo $ext['extension'];
		// $source = $_FILES['ava_file']['tmp_name'];

		$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
		$fileParts = pathinfo($_FILES['ava_file']['name']);
		$targetFile = 'avatars/'.$login.'.'.$fileParts['extension'];
		if (in_array($fileParts['extension'],$fileTypes)) {
			move_uploaded_file($tempFile,$targetFile);
			$sql = "update users set avatar='$targetFile' where login='$login'";
			mysql_query($sql) or die(mysql_error());
			echo '1';
		} 
		else {
			echo 'Invalid file type.';
		}
	}

	if($_POST['action'] == 'del_acc'){
		if(deleteAccount($login)){
			echo 'true';
		}
		else{
			echo 'false';
		}
	}

	if($_POST['action'] == 'status_friend'){
		$user_login = clearData($_POST['user_login']);
		echo isUserFriend($login, $user_login);
	}

	if($_POST['action'] == 'add_del_friend'){
		// echo $_POST['user_login'];
		$user_login = clearData($_POST['user_login']);
		if(isUserFriend($login, $user_login)){
			if(delUserFriend($login, $user_login)){
				// echo "Удалено успешно!";
				echo '{"action":"deleted"}';
			}

			else
				echo '{"action":"error"}';
		}
		else{
			if(addUserFriend($login, $user_login))
				echo '{"action":"added"}';
			else
				echo '{"action":"error"}';
		}
	}

	if($_POST['action'] == 'change_pass'){
		$pass_old = clearData($_POST['opt_password_old']);
		$pass_new = clearData($_POST['opt_password_new']);
		$pass_new2 = clearData($_POST['opt_password_new2']);
		// echo "$pass_old - $pass_new - $pass_new2";
		if( ($pass_new == $pass_new2) or ($pass_old != "") ){
			// echo 'if1';
			$sql = "select salt,password from users where login='$login'";
			$res = mysql_query($sql) or die(mysql_error());
			$data = mysql_fetch_assoc($res);
			$salt = $data['salt'];
			$password_db = $data['password'];
			// echo "<br>$salt - $password_db";
			$password_db_new = md5(md5($pass_old).$salt);
			// echo "<br>$password_db_new";
			if($password_db == $password_db_new){
				// echo 'Password is match';
				$salt = mt_rand(100, 999);
				$password = md5(md5($pass_new).$salt);
				$sql = "update users set password='$password',salt='$salt' where login='$login'";
				mysql_query($sql) or die(mysql_error());
				// echo 'true';
				$json = '{"status":1, "message":"Пароль успешно изменен!"}';
				echo $json;
			}
			else{
				// echo 'Password not match';
				$json = '{"status":0, "message":"Ошибка! Нужно правильно ввести ваш текущий пароль, пароли не совпадают."}';
				echo $json;
			}
			
		}
		else {
			// echo 'Password empty';
			$json = '{"status":0, "message":"Ошибка! Пароль пуст."}';
			echo $json;
		}

	};

	if($_POST['action'] == 'feedback'){
		$to      = 'raymanos00@gmail.com';
		$title = "$login - SerialchikI";
		$mess = wordwrap($_POST['message'], 70);
		// $from='test@test.ru'; 
        // функция, которая отправляет наше письмо. 
        echo mail($to, $title, $mess); 
	}
	if($_POST['action'] == 'opt_load'){
		$sql = "select name,last_name,avatar,mail,private from users where login = '$login'";
		$res = mysql_query($sql) or die(mysql_error());
		$data = mysql_fetch_assoc($res);
		// print_r($data);
		echo json_encode($data);
	}
	if($_POST['action'] == 'opt_save'){
		$first_name = clearData($_POST['first_name']);
		$last_name = clearData($_POST['last_name']);
		$email = clearData($_POST['email']);
		$private = (int)$_POST['opt_private'];

		$sql = "update users set name='$first_name',last_name='$last_name',mail='$email',private=$private where login='$login'";
		mysql_query($sql) or die(mysql_error());
		echo 'true';
		// echo "$first_name - $last_name - $email - $private";
		// print_r($_FILES);
	}

	if($_POST['action'] == 'del'){
		$sql = "delete from $login where id=$id";
		mysql_query($sql) or die(mysql_error());
		echo 'true';
	}
	if($_POST['action'] == 'upd'){
		$NameEn = clearData($_POST['NameEn']);
		$NameRu = clearData($_POST['NameRu']);
		$Stars = clearData($_POST['Stars']);
		$Status = clearData($_POST['Status']);
		$Season = (int)$_POST['Season'];
		$Episode = (int)$_POST['Episode'];
		$Min = (int)$_POST['Min'];
		$Sec = (int)$_POST['Sec'];
		$SEMS = "Сезон $Season Эпизод $Episode Время $Min:$Sec";
		$Groupa = getSt($Status);
		$Comment = clearData($_POST['Comment']);
		$Tags = clearData($_POST['tags']);
		$Link = clearData($_POST['Link']);

		$sql = "update $login set NameEn='$NameEn',NameRu='$NameRu',Stars='$Stars',
								  Status='$Status',Season='$Season',Episode='$Episode',
								  Min='$Min',Sec='$Sec',SEMS='$SEMS',Groupa='$Groupa',
								  Comment='$Comment',Link='$Link',Tags='$Tags' where id=$id;";
		mysql_query($sql) or die(mysql_error());
		echo 'true';
	}
}
else{
	echo 'net usera';
}
?>