<?php

/**
 * Sitewards_DeliveryDate_Model_Resource_Order
 *  - Basic file for the order table resource for the delivery date information
 *
 * @category    Sitewards
 * @package     Sitewards_DeliveryDate
 * @copyright   Copyright (c) 2014 Sitewards GmbH (http://www.sitewards.com/)
 */
class Sitewards_DeliveryDate_Model_Resource_Order extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Set-up table information
     */
    public function _construct()
    {
        $this->_init('sitewards_deliverydate/order', 'id');
    }

    /**
     * Delete an entry based on order and key information
     *
     * @param int $iOrderId
     * @param string $sKey
     */
    public function deleteByOrder($iOrderId, $sKey)
    {
        $sTable = $this->getMainTable();
        $sWhere = $this->_getWriteAdapter()
                ->quoteInto('order_id = ? AND ', $iOrderId)
            . $this->_getWriteAdapter()
                ->quoteInto('`key` = ?', $sKey);
        $this->_getWriteAdapter()
            ->delete($sTable, $sWhere);
    }

    /**
     * Get and entry based on order and key information
     *
     * @param int $iOrderId
     * @param string $sKey
     * @return array
     */
    public function getByOrder($iOrderId, $sKey = '')
    {
        $sTable = $this->getMainTable();
        $sWhere = $this->_getReadAdapter()
            ->quoteInto('order_id = ?', $iOrderId);
        if (!empty($sKey)) {
            $sWhere .= $this->_getReadAdapter()
                ->quoteInto(' AND `key` = ? ', $sKey);
        }
        $sSql = $this->_getReadAdapter()
            ->select()
            ->from($sTable)
            ->where($sWhere);
        $aRows = $this->_getReadAdapter()
            ->fetchAll($sSql);
        $aReturn = array();
        foreach ($aRows as $row) {
            $aReturn[$row['key']] = $row['value'];
        }
        return $aReturn;
    }
}