<?php

/**
 * Sitewards_DeliveryDate_Model_Resource_Quote
 *  - Basic file for the quote table resource for the delivery date information
 *
 * @category    Sitewards
 * @package     Sitewards_DeliveryDate
 * @copyright   Copyright (c) 2014 Sitewards GmbH (http://www.sitewards.com/)
 */
class Sitewards_DeliveryDate_Model_Resource_Quote extends Sitewards_DeliveryDate_Model_Resource_Abstract
{
    /**
     * Set-up link to the table
     */
    public function _construct()
    {
        $this->_init('sitewards_deliverydate/quote', 'id');
    }

    /**
     * Delete an entry based on quote and key information
     *
     * @param int $iQuoteId
     * @param string $sKey
     */
    public function deleteByObject($iQuoteId, $sKey)
    {
        $sTable = $this->getMainTable();
        $this->deleteItem($sTable, self::S_QUOTE_ATTRIBUTE, $iQuoteId, $sKey);
    }

    /**
     * Get an entry based on quote and key information
     *
     * @param int $iQuoteId
     * @param string $sKey
     * @return string[]
     */
    public function getByObject($iQuoteId, $sKey = '')
    {
        $sTable = $this->getMainTable();
        return $this->getItem($sTable, self::S_QUOTE_ATTRIBUTE, $iQuoteId, $sKey);
    }
}