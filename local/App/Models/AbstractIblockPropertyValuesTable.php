<?php

namespace Models;

use Bitrix\Iblock\ElementTable;
use Bitrix\Iblock\PropertyEnumerationTable;
use Bitrix\Iblock\PropertyTable;
use Bitrix\Main\ArgumentException;
use Bitrix\Main\Data\Cache;
use Bitrix\Main\DB\SqlExpression;
use Bitrix\Main\Entity\ReferenceField;
use Bitrix\Main\NotImplementedException;
use Bitrix\Main\ObjectPropertyException;
//use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\Entity\IntegerField;
use Bitrix\Main\Entity\StringField;
use Bitrix\Main\ORM\Data\DeleteResult;
use Bitrix\Main\ORM\Fields\DatetimeField;
use Bitrix\Main\ORM\Fields\ExpressionField;
use Bitrix\Main\SystemException;
use CIBlockElement;

use Bitrix\Main\Entity\DataManager

/**
 * Class AbstractIblockPropertyValueTable
 *
 * @package Models
 */
abstract class AbstractIblockPropertyValuesTable extends DataManager
{
   const IBLOCK_ID = null;


}