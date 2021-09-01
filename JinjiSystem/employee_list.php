<?php
require_once __DIR__ . '/check/login_checker.php';
require_once __DIR__ . '/check/input_checker.php';
require_once __DIR__ . '/check/replacement_checker.php';
require_once __DIR__ . '/dataaccess/employeePDO.php';
?>
<?php 
	$page_name = '社員一覧ページ';
	require_once __DIR__ . '/inc/header.php'; 
?>
	<section id="main">
		<?php
		try {
			$dbh = db_open();
			$statement = employee_list($dbh);
		?>
			<table border="1">
				<tr>
					<th>更新</th>
					<th>社員ID</th>
					<th>氏名</th>
					<th>所属</th>
					<th>役職</th>
					<th>性別</th>
					<th>基本情報処理資格</th>
					<th>応用情報処理資格</th>
					<th>入社年月日</th>
				</tr>
				<?php while ($row = $statement->fetch()) : ?>
					<tr>
						<td class="center"><a href="edit.php?id=<?php echo (int) $row['id']; ?>">更新</a></td>
						<td class="center"><?php echo stringHTML($row['id']) ?></td>
						<td><?php echo stringHTML($row['name']) ?></td>
						<td class="center"><?php echo stringHTML($row['bkcode']) ?></td>
						<td class="center"><?php echo stringHTML($row['position']) ?></td>
						<td class="center"><?php echo stringHTML(gender_replacement($row['gender'])) ?></td>
						<td class="center"><?php echo stringHTML(hasfe_replacement($row['hasfe'])) ?></td>
						<td class="center"><?php echo stringHTML(hasap_replacement($row['hasap'])) ?></td>
						<td class="center"><?php echo stringHTML($row['hire_date']) ?></td>
					</tr>
				<?php endwhile; ?>
			</table>
		<?php
		} catch (PDOException $e) {
			echo "エラー!: " . stringHTML($e->getMessage());
			exit;
		}
		?>
	</section>

<?php require_once __DIR__ . '/inc/footer.php';