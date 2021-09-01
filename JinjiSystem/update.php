<?php
require_once __DIR__ . '/check/token_checker.php';
require_once __DIR__ . '/check/replacement_checker.php';
require_once __DIR__ . '/check/input_checker.php';
require_once __DIR__ . '/dataaccess/employeePDO.php';

// IDの入力チェック
id_checker($_POST['id']);
?>

<?php 
	$page_name = '社員情報更新ページ';
	require_once __DIR__ . '/inc/header.php'; 
?>

<?php
try {
    // フォームから取得した各値の代入
    $id = stringHTML($_POST['id']);
    $password = stringHTML($_POST['password']);
    $name = stringHTML($_POST['name']);
    $bkcode = stringHTML($_POST['bkcode']);
    $position = stringHTML($_POST['position']);
    $gender = stringHTML($_POST['gender']);
    $hasfe = stringHTML($_POST['hasfe']);
    $hasap = stringHTML($_POST['hasap']);
    $hire_date = stringHTML($_POST['hire_date']);

    // データベースに接続
    $dbh = db_open();

    // データベースにレコードを追加してメッセージを取得・表示
    $message = update_employee($dbh, $id, $password, $name, $bkcode, $position, $gender, $hasfe, $hasap, $hire_date);
    echo $message ;

} catch (PDOException $e) {
    echo 'エラー!: ' . stringHTML($e->getMessage()) . '<br>';
    exit;
}
?>

<?php require_once __DIR__ . '/inc/footer.php';