<?php
session_start(); 
header("Content-Type: text/html; charset='utf-8'");
$mysqli = new mysqli('localhost', 'salomuG', 'salomuG', 'blog') or die("Cannot to connect to Database" . mysql_error());
$mysqli->set_charset('utf8');
mb_internal_encoding('UTF-8');

define('IS_ADMIN', isset($_SESSION['IS_ADMIN']));

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
			$row['text'] = nl2br($row['text']);
			$row['text'] = htmlspecialchars($row['text']);
			$records[] = $row;
		}
		require('template/list.php');
	break;
	
	case 'view-entry':
		if ( ! isset($_GET['id'])) die("Missing id parameter");
		$id = intval($_GET['id']);
		$row = $mysqli->query("SELECT * FROM articles WHERE id = $id")->fetch_assoc();
		if ( ! $row) die("No such entry");
		$row['text'] = nl2br($row['text']);
		$row['text'] = htmlspecialchars($row['text']);
		require('template/entry.php');
	break;
	
	case 'login':
		require('template/login.php');
	break;
	
	case 'logout':
		unset($_SESSION['IS_ADMIN']);
		header("Location: .");
	break;
	
	case 'do-login':
		if($_POST['login'] == 'admin' && $_POST['password'] == '123') {
			$_SESSION['IS_ADMIN'] = TRUE;
			header('Location: .');
		} else {
			header('Location: ?act=login');
		}
	break;
	
	default:
	die("No such action.");
	
}