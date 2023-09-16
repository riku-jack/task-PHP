<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
</head>
<body>
  <p><?php 

    $animals = ["こぶた","たぬき","きつね","ねこ"];

    foreach($animals as $animal){
      echo $animal."<br>";
    }
  
  ?></p>
</body>
</html>