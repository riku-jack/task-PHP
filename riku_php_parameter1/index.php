<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
</head>
<body>
  <p><?php 

      function B($fruit,$price) {
          $sentence = $fruit. '1つの値段は'. $price. '円です。<br>';
          return $sentence;
      }

      function A(){
          echo B('リンゴ',120);    
      }
      
      A();
      

  ?></p>
</body>
</html>