<?php
session_start();
$token = bin2hex(random_bytes(20));
$_SESSION['token'] = $token;
?>
<?php
require_once __DIR__ . '/check/login_checker.php';
require_once __DIR__ . '/check/input_checker.php';
require_once __DIR__ . '/check/replacement_checker.php';
require_once __DIR__ . '/dataaccess/employeePDO.php';

id_checker($_GET['id']);


try {
    // 取得した更新内容を各変数に代入
    $id = $_GET['id'];

    // データベース接続関数の呼び出し
    $dbh = db_open();

    // 削除したい社員情報の取得
    $message = delete_employee($dbh, $id);

    echo '<p>データが削除されました。<br><a href="index.php">メインメニュー</a>に戻る</p>';
    return $message;
} catch (PDOException $e) {
    echo "エラー!: " . stringHTML($e->getMessage()) . "<br>";
    exit;
}
?>
<?php require_once  __DIR__ .'/inc/footer.php';	//フッターを読み込む