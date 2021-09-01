<?php
require_once __DIR__ . '/check/token_checker.php';
require_once __DIR__ . '/check/login_checker.php';
require_once __DIR__ . '/check/input_checker.php';
require_once __DIR__ . '/dataaccess/employeePDO.php';
?>

<?php 
	$page_name = '社員登録ページ';
	require_once __DIR__ . '/inc/header.php'; 
?>

<?php
try {
    // データベース接続関数の呼び出し
    $dbh = db_open();

    // フォームから送られた内容を取得して各変数に代入
    $id = stringHTML($_POST['id']);
    $password = stringHTML($_POST['password']);
    $name = stringHTML($_POST['name']);
    $bkcode = stringHTML($_POST['bkcode']);
    $position = stringHTML($_POST['position']);
    $gender = (int)stringHTML($_POST['gender']);
    $hasfe = (int)stringHTML($_POST['hasfe']);
    $hasap = (int)stringHTML($_POST['hasap']);
    $hire_date = stringHTML($_POST['hire_date']);

    // フォームから送られた内容の入力チェック
    id_checker($id);
    name_checker($name);
    password_checker($password);
    bkcode_checker($bkcode);
    position_checker($position);
    gender_checker($gender);
    hasfe_checker($hasfe);
    hasap_checker($hasap);
    hire_date_checker($hire_date);

    // データベースに追加して戻ってきたメッセージを表示
    $message = add_employee($dbh, $id, $password, $name, $bkcode, $position, $gender, $hasfe, $hasap, $hire_date);
    echo $message;

} catch (PDOException $e) {
    echo $message;
    exit;
}
?>
<?php include __DIR__ . '/inc/footer.php';
