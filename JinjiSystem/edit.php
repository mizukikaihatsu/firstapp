<?php
session_start();
$token = bin2hex(random_bytes(20));
$_SESSION['token'] = $token;
?>

<?php
require_once __DIR__ . '/check/login_checker.php';
require_once __DIR__ . '/check/replacement_checker.php';
require_once __DIR__ . '/check/input_checker.php';
require_once __DIR__ . '/dataaccess/employeePDO.php';


// IDの入力チェック
id_checker($_GET['id']);

try {
    // 取得した更新内容を各変数に代入
    $id = $_GET['id'];

    // データベース接続関数の呼び出し
    $dbh = db_open();

    // 更新したい社員情報の取得
    $result = select_employee($dbh, $id);

    if (!$result) {
        echo "指定したデータはありません。";
        exit;
    }
} catch (PDOException $e) {
    echo "エラー!: " . stringHTML($e->getMessage()) . "<br>";
    exit;
}

// データベースから取得した各値の代入
$password = stringHTML($result['password']);
$name = stringHTML($result['name']);
$bkcode = stringHTML($result['bkcode']);
$position = stringHTML($result['position']);
$gender = stringHTML($result['gender']);
$hasfe = stringHTML($result['hasfe']);
$hasap = stringHTML($result['hasap']);
$hire_date = stringHTML($result['hire_date']);

?>
<?php 
	$page_name = '社員情報更新ページ';
	require_once __DIR__ . '/inc/header.php'; 
?>

    <section id="main">

        <form action="update.php" method="post">
            <p>
                <label for="name">氏名:</label>
                <input type="text" name="name" value="<?= $name ?>">
            </p>
            <p>
                <label for="bkcode">所属:</label>
                <input type="text" name="bkcode" value="<?= $bkcode ?>">
            </p>
            <p>
                <label for="position">役職:</label>
                <input type="text" name="position" value="<?= $position ?>">
            </p>
            <p>
                <label for="gender">性別:</label>
                <?php
                if ($gender === '1') {
                    $radio = '<p><input type="radio" name="gender" value="1" checked> 男</p>
                            <p><input type="radio" name="gender" value="2"> 女</p>';
                    echo $radio;
                } else {
                    $radio = '<p><input type="radio" name="gender" value="1"> 男</p>
                            <p><input type="radio" name="gender" value="2" checked> 女</p>';
                    echo $radio;
                }
                ?>
            </p>
            <p>
                <label for="hasfe">基本情報処理資格:</label>
                <?php
                if ($hasfe === '0') {
                    $radio = '<p><input type="radio" name="hasfe" value="0" checked> 有</p>
                            <p><input type="radio" name="hasfe" value="1"> 無</p>';
                    echo $radio;
                } else {
                    $radio = '<p><input type="radio" name="hasfe" value="0"> 有</p>
                            <p><input type="radio" name="hasfe" value="1" checked> 無</p>';
                    echo $radio;
                }
                ?>
            </p>
            <p>
                <label for="hasap">応用情報処理資格:</label>
                <?php
                if ($hasap === '0') {
                    $radio = '<p><input type="radio" name="hasap" value="0" checked> 有</p>
                            <p><input type="radio" name="hasap" value="1"> 無</p>';
                    echo $radio;
                } else {
                    $radio = '<p><input type="radio" name="hasap" value="0"> 有</p>
                            <p><input type="radio" name="hasap" value="1" checked> 無</p>';
                    echo $radio;
                }
                ?>

                <label for="hire_date">入社年月日:</label>
                <input type="date" name="hire_date" value="<?= $hire_date ?>">
            </p>
            <p class="button">
            <input type="hidden" name="id" value="<?= $id ?>">
            <input type="hidden" name="password" value="<?= $password ?>">
                <input type="hidden" name="token" value="<?= $token ?>">
                <input type="submit" value="送信する">
            </p>
        </form>
    </section>


<?php require_once __DIR__ . '/inc/footer.php';