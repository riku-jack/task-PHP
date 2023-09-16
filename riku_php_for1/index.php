<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
</head>
<body>
  <p><?php 

      for($i = 0; $i < 5; $i++){
        echo "おはようございます！";
      }

      echo "<br>";

      $num = 5;
      while($num>0){
        echo "こんばんは！";
        $num--;
      }
  
  ?></p>
</body>
</html>