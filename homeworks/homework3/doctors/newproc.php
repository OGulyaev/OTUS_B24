<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');

use Bitrix\Main\Page\Asset;
use App\Models\Lists\ProcPropertyValuesTable;

global $APPLICATION;

$APPLICATION->SetTitle('Добавить процедуру');
Asset::getInstance()->addCss('//cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && check_bitrix_sessid()) {
	$name = trim((string)($_POST['NAME'] ?? ''));

	if ($name === '') {
		$errors[] = 'Введите название процедуры.';
	} else {
		ProcPropertyValuesTable::addProcedure($name);
		LocalRedirect('/homeworks/homework3/doctors/index.php');
	}
}
?>

<div class="d-flex gap-2 mb-4">
	<a href="/homeworks/homework3/doctors/">&larr; к списку врачей</a>
</div>

<form method="post">
	<?= bitrix_sessid_post() ?>
	<div class="mb-3">
		<label class="form-label">Процедура</label>
		<input type="text" name="NAME" class="form-control" required>
	</div>
	<button type="submit" class="btn btn-primary">Добавить</button>
</form>

<? require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php'); ?>