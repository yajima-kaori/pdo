<?php

require_once('config.php');
require_once('functions.php');

session_start();


if(!empty($_SESSTION['id']))
{
  header('Location: login_index.php');
  exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $name = $_POST['name'];
    $password = $_POST['password'];

    $errors = array();

  //バリデーション
  if($name == '')
  {
     $errors['name'] = 'ユーザーネームは未入力です｡';
  }
  if($password == '')
  {
    $errors['password'] = 'パスワードは未入力です｡';
  }

  //バリデーション突破後
  if (empty($errors))
    {
      $dbh = connectDatabase();

      $sql = "select * from users where name = :name password = :password";
      $stmt = $dbh ->prepare($sql);

      $stmt->bindParam(":name",$name);
      $stmt->bindParam(":password",$password);

      $stmt->execute();

      $row = $stmt->fetch();

      var_dump($row);

    }
}



?>

<!DOCTYPE html>
<html>
  <head>
  <meta charset="UTF-8">
  <title>ログイン画面</title>
  </head>
  <body>
  <h1>ログイン画面です｡</h1>
  <form action="" method="post">
  ユーザネーム: <input type="text" name="name">
        <?php if ($errors['name']) : ?>
            <?php echo h($errors['name']) ?>
        <?php endif; ?>
        <br>
        パスワード: <input type="text" name="password">
        <?php if ($errors['password']) : ?>
            <?php echo h($errors['password']) ?>
        <?php endif; ?>
<br>
  <input type="submit" value="ログイン">
  </form>
  <a href="signup.php">新規ユーザーは登録はこちら</a>
  </body>
</html>