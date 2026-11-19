<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');

use Bitrix\Main\Page\Asset;
use App\Models\Lists\MedicPropertyValuesTable;
use App\Models\Lists\ProcPropertyValuesTable;

global $APPLICATION;

$APPLICATION->SetTitle('Добавить врача');
Asset::getInstance()->addCss('//cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && check_bitrix_sessid()) {
	$surname    = trim((string)($_POST['SURNAME'] ?? ''));
	$name       = trim((string)($_POST['FIRSTNAME'] ?? ''));
	$patronymic = trim((string)($_POST['PATRONYMIC'] ?? ''));
	$procedures = array_map('intval', (array)($_POST['PROCEDURES'] ?? []));

	if ($surname === '' || $name === '') {
		$errors[] = 'Заполните Фамилию и Имя.';
	}

	if (!$errors) {
		MedicPropertyValuesTable::addDoctor(
			['SURNAME' => $surname, 
			'FIRSTNAME' => $name, 
			'PATRONYMIC' => $patronymic],
			$procedures
		);
		LocalRedirect('/homeworks/homework3/doctors/index.php');
	}
}

$allProcedures = ProcPropertyValuesTable::getAll();
?>
<div class="d-flex gap-2 mb-4">
	<a href="/homeworks/homework3/doctors/">&larr; к списку врачей</a>
</div>

<form method="post">
	<?= bitrix_sessid_post() ?>

	<div class="mb-3">
		<label class="form-label">Фамилия</label>
		<input type="text" name="SURNAME" class="form-control" required>
	</div>
	<div class="mb-3">
		<label class="form-label">Имя</label>
		<input type="text" name="FIRSTNAME" class="form-control" required>
	</div>
	<div class="mb-3">
		<label class="form-label">Отчество</label>
		<input type="text" name="PATRONYMIC" class="form-control">
	</div>
	<div class="mb-3">
		<label class="form-label">Процедуры</label>
		<select name="PROCEDURES[]" class="form-select" multiple size="6">
			<?php foreach ($allProcedures as $procId => $procName): ?>
				<option value="<?= $procId ?>"><?= $procName ?></option>
			<?php endforeach; ?>
		</select>
	</div>

	<button type="submit" class="btn btn-primary">Добавить</button>
</form>

<? require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php'); ?>