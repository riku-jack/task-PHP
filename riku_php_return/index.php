<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
</head>
<body>
  <p><?php 

      function A() {
        echo B();
      }

      function B(){
          $num1 = 6;
          $num2 = 5;
          return $num1 + $num2;

      }

      A();


  
  ?></p>
</body>
</html>