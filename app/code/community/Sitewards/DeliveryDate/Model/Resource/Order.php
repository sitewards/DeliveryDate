<?php

/**
 * Sitewards_DeliveryDate_Model_Resource_Order
 *  - Basic file for the order table resource for the delivery date information
 *
 * @category    Sitewards
 * @package     Sitewards_DeliveryDate
 * @copyright   Copyright (c) 2014 Sitewards GmbH (http://www.sitewards.com/)
 */
class Sitewards_DeliveryDate_Model_Resource_Order extends Sitewards_DeliveryDate_Model_Resource_Core
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
        $sOrderIdWhere = $this->getWhere(self::S_ORDER_ATTRIBUTE, $iOrderId);
        $sKeyWhere     = $this->getWhere(self::S_KEY_ATTRIBUTE, $sKey);
        $sWhere        = $sOrderIdWhere . ' AND ' . $sKeyWhere;

        $sTable = $this->getMainTable();
        $this->_getWriteAdapter()->delete($sTable, $sWhere);
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
        $sWhere = $this->getWhere(self::S_ORDER_ATTRIBUTE, $iOrderId);;
        if (!empty($sKey)) {
            $sWhere .= ' AND ' . $this->getWhere(self::S_KEY_ATTRIBUTE, $sKey);
        }

        $oSql    = $this->getSql($sTable, $sWhere);
        $aRows   = $this->getRows($oSql);
        return $this->getFormattedReturn($aRows);
    }
}