<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');

use Bitrix\Main\Page\Asset;
use App\Models\Lists\MedicPropertyValuesTable;
use App\Models\Lists\ProcPropertyValuesTable;

global $APPLICATION;

$id = (int)$_GET['ID'];
$doctor = MedicPropertyValuesTable::getDoctor($id);

$APPLICATION->SetTitle('Редактирование: ' . $doctor['FIO']);
Asset::getInstance()->addCss('//cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');

$allProcedures = ProcPropertyValuesTable::getAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && check_bitrix_sessid()) { 
	$surname = trim((string)($_POST['SURNAME'] ?? ''));
	$firstname = trim((string)($_POST['FIRSTNAME'] ?? ''));
	$patronymic = trim((string)($_POST['PATRONYMIC'] ?? ''));
	$procedures = array_map('intval', (array)($_POST['PROCEDURES'] ?? []));

	MedicPropertyValuesTable::updateDoctor(
		$doctor['ID'],
		['SURNAME' => $surname, 'FIRSTNAME' => $firstname, 'PATRONYMIC' => $patronymic],
		$procedures
	);
	LocalRedirect('/homeworks/homework3/doctors/doctor.php?ID=' . $doctor['ID']);

	$doctor['SURNAME']    = $surname;
	$doctor['FIRSTNAME']  = $firstname;
	$doctor['PATRONYMIC'] = $patronymic;
	$doctor['PROCEDURES'] = $procedures;
}
?>

<div class="d-flex gap-2 mb-4">
	<a href="/homeworks/homework3/doctors/">&larr; к списку врачей</a>
</div>

<form method="post">
	<?= bitrix_sessid_post() ?>

	<div class="mb-3">
		<label class="form-label">Фамилия</label>
		<input type="text" name="SURNAME" class="form-control"
			   value="<?= htmlspecialcharsbx($doctor['SURNAME']) ?>" required>
	</div>
	<div class="mb-3">
		<label class="form-label">Имя</label>
		<input type="text" name="FIRSTNAME" class="form-control"
			   value="<?= htmlspecialcharsbx($doctor['FIRSTNAME']) ?>" required>
	</div>
	<div class="mb-3">
		<label class="form-label">Отчество</label>
		<input type="text" name="PATRONYMIC" class="form-control"
			   value="<?= htmlspecialcharsbx($doctor['PATRONYMIC']) ?>">
	</div>
	<div class="mb-3">
		<label class="form-label">Процедуры</label>
		<select name="PROCEDURES[]" class="form-select" multiple size="6">
			<?php foreach ($allProcedures as $pid => $pname): ?>
				<option value="<?= $pid ?>"
					<?= in_array($pid, $doctor['PROCEDURES']) ? 'selected' : '' ?>>
					<?= htmlspecialcharsbx($pname) ?>
				</option>
			<?php endforeach; ?>
		</select>
	</div>

	<button type="submit" class="btn btn-primary">Сохранить</button>
</form>

<? require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php'); ?>