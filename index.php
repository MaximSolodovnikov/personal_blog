<?php 
header("Content-Type: text/html; charset='utf-8'");
$mysqli = new mysqli('localhost', 'salomuG', 'salomuG', 'blog') or die("Cannot to connect to Database" . mysql_error());
$mysqli->set_charset('utf8');
mb_internal_encoding('UTF-8');
$act = $_GET['act'] ? $_GET['act'] : 'list';

switch($act) {
	
	case "list":
	$records = array();
	$sql = $mysqli->query("SELECT * FROM articles");
	while($row = $sql->fetch_assoc()){
		$row['date'] = date('Y-m-d / H:i:s');
		
		if (mb_strlen($row['text']) > 100) {
			
			$row['text'] = mb_substr(strip_tags($row['text']), 0, 300) . '...';
		}
		$records[] = $row;
	}
		require('template/list.php');
	break;
	
	case 'view-entry':
	if ( ! isset($_GET['id'])) die("Missing id parameter");
	$id = intval($_GET['id']);
	$row = $mysqli->query("SELECT * FROM articles WHERE id = $id")->fetch_assoc();
	if ( ! $row) die("No such entry");
		require('template/entry.php');
	break;
	
}

