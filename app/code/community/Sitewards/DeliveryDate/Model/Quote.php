<?php

/**
 * Sitewards_DeliveryDate_Model_Quote
 *  - Basic file for the quote table for the delivery date information
 *
 * @category    Sitewards
 * @package     Sitewards_DeliveryDate
 * @copyright   Copyright (c) 2014 Sitewards GmbH (http://www.sitewards.com/)
 */
class Sitewards_DeliveryDate_Model_Quote extends Mage_Core_Model_Abstract
{
    /**
     * Set-up the table information
     */
    public function _construct()
    {
        parent::_construct();
        $this->_init('sitewards_deliverydate/quote');
    }

    /**
     * Delete value based on quote and key information
     *
     * @param int $iQuoteId
     * @param string $sKey
     */
    public function deleteByObject($iQuoteId, $sKey)
    {
        $this->_getResource()->deleteByObject($iQuoteId, $sKey);
    }

    /**
     * Load the values based on quote and key information
     *
     * @param int $iQuoteId
     * @param string $sKey
     * @return string[]
     */
    public function getByObject($iQuoteId, $sKey = '')
    {
        return $this->_getResource()->getByObject($iQuoteId, $sKey);
    }

    /**
     * Set the quote id from the object id
     *
     * @param int $iObjectId
     * @return $this
     */
    public function setObjectId($iObjectId)
    {
        $this->setQuoteId($iObjectId);
        return $this;
    }
}