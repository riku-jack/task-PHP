<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
</head>
<body>
  <p><?php 

      function A() {
        $sumple = '外部ファイルに作成された関数が実行されました！';
        echo $sumple;
      }

      A();

  ?></p>
</body>
</html>