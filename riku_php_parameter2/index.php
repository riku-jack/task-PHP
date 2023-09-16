<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
</head>
<body>
  <p><?php 

    $hashira = [
      "水柱" => "冨岡義勇",
      "蟲柱" => "胡蝶しのぶ",
      "炎柱" => "煉獄杏寿郎",
      "音柱" => "宇髄天元",
      "岩柱" => "悲鳴嶼行冥",
      "恋柱" => "甘露寺蜜璃",
      "霞柱" => "時透無一郎",
      "蛇柱" => "伊黒小芭内"
  ];

  function A($array){
      foreach($array as $name){
          echo $name;
          echo "<br>";
      }
  }

  A($hashira);


     

  ?></p>
</body>
</html>