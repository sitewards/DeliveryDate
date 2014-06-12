<?php

/**
 * Sitewards_DeliveryDate_Model_Resource_Abstract
 *  - core functionality for adding and removing resources
 *
 * @category    Sitewards
 * @package     Sitewards_DeliveryDate
 * @copyright   Copyright (c) 2014 Sitewards GmbH (http://www.sitewards.com/)
 */
abstract class Sitewards_DeliveryDate_Model_Resource_Abstract extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Constant for the key option
     */
    const S_KEY_ATTRIBUTE = 'key';

    /**
     * Constant for the order id
     */
    const S_ORDER_ATTRIBUTE = 'order_id';

    /**
     * Constant for the quote id
     */
    const S_QUOTE_ATTRIBUTE = 'quote_id';

    /**
     * For a given attribute code and value create a sql safe string
     *
     * @param string $sAttribute
     * @param string|int $mValue
     * @return string
     */
    protected function getWhere($sAttribute, $mValue)
    {
        return $this->_getWriteAdapter()->quoteInto('`'.$sAttribute . '` = ?', $mValue);
    }

    /**
     * Build the sql object from a table and where string
     *
     * @param string $sTable
     * @param string $sWhere
     * @return Varien_Db_Select
     */
    protected function getSql($sTable, $sWhere)
    {
        return $this->_getReadAdapter()->select()->from($sTable)->where($sWhere);
    }

    /**
     * Format an array in key => value
     *
     * @param Varien_Db_Select $oSql
     * @return string[]
     */
    protected function getFormattedReturn($oSql)
    {
        $aRows   = $this->_getReadAdapter()->fetchAll($oSql);
        $aReturn = array();
        foreach ($aRows as $row) {
            $aReturn[$row['key']] = $row['value'];
        }
        return $aReturn;
    }

    /**
     * For a given table, attribute code, value and key delete the row
     *
     * @param string $sTable
     * @param string $sAttributeCode
     * @param int $iAttributeValue
     * @param string $sKey
     */
    public function deleteItem($sTable, $sAttributeCode, $iAttributeValue, $sKey)
    {
        $sOrderIdWhere = $this->getWhere($sAttributeCode, $iAttributeValue);
        $sKeyWhere     = $this->getWhere(self::S_KEY_ATTRIBUTE, $sKey);
        $sWhere        = $sOrderIdWhere . ' AND ' . $sKeyWhere;

        $this->_getWriteAdapter()->delete($sTable, $sWhere);
    }

    /**
     * For a given table, attribute code, value and key delete the row
     *
     * @param string $sTable
     * @param string $sAttributeCode
     * @param int $iAttributeValue
     * @param string $sKey
     * @return string[]
     */
    public function getItem($sTable, $sAttributeCode, $iAttributeValue, $sKey = '')
    {
        $sWhere = $this->getWhere($sAttributeCode, $iAttributeValue);
        if (!empty($sKey)) {
            $sWhere .= ' AND ' . $this->getWhere(self::S_KEY_ATTRIBUTE, $sKey);
        }

        $oSql = $this->getSql($sTable, $sWhere);
        return $this->getFormattedReturn($oSql);
    }
}