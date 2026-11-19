<?php

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');

use Bitrix\Main\Page\Asset;
use App\Models\Lists\MedicPropertyValuesTable;

global $APPLICATION;

$APPLICATION->SetTitle('Список врачей');

Asset::getInstance()->addCss('//cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');
?>

<div class="d-flex gap-2 mb-4">
    <a href="/homeworks/homework3/doctors/new.php" class="btn btn-primary">Добавить врача</a>
    <a href="/homeworks/homework3/doctors/newproc.php" class="btn btn-primary">Добавить процедуру</a>
</div>

<div class="list-group">
    <?php 
        $doctors = MedicPropertyValuesTable::getAllDoctors();
        foreach ($doctors as $doctor): ?>
        <a href="/homeworks/homework3/doctors/doctor.php?ID=<?= $doctor['ID'] ?>"
           class="list-group-item list-group-item-action">
            <?= $doctor['NAME'] ?>
        </a>
    <?php endforeach; ?>
</div>

<? require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php'); ?>