<?php
  //function dbconnection() {
   // global $pdo, $e;

   
   try {
      // データベースに接続
      $db = new PDO(
        'mysql:dbname=forum;host=localhost;charset=utf8mb4',
        'root','',
        [
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
    } catch (PDOException $e) {
      //エラー発生時
      echo $e->getMessage();
      exit;
    }


  //}
?>