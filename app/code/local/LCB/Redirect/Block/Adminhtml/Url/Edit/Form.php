<?php

class LCB_Redirect_Block_Adminhtml_Url_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form([
            'id'     => 'edit_form',
            'action' => $this->getUrl('*/*/save', ['id' => $this->getRequest()->getParam('id')]),
            'method' => 'post'
        ]);

        $fieldset = $this->getFieldset($form);

        if (Mage::registry('redirect_data')) {
            $form->setValues(Mage::registry('redirect_data')->getData());
        }

        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();

        return parent::_prepareForm();
    }

    /**
     * @param  Varien_Data_Form
     * @return Varien_Data_Form_Element_Fieldset
     */
    public function getFieldset($form)
    {
        $fieldset = $form->addFieldset('general', array(
            'legend' => Mage::helper('lcb_redirect')->__('General'),
            'class' => 'fieldset',
        ));

        $fieldset->addField('redirect_from', 'text', array(
            'name' => 'redirect_from',
            'label' => $this->__('Redirect From'),
            'title' => $this->__('Redirect To'),
        ));

        $fieldset->addField('redirect_to', 'text', array(
            'name' => 'redirect_to',
            'label' => $this->__('Redirect To'),
            'title' => $this->__('Redirect To'),
        ));

        $fieldset->addField('redirect_type', 'select', array(
            'name' => 'redirect_type',
            'label' => $this->__('Redirect Type'),
            'title' => $this->__('Redirect Type'),
            'options' => [
                301 => '301',
                302 => '302',
            ],
        ));
    }
}
