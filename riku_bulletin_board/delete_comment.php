
<?php 
session_start();
require('dbconnect.php'); 
if (isset($_SESSION['id'])) {
	$c_id = $_REQUEST['id'];
	$posts = $db->prepare('SELECT * FROM comments WHERE c_id=?');
	$posts -> execute(array($c_id)); 
	$post = $posts->fetch();
	
	$res_id = $post['res_id'];
	$url = 'comment_add.php?post_id='.$res_id;

	if ($post['c_created_by'] == $_SESSION['id']) {
		header('Location: post.php');
		$del = $db->prepare('DELETE FROM comments WHERE c_id=?');
		$del->execute(array($c_id));

	}
}

header( "HTTP/1.1 301 Moved Permanently" );
header( "Location: ${url}" ); 

exit();
?>