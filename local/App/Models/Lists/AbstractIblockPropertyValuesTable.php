<?php

namespace App\Models\Lists;

use Bitrix\Iblock\IblockTable;
use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\IntegerField;

/**
 * Абстрактный класс для работы с универсальными списками.
 */
abstract class AbstractIblockPropertyValuesTable extends DataManager
{
	// Символьный код инфоблока. Заполняется в дочерних классах.
	// Наследники должны переопределить константу IBLOCK_CODE.
	protected const IBLOCK_CODE = '';

	/**
	 * Возвращает ID инфоблока по его символьному коду (нужен при использовании старого API).
	 * 
	 * @return int 
	 */
	public static function getIblockId()
	{
		$code = static::IBLOCK_CODE;

		$row = IblockTable::getList([
			'select' => ['ID'],
			'filter' => ['CODE' => $code],
			'limit'  => 1,
		])->fetch();

		return (int)$row['ID'];
	}

	/**
	* собирает имя таблицы для метода getList
	*/
	public static function getTableName()
	{
		return 'iblock_element_prop_' . static::getIblockId();
	}

	/**
	* переопределяем getMap из DataManager
	*/
	public static function getMap()
	{
		return [
			new IntegerField('IBLOCK_ELEMENT_ID', ['primary' => true]),
		];
	}
}