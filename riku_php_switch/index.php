<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
</head>
<body>
    <?php

        $month = 11;

        switch($month){
            case 1 :
              echo "31日";
              break;
            case 2 :
              echo "28日";
              break;
            case 3 :
              echo "31日";
              break;
            case 4 :
              echo "30日";
              break;
            case 5 :
              echo "31日";
              break;
            case 6 :
              echo "30日";
              break;
            case 7 :
              echo "31日";
              break;
            case 8 :
              echo "31日";
              break;
            case 9 :
              echo "30日";
              break;
            case 10 :
              echo "31日";
              break;
            case 11 :
              echo "30日";
              break;
            case 12 :
              echo "31日";
              break;
            default:
              echo '値が無効です';
        }
        

    ?>
</body>
</html>