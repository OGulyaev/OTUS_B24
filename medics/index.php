<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle('Работа с API инфоблоков');

use Bitrix\Main\Loader;
use Bitrix\Iblock\Iblock;
use Models\Lists\CarsPropertyValuesTable as CarsTable;
Loader::includeModule('iblock');

$iblockId = 19;
$iblockElementId = 41;

// Old API 
$arFilter = ['IBLOCK_ID' => $iblockId, 'ACTIVE' => 'Y'];
$arSelect = ['ID', 'NAME', 'CODE', 'PROPERTY_MODEL', 'PROPERTY_MANUFACTURER_ID'];
$res = CIBlockElement::GetList([], $arFilter, false, [], $arSelect);
$items = [];
while($arFields = $res->fetch()){
    // pr($arFields);
    $items[] = $arFields;
}
pr($items);

$cars = CarsTable::getList([       
		'select'=>[
          'ID'=>'IBLOCK_ELEMENT_ID',
          'NAME'=>'ELEMENT.NAME',
 		  'MANUFACTURER_ID'=>'MANUFACTURER_ID',
      ]
  ])->fetchAll();

 pr($cars); 