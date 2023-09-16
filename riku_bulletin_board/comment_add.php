<?php
session_start();
require('dbconnect.php');
 
// 1時間経っていたらログイン画面へ戻る
if (isset($_SESSION['id']) && ($_SESSION['time'] + 3600 > time())) {
    $_SESSION['time'] = time();
 
    $members=$db->prepare('SELECT * FROM members WHERE id=?');
    $members->execute(array($_SESSION['id']));
    $member=$members->fetch();

} else {
    header('Location: login.php');
    exit();
}

$res_id = $_GET['post_id'];
//echo '入力されたお名前は『'.$res_id.'』です。';

if (!empty($_POST)) {
    if (isset($_POST['token']) && $_POST['token'] === $_SESSION['token']) {
        $post2=$db->prepare('INSERT INTO comments SET c_created_by=?, comment=?, res_id=?, c_created=NOW()');
        $post2->execute(array($member['id'] , $_POST['post'], $res_id));

        $url = 'comment_add.php?post_id='.$res_id;
        header( "HTTP/1.1 301 Moved Permanently" );
        header( "Location: ${url}" ); 

        exit();
    } else {
        header('Location: login.php');
        exit();
    }
}

$TOKEN_LENGTH = 16;
$tokenByte = openssl_random_pseudo_bytes($TOKEN_LENGTH);
$token = bin2hex($tokenByte);
$_SESSION['token'] = $token;

$posts=$db->query('SELECT m.name, p.* FROM members m  JOIN posts p ON m.id=p.created_by ORDER BY p.created DESC');
$comments=$db->query('SELECT m.name, c.* FROM members m  JOIN comments c ON m.id=c.c_created_by ORDER BY created DESC');

$stmt = $db->prepare('SELECT members.name, comments.*, posts.* FROM comments LEFT OUTER JOIN posts ON posts.id=comments.res_id LEFT OUTER JOIN members ON members.id=comments.c_created_by WHERE res_id=?');
$stmt->bindValue(1,$res_id,PDO::PARAM_INT);
$stmt->execute();
$uni1 = $stmt->fetchAll(PDO::FETCH_ASSOC);

//print_r($uni1);

$stmt2 = $db->prepare('SELECT p.* FROM posts p WHERE id=?');
$stmt2->bindValue(1,$res_id,PDO::PARAM_INT);
$stmt2->execute();
$uni2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

?>



<!DOCTYPE html>
<html lang="ja">

<head>
	<title>コメント記入画面</title>
</head>

<body>

	<h3><?php echo ('☆['.$uni2[0]['post'].']へのコメント☆'); ?></h3>

    <form method="post"  action='' >

        <input type="hidden" name="token" value="<?=$token?>">
        <?php if (isset($error['login']) &&  ($error['login'] =='token')): ?>
            <p class="error">不正なアクセスです。</p>
        <?php endif; ?>

        <div>
            <textarea name="post" cols='50' rows='10'><?php echo htmlspecialchars($comment??"", ENT_QUOTES); ?></textarea>
        </div>
        
        <input type="submit" value="コメントする" class="button02" >

    </form>
    

    <?php foreach($uni1 as $uni): ?>


<div class="comment">
		
    <?php echo htmlspecialchars($uni['comment'], ENT_QUOTES); ?> | 	

		<span class="name">
			<!-- 名前と時間 -->
			<?php echo htmlspecialchars($uni['name'], ENT_QUOTES); ?> | 
			<?php echo htmlspecialchars($uni['c_created'], ENT_QUOTES); ?> | 
			
			<!-- 削除 -->
			<?php if($_SESSION['id'] == $uni['c_created_by']): ?>

			[<a href="delete_comment.php?id=<?php echo htmlspecialchars($uni['c_id'], ENT_QUOTES); ?>">削除</a>]
			<?php endif; ?>	

</div>

<?php endforeach; ?>		

<br>
<span class="return"><a href="post.php">掲示板に戻る</a></span>

</body>
</html>