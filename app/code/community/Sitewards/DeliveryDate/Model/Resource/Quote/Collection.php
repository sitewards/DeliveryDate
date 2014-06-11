<?php

/**
 * Sitewards_DeliveryDate_Model_Resource_Quote_Collection
 *  - Basic file for the quote table collection for the delivery date information
 *
 * @category    Sitewards
 * @package     Sitewards_DeliveryDate
 * @copyright   Copyright (c) 2014 Sitewards GmbH (http://www.sitewards.com/)
 */
class Sitewards_DeliveryDate_Model_Resource_Quote_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * Set-up the table information
     */
    public function _construct()
    {
        parent::_construct();
        $this->_init('sitewards_deliverydate/quote');
    }
}