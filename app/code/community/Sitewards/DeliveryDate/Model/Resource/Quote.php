<?php

/**
 * Sitewards_DeliveryDate_Model_Resource_Quote
 *  - Basic file for the quote table resource for the delivery date information
 *
 * @category    Sitewards
 * @package     Sitewards_DeliveryDate
 * @copyright   Copyright (c) 2014 Sitewards GmbH (http://www.sitewards.com/)
 */
class Sitewards_DeliveryDate_Model_Resource_Quote extends Sitewards_DeliveryDate_Model_Resource_Core
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
    public function deleteByQuote($iQuoteId, $sKey)
    {
        $sQuoteIdWhere = $this->getWhere(self::S_QUOTE_ATTRIBUTE, $iQuoteId);
        $sKeyWhere     = $this->getWhere(self::S_KEY_ATTRIBUTE, $sKey);
        $sWhere        = $sQuoteIdWhere . ' AND ' . $sKeyWhere;

        $sTable = $this->getMainTable();
        $this->_getWriteAdapter()->delete($sTable, $sWhere);
    }

    /**
     * Get an entry based on quote and key information
     *
     * @param int $iQuoteId
     * @param string $sKey
     * @return array
     */
    public function getByQuote($iQuoteId, $sKey = '')
    {
        $sTable = $this->getMainTable();
        $sWhere = $this->getWhere(self::S_QUOTE_ATTRIBUTE, $iQuoteId);;
        if (!empty($sKey)) {
            $sWhere .= ' AND ' . $this->getWhere(self::S_KEY_ATTRIBUTE, $sKey);
        }

        $oSql    = $this->getSql($sTable, $sWhere);
        $aRows   = $this->getRows($oSql);
        return $this->getFormattedReturn($aRows);
    }
}