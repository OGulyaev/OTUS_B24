<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle('Врачи');
$APPLICATION->ShowTitle();

\Bitrix\Main\Loader::includeModule('iblock');

$medics = \Bitrix\Iblock\Elements\ElementDoctorTable::getList([
    'select' => ['ID', 'NAME', 'FAMILIYA', 'IMYA', 'OTCHESTVO', 'PROTSEDURA'],
])->fetchCollection();

foreach ($medics as $medic) {
    $familiya = $medic->getFamiliya();

    pr('NAME - '.$medic->getName()
        .' Фамилия - '.$medic->getFamiliya()->getValue()
        .' Имя - '.$medic->getImya()->getValue()
        .' Отчество - '.$medic->getOtchestvo()->getValue()
        //.' Процедура - '.$medic->getProtsedura()->getValue()
    );

}

