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
            'header_export' => 'id',
            'index'  => 'entity_id',
            'width'  => '50px',
        ]);

        $this->addColumn('redirect_from', [
            'header' => Mage::helper('lcb_redirect')->__('Redirect From'),
            'header_export' => 'redirect_from',
            'index'  => 'redirect_from',
        ]);

        $this->addColumn('redirect_to', [
            'header' => Mage::helper('lcb_redirect')->__('Redirect To'),
            'header_export' => 'redirect_to',
            'index'  => 'redirect_to',
        ]);

        $this->addColumn('redirect_type', [
            'header'  => Mage::helper('lcb_redirect')->__('Redirect Type'),
            'header_export' => 'redirect_type',
            'index'   => 'redirect_type',
            'type'    => 'options',
            'options' => [301 => '301', 302 => '302'],
        ]);

        $this->addExportType('*/*/export', Mage::helper('complaint')->__('CSV'));

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

    /**
     * @inheritDoc
     */
    public function getMainButtonsHtml()
    {
        $html = parent::getMainButtonsHtml();

        $action = $this->getUrl('*/*/import');
        $formKey = Mage::getSingleton('core/session')->getFormKey();

        $html .= '<form id="lcb_redirect_import_form" action="' . $action . '" method="post" enctype="multipart/form-data" style="display:inline;">
              <input type="hidden" name="form_key" value="' . $formKey . '"/>
              <input type="file" id="lcb_redirect_import_input" name="file" accept=".csv" style="display:none"
                     onchange="document.getElementById(\'lcb_redirect_import_form\').submit();"/>
        </form>';

        return $html;
    }
}
