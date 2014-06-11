<?php

/**
 * Test for class Sitewards_DeliveryDate_Helper_Data
 *
 * @category    Sitewards
 * @package     Sitewards_DeliveryDate
 * @copyright   Copyright (c) 2014 Sitewards GmbH (http://www.sitewards.com/)
 */
class Sitewards_DeliveryDate_Test_Helper_Data extends EcomDev_PHPUnit_Test_Case
{
    /**
     * Tests is extension active
     *
     * @test
     * @loadFixture
     */
    public function testIsExtensionActive()
    {
        $this->assertTrue(
            Mage::helper('sitewards_deliverydate')->isExtensionActive(),
            'Extension is not active please check config'
        );
    }
}