<?php
session_start();
require_once __DIR__ . '/check/input_checker.php';
require_once __DIR__ . '/dataaccess/employeePDO.php';
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>人事システムログインページ</title>
</head>

<body>
  <h1>人事システムにようこそ！</h1>
  <form method="post" action="login.php">
    <p>
      <label>ユーザID:</label>
      <input type="text" name="userID">
    </p>
    <p>
      <label>パスワード:</label>
      <input type="password" name="password">
    </p>
    <p>
      <input type="submit" value="ログイン">
    </p>
  </form>

  <?php
  if (!empty($_SESSION['login'])) {
    echo "ログイン済です<br>";
    echo "<a href=index.php>メインメニュー一覧に戻る</a>";
    exit;
  }
  if ( empty($_POST['userID']) || empty($_POST['password'])) {
    echo "社員IDとパスワードを入力してください。";
    exit;
  }
  try {
    // データベースに接続
    $dbh = db_open();
    $userID =$_POST['userID'];
    $result = login_employee($dbh,$userID);
    if (!$result) {
      echo 'ログインに失敗しました。';
      exit;
    }
    if ($_POST['password'] === $result['password']) {
      session_regenerate_id(true);
      $_SESSION['login'] = true;
      header('Location: index.php');
    } else {
      echo 'ログインに失敗しました。(2)';
    }
  } catch (PDOException $e) {
    echo '<p>システムエラーが発生しました。<br>システム管理者にお問い合わせください。</p>: ' . stringHTML($e->getMessage());
    exit;
  }

  header('Location: ./');
  ?>
</body>
</html>