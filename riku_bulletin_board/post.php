<?php
session_start();
//データベース接続
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
//ポストが空でなくトークン一致でデータベースに格納
if (!empty($_POST)) {
    if (isset($_POST['token']) && $_POST['token'] === $_SESSION['token']) {
        $post=$db->prepare('INSERT INTO posts SET created_by=?, post=?, created=NOW()');
        $post->execute(array($member['id'] , $_POST['post']));
        header('Location: post.php');
        exit();
    } else {
        header('Location: login.php');
        exit();
    }
}

$posts=$db->query('SELECT m.name, p.* FROM members m  JOIN posts p ON m.id=p.created_by ORDER BY p.created DESC');
$comments=$db->query('SELECT m.name, c.* FROM members m  JOIN comments c ON m.id=c.c_created_by ORDER BY c.c_created DESC');

$TOKEN_LENGTH = 16;
$tokenByte = openssl_random_pseudo_bytes($TOKEN_LENGTH);
$token = bin2hex($tokenByte);
$_SESSION['token'] = $token;

?>
 
<!DOCTYPE html>
<html lang="ja">
 
<body>
<!-- ★ログアウト★ -->
<header>
<div class="head">
<h1>掲示板</h1>
<span class="logout"><a href="login.php">ログアウト</a></span>
</div>
</header>
 
<form action='' method="post">
	<input type="hidden" name="token" value="<?=$token?>">
	<?php if (isset($error['login']) &&  ($error['login'] =='token')): ?>
		<p class="error">不正なアクセスです。</p>
	<?php endif; ?>
	<div class="edit">
		<p>
			<?php echo htmlspecialchars($member['name'], ENT_QUOTES); ?>さん、ようこそ
		</p>
		<textarea name="post" cols='50' rows='10'><?php echo htmlspecialchars($post??"", ENT_QUOTES); ?></textarea>
	</div>
 
	<input type="submit" value="投稿する" class="button02">
</form>
 
<br>

<!-- 今までの投稿内容を表示 -->
<?php foreach($posts as $post): ?>

	<div class="post">
		<!-- 投稿 -->
		<?php echo htmlspecialchars($post['post'], ENT_QUOTES); ?> | 

		<span class="name">
			<!-- 名前と時間 -->
			<?php echo htmlspecialchars($post['name'], ENT_QUOTES); ?> | 
			<?php echo htmlspecialchars($post['created'], ENT_QUOTES); ?> | 
			
			<!-- コメント -->
			<?php $res_id = $post['id']; ?>	
			[<a href="comment_add.php?post_id=<?php echo $res_id;?>">コメント</a>]

			<!-- 削除 -->
			<?php if($_SESSION['id'] == $post['created_by']): ?>
			[<a href="delete.php?id=<?php echo htmlspecialchars($post['id'], ENT_QUOTES); ?>">削除</a>]
			<?php endif; ?>
		</span>

	</div>

<?php endforeach; ?>

</body>
</html>