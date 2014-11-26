<?php
include 'connect_db.php';

$data = $_POST;
$param = $data['req']['term'];

if($_POST['action'] == 'get_auto_data'){
	$key = $_POST['key'];
	$fetch = mysql_query("SELECT NameEn,NameRu,Link FROM serial_db where id=$key");
	while($row = mysql_fetch_array($fetch)){
		$return_arr[] = array('NameEn' => $row['NameEn'],'NameRu' => $row['NameRu'],'Link'   => $row['Link']);
	}
echo json_encode($return_arr);
}

if($_POST['name'] == 'en'){
	$fetch = mysql_query("SELECT id,NameEn FROM serial_db WHERE NameEn LIKE '%" . strval($param) . "%' ORDER BY NameEn LIMIT 10");

  	while ($row = mysql_fetch_array($fetch)){
  		$return_arr[] = array(
  			'key' => $row['id'],
  			'value'=> $row['NameEn']
  			);
  	}
echo json_encode($return_arr);
}

if($_POST['name'] == 'ru'){
	$fetch = mysql_query("SELECT id,NameRu FROM serial_db WHERE NameRu LIKE '%" . strval($param) . "%' ORDER BY NameEn LIMIT 10");

  	while ($row = mysql_fetch_array($fetch)){
  		$return_arr[] = array(
  			'key' => $row['id'],
  			'value'=> $row['NameRu']
  			);
  	}
echo json_encode($return_arr);
}

?>