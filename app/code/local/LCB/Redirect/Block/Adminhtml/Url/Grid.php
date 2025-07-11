<?php

class LCB_Redirect_Block_Adminhtml_Url_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('lcb_redirect_grid');
        $this->setDefaultSort('entity_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('lcb_redirect/url')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('entity_id', [
            'header' => Mage::helper('lcb_redirect')->__('ID'),
            'index'  => 'entity_id',
            'width'  => '50px',
        ]);
        $this->addColumn('redirect_from', [
            'header' => Mage::helper('lcb_redirect')->__('Redirect From'),
            'index'  => 'redirect_from',
        ]);
        $this->addColumn('redirect_to', [
            'header' => Mage::helper('lcb_redirect')->__('Redirect To'),
            'index'  => 'redirect_to',
        ]);
        $this->addColumn('redirect_type', [
            'header'  => Mage::helper('lcb_redirect')->__('Redirect Type'),
            'index'   => 'redirect_type',
            'type'    => 'options',
            'options' => [301 => '301', 302 => '302'],
        ]);

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('entity_id');
        $this->getMassactionBlock()->setFormFieldName('redirect');

        $this->getMassactionBlock()->addItem('delete', [
            'label'   => Mage::helper('lcb_redirect')->__('Delete'),
            'url'     => $this->getUrl('*/*/massDelete'),
            'confirm' => Mage::helper('lcb_redirect')->__('Are you sure?'),
        ]);

        return $this;
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', ['id' => $row->getId()]);
    }
}
