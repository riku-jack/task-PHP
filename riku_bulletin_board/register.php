<?php
//登録ファイルの読み込み
session_start();
require('dbconnect.php');

//クロスサイトリクエストフォージェリ（CSRF）対策
$_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32));
$token = $_SESSION['token'];
//クリックジャッキング対策
header('X-FRAME-OPTIONS: SAMEORIGIN');

//成功・エラーメッセージの初期化
$errors = array();

if(empty($_GET)) {
	header("Location: signup_mail.php");
	exit();
}else{
	//GETデータを変数に入れる
	$urltoken = isset($_GET["urltoken"]) ? $_GET["urltoken"] : NULL;
	//メール入力判定
	if ($urltoken == ''){
		$errors['urltoken'] = "トークンがありません。";
	}else{
		try{
			// DB接続	
			//flagが0の未登録者 or 仮登録日から24時間以内
			$sql = "SELECT email FROM pre_members WHERE urltoken=(:urltoken) AND flag =0 AND date > now() - interval 24 hour";
      $stm = $db->prepare($sql);
			$stm->bindValue(':urltoken', $urltoken, PDO::PARAM_STR);
			$stm->execute();
			
			//レコード件数取得
			$row_count = $stm->rowCount();
			
			//24時間以内に仮登録され、本登録されていないトークンの場合
			if( $row_count ==1){
				$email_array = $stm->fetch();
				$email = $email_array["email"];
				$_SESSION['email'] = $email;
			}else{
				$errors['urltoken_timeover'] = "このURLはご利用できません。有効期限が過ぎたかURLが間違えている可能性がございます。もう一度登録をやりなおして下さい。";
			}
			//データベース接続切断
			$stm = null;
		}catch (PDOException $e){
			print('Error:'.$e->getMessage());
			exit();
		}
	}
}


//本登録の処理
//空欄入力のときエラーメッセージ
if (!empty($_POST)){
	//名前入力エラー
	  if($_POST['name'] == ""){
				$error['name'] = 'blank';
		}
	//パスワード入力エラー
		if($_POST['password'] == ""){
				$error['password'] = 'blank';
		}
	//パスワード再入力のエラー
		if($_POST['password2'] == ""){
				$error['password2'] = 'blank';
		}
	//パスワード短すぎるエラー
		if (strlen($_POST['password'])< 6) {
			$error['password'] = 'length';
		}
	// 再入力間違ってるエラー
		if (($_POST['password'] != $_POST['password2']) && ($_POST['password2'] != "")) {
				$error['password2'] = 'difference';
		}
  //エラーがなければ確認画面へ
		if (empty($error)) {
			$_SESSION['join'] = $_POST;
			header('Location: confirm.php');
			exit();
		}
}

?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <title>本登録画面</title>
	<style>
		.error { color: red;font-size:0.8em; }
	</style>
</head>
<body>
	<h1>本登録画面</h1>

	<form action="" method="post" class="registrationform">
		
		<label>
			名前
			<input type="text" name="name" style="width:150px" value="<?php echo $_POST['name']??""; ?>">

			<?php if (isset($error['name']) && ($error['name'] == "blank")): ?>
			<p class="error">名前を入力してください</p>
			<?php endif; ?>

		</label>
		
		<br>
		
		<label>
			email:<?=htmlspecialchars($_SESSION['email'], ENT_QUOTES)?>
		</label>
		
		<br>
 
		<label>
			パスワード
			<input type="password" name="password" style="width:150px" value="<?php echo $_POST['password']??""; ?>">
			<?php if (isset($error['password']) && ($error['password'] == "blank")): ?>
			<p class="error"> パスワードを入力してください</p>
			<?php endif; ?>
			<?php if (isset($error['password']) && ($error['password'] == "length")): ?>
			<p class="error"> 6文字以上で指定してください</p>
			<?php endif; ?>
		</label>
		
		<br>
		
		<label>
			パスワード再入力<span class="red">*</span>
			<input type="password" name="password2" style="width:150px">
			<?php if (isset($error['password2']) && ($error['password2'] == "blank")): ?>
			<p class="error"> パスワードを入力してください</p>
			<?php endif; ?>
			<?php if (isset($error['password2']) && ($error['password2'] == "difference")): ?>
			<p class="error"> パスワードが上記と違います</p>
			<?php endif; ?>
		</label>
		
		<br>
		
		<input type="submit" value="確認する" class="button">

	</form>

	<a href="login.php">ログイン画面に戻る</a>

</body>
</html>