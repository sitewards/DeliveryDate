<?php

/**
 * Sitewards_DeliveryDate_Model_Resource_Order
 *  - Basic file for the order table resource for the delivery date information
 *
 * @category    Sitewards
 * @package     Sitewards_DeliveryDate
 * @copyright   Copyright (c) 2014 Sitewards GmbH (http://www.sitewards.com/)
 */
class Sitewards_DeliveryDate_Model_Resource_Order extends Sitewards_DeliveryDate_Model_Resource_Abstract
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
    public function deleteByObject($iOrderId, $sKey)
    {
        $sTable = $this->getMainTable();
        $this->deleteItem($sTable, self::S_ORDER_ATTRIBUTE, $iOrderId, $sKey);
    }

    /**
     * Get and entry based on order and key information
     *
     * @param int $iOrderId
     * @param string $sKey
     * @return string[]
     */
    public function getByObject($iOrderId, $sKey = '')
    {
        $sTable = $this->getMainTable();
        return $this->getItem($sTable, self::S_ORDER_ATTRIBUTE, $iOrderId, $sKey);
    }
}