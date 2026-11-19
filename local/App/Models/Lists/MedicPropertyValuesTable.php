<?php

namespace App\Models\Lists;

use Bitrix\Iblock\Elements\ElementDoctorsTable;
use Bitrix\Main\ORM\Fields\Relations\Reference;
use Bitrix\Main\ORM\Query\Join;
use Bitrix\Main\ORM\Query\Query;
use Bitrix\Main\ORM\Fields\StringField;

\Bitrix\Main\Loader::includeModule('iblock');

/**
 * Класс для работы со списком DOCTORS.
 */
class MedicPropertyValuesTable extends AbstractIblockPropertyValuesTable
{
	const IBLOCK_CODE = 'DOCTORS';

	/**
	 * Получение списка врачей в виде массива.
	 * 
	 * @return array<int, array{ID, NAME}>
	 */
	public static function getAllDoctors()
	{
		$rows = ElementDoctorsTable::getList([
			'select' => ['ID', 'NAME'],
			'filter' => ['ACTIVE' => 'Y'],
			'order'  => ['NAME' => 'ASC'],
		])->fetchAll();
		
		return $rows;
	}

	/**
	 * Получение данных одного врача (ФИО + массив ID процедур).
	 *
	 * @param $id
	 * @return array
	 */
	public static function getDoctor($id)
	{

		$doctor = ElementDoctorsTable::getList([
			'select' => [
				'ID',
				'NAME',
				'SURNAME',
				'FIRSTNAME',    
				'PATRONYMIC',
			],
			'filter' => ['ID' => $id, 'ACTIVE' => 'Y'],
		])->fetchObject();

		return [
			'ID'         => $doctor->getId(),
			'FIO'        => $doctor->getName(),
			'SURNAME'    => $doctor->getSurname() ? $doctor->getSurname()->getValue() : '',
			'FIRSTNAME'  => $doctor->getFirstname() ? $doctor->getFirstname()->getValue() : '',
			'PATRONYMIC' => $doctor->getPatronymic() ? $doctor->getPatronymic()->getValue() : '',
			'PROCEDURES' => self::getProcedureIds($id),
		];
	}

	/**
	 * Получение процедур, привязанных к врачу.
	 * @param $doctorId
	 * @return $ids[]. Возвращает массив ID процедур
	 */
	public static function getProcedureIds($doctorId)
	{
		$doctor = ElementDoctorsTable::getByPrimary($doctorId, [
			'select' => ['ID', 'PROCEDURES']
		])->fetchObject();	
		
		$ids = [];

		foreach ($doctor->get('PROCEDURES') as $procValue) {
        	$ids[] = $procValue->getValue();
    	}

		return $ids;
	}

	/**
	 * Создаёт запись врача с процедурами.
	 *
	 * @param $fields - массив из Фамилия, Имя, Отчество
	 * @param $procedureIds - Массив ID процедур.
	 * @return $id - ID созданного врача.
	 */
	public static function addDoctor($fields, $procedureIds)
	{
		$surname = trim((string)($fields['SURNAME'] ?? ''));
		$firstname    = trim((string)($fields['FIRSTNAME'] ?? ''));
		$patr    = trim((string)($fields['PATRONYMIC'] ?? ''));

		$fio = trim($surname . ' ' . $firstname . ' ' . $patr);

		$doctor = ElementDoctorsTable::createObject();
		$doctor->setName($fio);
		$doctor->set('SURNAME', $surname);
		$doctor->set('FIRSTNAME', $firstname);
		$doctor->set('PATRONYMIC', $patr);
		$doctor->save();

		foreach ($procedureIds as $procId) {
			$doctor->addTo('PROCEDURES', new \Bitrix\Iblock\ORM\PropertyValue($procId));
		}

		$doctor->save();

		return $doctor->getId();
	}

	/**
	 * Обновляет запись врача и список его процедур.
	 *
	 * @param $id - ID врача
	 * @param $fields - массив из Фамилия, Имя, Отчество
	 * @param $procedureIds - массив ID процедур
	 * @return void
	 */
	public static function updateDoctor($id, $fields, $procedureIds)
	{
		$doctor = ElementDoctorsTable::getByPrimary($id, [
        'select' => ['ID', 'NAME', 'SURNAME', 'FIRSTNAME', 'PATRONYMIC', 'PROCEDURES']
		])->fetchObject();

		$surname = trim((string)($fields['SURNAME'] ?? ''));
		$firstname = trim((string)($fields['FIRSTNAME'] ?? ''));
		$patr = trim((string)($fields['PATRONYMIC'] ?? ''));

		$fio = trim($surname . ' ' . $firstname . ' ' . $patr);

		$doctor->setName($fio);
		$doctor->set('SURNAME', $surname);
		$doctor->set('FIRSTNAME', $firstname);
		$doctor->set('PATRONYMIC', $patr);
		$doctor->removeAll('PROCEDURES');
		foreach ($procedureIds as $procId) {
			$doctor->addTo('PROCEDURES', new \Bitrix\Iblock\ORM\PropertyValue($procId));
		}

		$doctor->save();
	}
	
	/**
	* Переопределяем getMap из родителя, добавляем поля инфоблока.
	*/
	public static function getMap()
	{
		return array_merge(parent::getMap(), [
			new StringField('SURNAME'),
			new StringField('FIRSTNAME'),
			new StringField('PATRONYMIC'),
		]);
	}

}