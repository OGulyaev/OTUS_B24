<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');

use Bitrix\Main\Page\Asset;
use App\Models\Lists\MedicPropertyValuesTable;
use App\Models\Lists\ProcPropertyValuesTable;

global $APPLICATION;

$id = (int)$_GET['ID'];
$doctor = MedicPropertyValuesTable::getDoctor($id);

$APPLICATION->SetTitle($doctor['FIO']);
Asset::getInstance()->addCss('//cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');

$procedureTitles = ProcPropertyValuesTable::getTitles($doctor['PROCEDURES']);
?>

<div class="d-flex gap-2 mb-4">
	<a href="/homeworks/homework3/doctors/">&larr; к списку врачей</a>
</div>

<div class="text-muted mb-3">
	ID: <?= $doctor['ID'] ?>,
	Фамилия: <?= $doctor['SURNAME'] ?>,
	Имя: <?= $doctor['FIRSTNAME'] ?>,
	Отчество: <?= $doctor['PATRONYMIC'] ?>,
</div>

<h5>Процедуры</h5>
<ul class="list-group mb-3">
	<?php if ($procedureTitles): ?>
		<?php foreach ($procedureTitles as $title): ?>
			<li class="list-group-item"><?= $title ?></li>
		<?php endforeach; ?>
	<?php else: ?>
		<li class="list-group-item text-muted">Процедуры не назначены</li>
	<?php endif; ?>
</ul>

<a href="/homeworks/homework3/doctors/editdoctor.php?ID=<?= $doctor['ID'] ?>"
   class="btn btn-primary">Изменить данные врача</a>

<? require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php'); ?>