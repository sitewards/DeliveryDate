<?php

/**
 * Sitewards_DeliveryDate_Model_Observer
 *  - Observer containing the following event methods
 *      - salesQuoteSaveBefore - get delivery date from the post and set it to the quote
 *      - salesQuoteSaveAfter - when saving the quote also save the delivery date
 *      - salesQuoteLoadAfter - when loading the quote also load the delivery date
 *      - salesModelServiceQuoteSubmitAfter - when saving the order also save the delivery date
 *      - salesOrderLoadAfter - when loading the order also load the delivery date
 *
 * @category    Sitewards
 * @package     Sitewards_DeliveryDate
 * @copyright   Copyright (c) 2014 Sitewards GmbH (http://www.sitewards.com/)
 */
class Sitewards_DeliveryDate_Model_Observer
{
    /**
     * This function is called just before $quote object get stored to database.
     * Here, from POST data, we capture our custom field and put it in the quote object
     *
     * @param Varien_Event_Observer $oObserver
     */
    public function salesQuoteSaveBefore(Varien_Event_Observer $oObserver)
    {
        if ($this->isExtensionActive()) {
            $oQuote = $oObserver->getQuote();
            $aPost = Mage::app()
                ->getFrontController()
                ->getRequest()
                ->getPost();
            if (isset($aPost['sitewards']['delivery_date'])) {
                $sVar = $aPost['sitewards']['delivery_date'];
                $oQuote->setDeliveryDate($sVar);
            }
        }
    }

    /**
     * This function is called, just after $quote object get saved to database.
     * Here, after the quote object gets saved in database
     * we save our custom field in the our table created i.e sales_quote_custom
     *
     * @param Varien_Event_Observer $oObserver
     */
    public function salesQuoteSaveAfter(Varien_Event_Observer $oObserver)
    {
        if ($this->isExtensionActive()) {
            $oQuote = $oObserver->getQuote();
            if ($oQuote->getDeliveryDate()) {
                $sVar = $oQuote->getDeliveryDate();
                if (!empty($sVar)) {
                    /** @var Sitewards_DeliveryDate_Model_Quote $oModel */
                    $oModel = Mage::getModel('sitewards_deliverydate/quote');
                    $oModel->deleteByQuote($oQuote->getId(), 'delivery_date');
                    $oModel->setQuoteId($oQuote->getId());
                    $oModel->setKey('delivery_date');
                    $oModel->setValue($sVar);
                    $oModel->save();
                }
            }
        }
    }

    /**
     * When load() function is called on the quote object,
     * we read our custom fields value from database and put them back in quote object.
     *
     * @param Varien_Event_Observer $oObserver
     */
    public function salesQuoteLoadAfter(Varien_Event_Observer $oObserver)
    {
        if ($this->isExtensionActive()) {
            $oQuote = $oObserver->getQuote();
            /** @var Sitewards_DeliveryDate_Model_Quote $oModel */
            $oModel = Mage::getModel('sitewards_deliverydate/quote');
            $aData = $oModel->getByQuote($oQuote->getId());
            foreach ($aData as $sKey => $sValue) {
                $oQuote->setData($sKey, $sValue);
            }
        }
    }

    /**
     * This function is called after order gets saved to database.
     * Here we transfer our custom fields from quote table to order table i.e sales_order_custom
     *
     * @param Varien_Event_Observer $oObserver
     */
    public function salesModelServiceQuoteSubmitAfter(Varien_Event_Observer $oObserver)
    {
        if ($this->isExtensionActive()) {
            $oOrder = $oObserver->getOrder();
            $oQuote = $oObserver->getQuote();
            if ($oQuote->getDeliveryDate()) {
                $sVar = $oQuote->getDeliveryDate();
                if (!empty($sVar)) {
                    /** @var Sitewards_DeliveryDate_Model_Order $oModel */
                    $oModel = Mage::getModel('sitewards_deliverydate/order');
                    $oModel->deleteByOrder($oOrder->getId(), 'delivery_date');
                    $oModel->setOrderId($oOrder->getId());
                    $oModel->setKey('delivery_date');
                    $oModel->setValue($sVar);
                    $oOrder->setDeliveryDate($sVar);
                    $oModel->save();
                }
            }
        }
    }

    /**
     * This function is called when $order->load() is done.
     * Here we read our custom fields value from database and set it in order object.
     *
     * @param Varien_Event_Observer $oObserver
     */
    public function salesOrderLoadAfter(Varien_Event_Observer $oObserver)
    {
        if ($this->isExtensionActive()) {
            $oOrder = $oObserver->getOrder();
            /** @var Sitewards_DeliveryDate_Model_Order $oModel */
            $oModel = Mage::getModel('sitewards_deliverydate/order');
            $aData = $oModel->getByOrder($oOrder->getId());
            foreach ($aData as $sKey => $sValue) {
                $oOrder->setData($sKey, $sValue);
            }
        }
    }

    /**
     * Check to see if the extension is active before doing anything
     *
     * @return bool
     */
    protected function isExtensionActive() {
        return Mage::helper('sitewards/deliverydate')->isExtensionActive();
    }
}