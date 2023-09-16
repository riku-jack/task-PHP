<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
</head>
<body>
    <?php

        $tests = ["国語","算数","理科","社会"];
        
        $select = array_rand($tests);
        echo $tests[$select];
        echo "<br>";

        if($tests[$select] === "国語"){
          echo "japaneseが選択されました";
        }
        elseif($tests[$select] === "算数"){
          echo "mathが選択されました";
        }
        elseif($tests[$select] === "理科"){
          echo "scienceが選択されました";
        }
        elseif($tests[$select] === "社会"){
          echo "societyが選択されました";
        }

    ?>
</body>
</html>
