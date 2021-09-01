<?php require_once __DIR__ . '/check/login_checker.php'; ?>
<?php 
	$page_name = '人事システムメインメニュー';
	require_once __DIR__ . '/inc/header.php'; 
?>


    <h2>メインメニュー</h2>
    <main id="index">
        <form method="post" action="employee_list.php">
            <p><input type="submit" value="社員情報一覧を表示する"></p>
            <input type="hidden" name="token" value="<?php echo $token ?>">
        </form>
        <form method="post" action="register.php">
            <p><input type="submit" value="社員登録する"></p>
            <input type="hidden" name="token" value="<?php echo $token ?>">
        </form>
        <form method="post" action="employee_list.php">
            <p><input type="submit" value="社員情報を更新する表示する"></p>
            <input type="hidden" name="token" value="<?php echo $token ?>">
        </form>
        <form method="post" action="delete.php">
            <p><input type="submit" value="社員情報を削除する"></p>
            <input type="hidden" name="token" value="<?php echo $token ?>">
        </form>
    </main>

<?php require_once __DIR__ . '/inc/footer.php';