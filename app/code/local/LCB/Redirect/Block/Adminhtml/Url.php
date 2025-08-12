<?php

class LCB_Redirect_Block_Adminhtml_Url extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_url';
        $this->_blockGroup = 'lcb_redirect';
        $this->_headerText = Mage::helper('lcb_redirect')->__('Redirect Rules');
        $this->_addButtonLabel = Mage::helper('lcb_redirect')->__('Add');

        $this->_addButton('import_button', array(
               'label'     => Mage::helper('sales')->__('Import'),
               'onclick' => "document.getElementById('lcb_redirect_import_input').click();",
               'class'     => '',
        ));

        parent::__construct();
    }
}
