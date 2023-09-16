<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
</head>
<body>
    <?php

        $age = 33;
        $gender = "女性";
        
        if($gender === "男性"){
          if($age === 25 || $age ===42 || $age === 61){
            echo "厄年です";
          }
          else{
            echo "厄年ではありません";
          }
        }
        elseif($gender === "女性"){
          if($age === 19 || $age ===33 || $age === 37){
            echo "厄年です";
          }
          else{
            echo "厄年ではありません";
          }
        }

    ?>
</body>
</html>