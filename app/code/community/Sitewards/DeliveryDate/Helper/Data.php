<?php

/**
 * Sitewards_DeliveryDate_Helper_Data
 *  - Helper containing the checks for
 *      - extension is active
 *
 * @category    Sitewards
 * @package     Sitewards_DeliveryDate
 * @copyright   Copyright (c) 2014 Sitewards GmbH (http://www.sitewards.com/)
 */
class Sitewards_DeliveryDate_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * Path for the config for extension active status
     */
    const CONFIG_EXTENSION_ACTIVE = 'deliverydate/generalsettings/active';

    /**
     * Variable for if the extension is active
     *
     * @var bool
     */
    protected $bExtensionActive;

    /**
     * Check to see if the extension is active
     *
     * @return bool
     */
    public function isExtensionActive()
    {
        if ($this->bExtensionActive === null) {
            $this->bExtensionActive = Mage::getStoreConfigFlag(self::CONFIG_EXTENSION_ACTIVE);
        }
        return $this->bExtensionActive;
    }
}