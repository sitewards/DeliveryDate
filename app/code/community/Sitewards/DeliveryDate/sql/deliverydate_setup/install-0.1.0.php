<?php
/** @var Mage_Core_Model_Resource_Setup $oInstaller */
$oInstaller = $this;
$oInstaller->startSetup();

$oConnection = $oInstaller->getConnection();
$sQuoteTable = $this->getTable('sales_quote_deliverydate');
if (!$oInstaller->tableExists($sQuoteTable)) {
    $oQuoteTable = $oConnection
        ->newTable($sQuoteTable)
        ->addColumn(
            'id',
            Varien_Db_Ddl_Table::TYPE_INTEGER,
            null,
            array(
                'identity' => true,
                'unsigned' => true,
                'nullable' => false,
                'primary' => true,
            ),
            'Quote Delivery Date Id'
        )
        ->addColumn(
            'quote_id',
            Varien_Db_Ddl_Table::TYPE_INTEGER,
            null,
            array(
                'nullable' => false
            ),
            'Quote Id'
        )
        ->addColumn(
            'key',
            Varien_Db_Ddl_Table::TYPE_TEXT,
            '255',
            array(
                'nullable' => false
            ),
            'Delivery Date Quote Key'
        )
        ->addColumn(
            'value',
            Varien_Db_Ddl_Table::TYPE_TEXT,
            null,
            array(
                'nullable' => false
            ),
            'Delivery Date Quote Value'
        )
        ->setComment('Delivery Date Quote');
    $oConnection->createTable($oQuoteTable);
}

$sOrderTable = $this->getTable('sales_order_deliverydate');
if (!$oInstaller->tableExists($sOrderTable)) {
    $oOrderTable = $oConnection
        ->newTable($sOrderTable)
        ->addColumn(
            'id',
            Varien_Db_Ddl_Table::TYPE_INTEGER,
            null,
            array(
                'identity' => true,
                'unsigned' => true,
                'nullable' => false,
                'primary' => true,
            ),
            'Order Delivery Date Id'
        )
        ->addColumn(
            'order_id',
            Varien_Db_Ddl_Table::TYPE_INTEGER,
            null,
            array(
                'nullable' => false
            ),
            'Order Id'
        )
        ->addColumn(
            'key',
            Varien_Db_Ddl_Table::TYPE_TEXT,
            '255',
            array(
                'nullable' => false
            ),
            'Delivery Date Order Key'
        )
        ->addColumn(
            'value',
            Varien_Db_Ddl_Table::TYPE_TEXT,
            null,
            array(
                'nullable' => false
            ),
            'Delivery Date Order Value'
        )
        ->setComment('Delivery Date Order');
    $oConnection->createTable($oOrderTable);
}
$oInstaller->endSetup();