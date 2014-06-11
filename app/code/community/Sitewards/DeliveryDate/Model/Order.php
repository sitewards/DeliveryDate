<?php

/**
 * Sitewards_DeliveryDate_Model_Order
 *  - Basic file for the order table for the delivery date information
 *
 * @category    Sitewards
 * @package     Sitewards_DeliveryDate
 * @copyright   Copyright (c) 2014 Sitewards GmbH (http://www.sitewards.com/)
 */
class Sitewards_DeliveryDate_Model_Order extends Mage_Core_Model_Abstract
{
    /**
     * Set-up the table information
     */
    public function _construct()
    {
        parent::_construct();
        $this->_init('sitewards_deliverydate/order');
    }

    /**
     * Delete value based on order and key information
     *
     * @param int $iOrderId
     * @param string $sKey
     */
    public function deleteByOrder($iOrderId, $sKey)
    {
        $this->_getResource()->deleteByOrder($iOrderId, $sKey);
    }

    /**
     * Load the values based on order and key information
     *
     * @param int $iOrderId
     * @param string $sKey
     * @return string
     */
    public function getByOrder($iOrderId, $sKey = '')
    {
        return $this->_getResource()->getByOrder($iOrderId, $sKey);
    }

    /**
     * Validate if your can cancel a given order based on the saved delivery date
     *
     * @param int $iOrderId
     * @return bool
     */
    public function canCancel($iOrderId)
    {
        /* @var $oOrder Mage_Sales_Model_Order */
        $oOrder = Mage::getModel('sales/order')->load($iOrderId);
        if ($oOrder->getCustomerId() == Mage::getSingleton('customer/session')->getCustomerId()) {
            $sDeliveryDate = current($this->getByOrder($iOrderId, 'delivery_date'));
            return (strtotime($sDeliveryDate) > now());
        }

        return false;
    }
}