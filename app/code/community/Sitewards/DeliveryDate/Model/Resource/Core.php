<?php
abstract class Sitewards_DeliveryDate_Model_Resource_Core extends Mage_Core_Model_Resource_Db_Abstract
{
    const S_KEY_ATTRIBUTE = 'key';
    const S_ORDER_ATTRIBUTE = 'order_id';
    const S_QUOTE_ATTRIBUTE = 'quote_id';

    public function getWhere($sAttribute, $mValue)
    {
        return $this->_getWriteAdapter()->quoteInto($sAttribute . ' = ?', $mValue);
    }

    public function getSql($sTable, $sWhere)
    {
        return $this->_getReadAdapter()->select()->from($sTable)->where($sWhere);
    }

    public function getRows($oSql)
    {
        return $this->_getReadAdapter()->fetchAll($oSql);
    }

    public function getFormattedReturn($aRows)
    {
        $aReturn = array();
        foreach ($aRows as $row) {
            $aReturn[$row['key']] = $row['value'];
        }
        return $aReturn;
    }
}