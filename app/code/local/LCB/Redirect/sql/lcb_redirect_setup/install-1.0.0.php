<?php

$installer = $this;
$installer->startSetup();

$table = $installer->getConnection()
    ->newTable($installer->getTable('lcb_redirect/url'))
    ->addColumn('entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, [
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
    ], 'ID')
    ->addColumn('redirect_from', Varien_Db_Ddl_Table::TYPE_TEXT, 255, [
        'nullable'  => false,
    ], 'Redirect From')
    ->addColumn('redirect_to', Varien_Db_Ddl_Table::TYPE_TEXT, 255, [
        'nullable'  => false,
    ], 'Redirect To')
    ->addColumn('redirect_type', Varien_Db_Ddl_Table::TYPE_INTEGER, null, [
        'nullable'  => false,
        'default'   => 301
    ], 'Redirect Type')
    ->addIndex($installer->getIdxName('lcb_redirect/url', ['redirect_from']), ['redirect_from'], ['type' => 'unique'])
    ->setComment('LCB Redirect URL Table');

$installer->getConnection()->createTable($table);
$installer->endSetup();
