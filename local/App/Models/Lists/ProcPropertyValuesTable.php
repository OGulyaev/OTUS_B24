<?php

namespace App\Models\Lists;

use Bitrix\Main\Loader;
use Bitrix\Iblock\Elements\ElementProceduresTable;

Loader::includeModule('iblock');

/**
 * Класс для работы со списком PROCEDURES.
 */
class ProcPropertyValuesTable extends AbstractIblockPropertyValuesTable
{
	protected const IBLOCK_CODE = 'PROCEDURES';

	/**
	 * Возвращает список всех процедур в виде массива [ID => Название].
	 * @return array<int,string>
	 */
	public static function getAll()
	{
		$result = [];

		$rows = ElementProceduresTable::getList([
			'select' => ['ID', 'NAME'],
			'filter' => ['ACTIVE' => 'Y'],
			'order'  => ['NAME' => 'ASC'],
		]);

		while ($row = $rows->fetch()) {
			$result[$row['ID']] = $row['NAME'];
		}

		return $result;
	}

	/**
	 * Возвращает названия процедур по массиву их ID.
	 * @param int[] $ids
	 * @return array<int,string>
	 */
	public static function getTitles($ids)
	{
		if (!$ids) {
			return [];
		}
	
		$result = [];

		$rows = ElementProceduresTable::getList([
			'select' => ['ID', 'NAME'],
			'filter' => ['@ID' => $ids],
		]);

		while ($row = $rows->fetch()) {
			$result[$row['ID']] = $row['NAME'];
		}

		return $result;
	}

	/**
	 * добавление новой процедуры (сделал на старом API)
	 * @param $name
	 * @return ID созданной записи.
	 */
	public static function addProcedure($name)
	{
		$name = trim($name);

		$el = new \CIBlockElement();

		$id = $el->Add([
			'IBLOCK_ID' => static::getIblockId(),
			'NAME'      => $name,
			'ACTIVE'    => 'Y',
		]);

		return $id;
	}
}