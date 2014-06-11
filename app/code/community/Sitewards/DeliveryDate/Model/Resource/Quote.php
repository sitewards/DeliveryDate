<?php

/**
 * Sitewards_DeliveryDate_Model_Resource_Quote
 *  - Basic file for the quote table resource for the delivery date information
 *
 * @category    Sitewards
 * @package     Sitewards_DeliveryDate
 * @copyright   Copyright (c) 2014 Sitewards GmbH (http://www.sitewards.com/)
 */
class Sitewards_DeliveryDate_Model_Resource_Quote extends Mage_Core_Model_Resource_Db_Abstract
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
        $sTable = $this->getMainTable();
        $sWhere = $this->_getWriteAdapter()->quoteInto('quote_id = ? AND ', $iQuoteId)
            . $this->_getWriteAdapter()->quoteInto('`key` = ?', $sKey);
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
        $sWhere = $this->_getReadAdapter()->quoteInto('quote_id = ?', $iQuoteId);
        if (!empty($sKey)) {
            $sWhere .= $this->_getReadAdapter()->quoteInto(' AND `key` = ? ', $sKey);
        }
        $sSql = $this->_getReadAdapter()->select()->from($sTable)->where($sWhere);
        $aRows = $this->_getReadAdapter()->fetchAll($sSql);
        $aReturn = array();
        foreach ($aRows as $row) {
            $aReturn[$row['key']] = $row['value'];
        }
        return $aReturn;
    }
}