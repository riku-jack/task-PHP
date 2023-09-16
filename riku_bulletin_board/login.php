<?php
session_start();
require('dbconnect.php');
 
if (!empty($_POST)) {
    if (($_POST['email'] != '') && ($_POST['password'] != '')) {
        $login = $db->prepare('SELECT * FROM members WHERE email=?');
        $login->execute(array($_POST['email']));
        $member=$login->fetch();
	// 認証
        if ($member != false && password_verify($_POST['password'],$member['password'])) {
            
					  $_SESSION['id'] = $member['id'];
            $_SESSION['time'] =time();

            header('Location: post.php');
            exit();
        } else {
            $error['login']='failed';
        } 
    } else {
        $error['login'] ='blank';
    }
}
?>
 
<!DOCTYPE html>
<html lang="ja">
<head>
	<title>ログイン画面</title>
	<style>
		.error { color: red;font-size:0.8em; }
	</style>
</head>
<body>
	<h1>ログイン画面</h1>
	<form action='' method="post">
 
		<label>
			email
			<input type="text" name="email" style="width:150px" 
			value="<?php echo htmlspecialchars($_POST['email']??"", ENT_QUOTES); ?>">
			<?php if (isset($error['login']) && ($error['login'] =='blank')): ?>
			<p class="error">メールとパスワードを入力してください</p>
			<?php endif; ?>
 
			<?php if (isset($error['login']) && $error['login'] =='failed'): ?>
			<p class="error">メールかパスワードが間違っています</p>
			<?php endif; ?>
		</label>
		<br />
		<label>
			パスワード
			<input type="password" name="password" style="width:150px" 
			value="<?php echo htmlspecialchars($_POST['password']??"", ENT_QUOTES); ?>">
		</label>
 
		<div class="login2">
			<input type="submit" value="ログインする" class="button">
		</div>
 
	</form>
    <a href="register.php">ユーザ登録する</a>
 
</body>
</html>