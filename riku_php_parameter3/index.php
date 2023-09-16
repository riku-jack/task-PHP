<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
</head>
<body>
  <p><?php 

    function A($val){

        if(is_array($val)){
              echo "配列が渡されました！";
          }
          else{
              echo "配列が渡されていません！";
          }

    }

    $num = [1,2,3];

    A($num);


  ?></p>
</body>
</html>