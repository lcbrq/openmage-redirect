<?php

class LCB_Redirect_Model_Observer
{
    /**
     * @param Varien_Event_Observer $observer
     * @return void
     */
    public function checkRedirect(Varien_Event_Observer $observer)
    {
        $front = $observer->getEvent()->getFront();

        /** @var Mage_Core_Controller_Request_Http $request */
        $request = $front->getRequest();

        /** @var Mage_Core_Controller_Response_Http $response */
        $response = $front->getResponse();

        if (!$request || !$response || $request->isPost()) {
            return;
        }

        $url = Mage::helper('core/url')->getCurrentUrl();

        /** @var LCB_Redirect_Model_Url $redirect */
        $redirect = Mage::getModel('lcb_redirect/url')->getCollection()
            ->addFieldToFilter('redirect_from', ['eq' => $url])
            ->getFirstItem();

        if ($redirect && $redirect->getId()) {
            $redirectTo = $redirect->getRedirectTo();
            $redirectType = (int)$redirect->getRedirectType();

            if (!preg_match('#^https?://#', $redirectTo)) {
                $redirectTo = Mage::getBaseUrl() . ltrim($redirectTo, '/');
            }

            $response->setRedirect($redirectTo, $redirectType);
            $response->sendResponse();
            exit;
        }
    }
}
