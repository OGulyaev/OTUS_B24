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
use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\Entity\IntegerField;
use Bitrix\Main\Entity\StringField;
use Bitrix\Main\ORM\Data\DeleteResult;
use Bitrix\Main\ORM\Fields\DatetimeField;
use Bitrix\Main\ORM\Fields\ExpressionField;
use Bitrix\Main\SystemException;
use CIBlockElement;

/**
 * Class AbstractIblockPropertyValueTable
 *
 * @package Models
 */
abstract class AbstractIblockPropertyValuesTable extends DataManager
{
   const IBLOCK_ID = null;

    protected static ?array $properties = null;
    protected static ?CIBlockElement $iblockElement = null;

    /**
     * @return string
     */
    public static function getTableName(): string
    {
        return 'b_iblock_element_prop_s'.static::IBLOCK_ID;
    }

    /**
     * @return string
     */
    public static function getTableNameMulti(): string
    {
        return 'b_iblock_element_prop_m'.static::IBLOCK_ID;
    }

     /**
     * @return array
     * @throws ArgumentException
     * @throws SystemException
     * @throws ObjectPropertyException
     */
    public static function getProperties(): array
    {
        if (isset(static::$properties[static::IBLOCK_ID])) {
            return static::$properties[static::IBLOCK_ID];
        }

        $dbResult = PropertyTable::query()
            ->setSelect(['ID', 'CODE', 'PROPERTY_TYPE', 'MULTIPLE', 'NAME', 'USER_TYPE'])
            ->where('IBLOCK_ID', static::IBLOCK_ID)
            ->exec();
        while ($row = $dbResult->fetch()) {
            static::$properties[static::IBLOCK_ID][$row['CODE']] = $row;
        }

        return static::$properties[static::IBLOCK_ID] ?? [];
    }
}