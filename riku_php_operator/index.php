<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
</head>
<body>
  <p><?php
    //算術演算子
      $plus = 10 + 20;
      var_dump($plus);

      $minus = 10 - 5;
      var_dump($minus);

      $time = 10 * 3;
      var_dump($time);

      $divide = 100 / 5;
      var_dump($divide);

    //代入演算子
      echo "<br>";
      $baseNum = 100;

      $baseNum += 10;
      var_dump($baseNum);

      $baseNum -= 30;
      var_dump($baseNum);

      $baseNum *= 10;
      var_dump($baseNum);

      $baseNum /= 8;
      var_dump($baseNum);

      //比較演算子
        echo "<br>";
        var_dump(10 > 30);
        var_dump(10 < 50);

      //等価演算子
        echo "<br>";
        var_dump(10 != "10"); 
        var_dump(10 === 5*2); 
  
  ?></p>
</body>
</html>