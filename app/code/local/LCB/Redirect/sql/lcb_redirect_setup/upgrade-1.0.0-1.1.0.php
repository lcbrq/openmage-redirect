<?php

$installer = $this;
$installer->startSetup();

$table = $installer->getTable('lcb_redirect/url');
$connection = $installer->getConnection();

if (!$connection->tableColumnExists($table, 'customer_group_ids')) {
    $connection->addColumn(
        $table,
        'customer_group_ids',
        array(
            'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
            'length' => 255,
            'nullable' => true,
            'default' => null,
            'comment' => 'Customer Group IDs',
        )
    );
}

$installer->endSetup();
