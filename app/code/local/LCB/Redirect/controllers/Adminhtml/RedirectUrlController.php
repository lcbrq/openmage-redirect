<?php

class LCB_Redirect_Adminhtml_RedirectUrlController extends Mage_Adminhtml_Controller_Action
{
    /**
     * @inheritDoc
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('catalog/lcb_redirect');
    }


    /**
     * @return void
     */
    public function indexAction()
    {
        $this->_title($this->__('Catalog'))->_title($this->__('Redirects'));
        $this->loadLayout();
        $this->_setActiveMenu('catalog/lcb_redirect');
        $this->_addContent($this->getLayout()->createBlock('lcb_redirect/adminhtml_url'));
        $this->renderLayout();
    }

    /**
     * @return void
     */
    public function editAction()
    {
        $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('lcb_redirect/url')->load($id);

        Mage::register('redirect_data', $model);
        $this->loadLayout();
        $this->_setActiveMenu('catalog/lcb_redirect');
        $this->_addContent($this->getLayout()->createBlock('lcb_redirect/adminhtml_url_edit'));
        $this->renderLayout();
    }

    /**
     * @return void
     */
    public function newAction()
    {
        $this->_forward('edit');
    }

    /**
     * @return void
     */
    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost()) {
            $id = $this->getRequest()->getParam('id');
            $model = Mage::getModel('lcb_redirect/url')->load($id);
            $model->addData($data);

            try {
                $model->save();
                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Redirect saved successfully.'));
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', ['id' => $id]);
                return;
            }
        }
        $this->_redirect('*/*/');
    }

    /**
     * @return void
     */
    public function deleteAction()
    {
        $id = $this->getRequest()->getParam('id');
        if ($id > 0) {
            try {
                Mage::getModel('lcb_redirect/url')->setId($id)->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Redirect deleted successfully.'));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/');
    }

    /**
     * @return void
     */
    public function massDeleteAction()
    {
        $ids = $this->getRequest()->getParam('redirect');
        if (!is_array($ids)) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Please select redirect(s) to delete.'));
        } else {
            try {
                foreach ($ids as $id) {
                    Mage::getModel('lcb_redirect/url')->load($id)->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    $this->__('Total of %d record(s) were deleted.', count($ids))
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/');
    }
}
