<!DOCTYPE html>
<html>
  <head>
    <title>HTMLのformからデータを受けとる</title>
    <meta charset="UTF-8">
  </head>
  <body>
    <form action="./receive.php" method="GET">
      <br>
      メールアドレス:<input type="text" name="mail">
      <br>
      パスワード:<input type="text" name="pass">
      <br>
      氏名:<input type="text" name="name">
      <br>
      住所:<input type="text" name="address">
      <br>
      電話番号:<input type="text" name="tel">
      <br>
      <input type="submit" value="送信">
      <br>
    </form>
  </body>
</html>