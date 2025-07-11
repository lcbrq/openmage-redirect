<?php

class LCB_Redirect_Block_Adminhtml_Url_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        $this->_objectId   = 'id';
        $this->_blockGroup = 'lcb_redirect';
        $this->_controller = 'adminhtml_url';

        parent::__construct();

        $this->_updateButton('save', 'label', Mage::helper('lcb_redirect')->__('Save Redirect'));
        $this->_updateButton('delete', 'label', Mage::helper('lcb_redirect')->__('Delete Redirect'));
    }

    public function getHeaderText()
    {
        if (Mage::registry('redirect_data') && Mage::registry('redirect_data')->getId()) {
            return Mage::helper('lcb_redirect')->__("Edit Redirect");
        } else {
            return Mage::helper('lcb_redirect')->__('New Redirect');
        }
    }
}
