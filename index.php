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
		$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
		$limit = 1;
		$offset = ($page - 1) * $limit;
		$records = array();
		$pages_result = $mysqli->query("SELECT COUNT(*) AS cnt FROM articles")->fetch_assoc();
		$pages = $pages_result['cnt'];
		$sql = $mysqli->query("SELECT articles.*, COUNT(comments.id) AS comments 
							   FROM articles
							   LEFT JOIN comments ON articles.id = comments.entry_id
							   GROUP BY articles.id
							   ORDER BY date DESC
							   LIMIT $offset, $limit");
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
		$ENTRY = $mysqli->query("SELECT * FROM articles WHERE id = $id")->fetch_assoc();
		if ( ! $ENTRY) die("No such entry");
		$ENTRY['text'] = nl2br($ENTRY['text']);
		$ENTRY['text'] = htmlspecialchars($ENTRY['text']);
		
		$comments = array();
		
		$sql = $mysqli->query("SELECT * FROM comments WHERE entry_id = $id");
		while($row = $sql->fetch_assoc()){
			$row['date'] = date('Y-m-d / H:i:s');
			$row['text'] = nl2br(htmlspecialchars($row['text']));
			$row['author'] = htmlspecialchars($row['author']);
			$comments[] = $row;
		}
		require('template/entry.php');
	break;
	
	case "do-new-entry":
		$sql = $mysqli->prepare("INSERT INTO articles(author, title, date, text) VALUES(?, ?, ?, ?)");
		$date = date('Y-m-d');
		$sql->bind_param('ssss', $_POST['author'], $_POST['title'], $date, $_POST['text']);
		if($sql->execute()) {
			header("Location: .");
		} else {
			die("Cannot insert entry");
		}
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