<?php

class LCB_Redirect_Model_Url extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('lcb_redirect/url');
    }

    protected function _beforeSave()
    {
        $groupIds = $this->getData('customer_group_ids');

        if (is_array($groupIds)) {
            $groupIds = array_filter($groupIds, 'strlen');
            $this->setData('customer_group_ids', $groupIds ? implode(',', $groupIds) : '');
        } elseif ($groupIds === null || $groupIds === '') {
            $this->setData('customer_group_ids', '');
        }

        return parent::_beforeSave();
    }

    protected function _afterLoad()
    {
        $this->setData('customer_group_ids', $this->getCustomerGroupIdsArray());
        return parent::_afterLoad();
    }

    /**
     * @return array
     */
    public function getCustomerGroupIdsArray()
    {
        $ids = $this->getData('customer_group_ids');
        if ($ids === null || $ids === '') {
            return array();
        }

        if (is_array($ids)) {
            return $ids;
        }

        return array_filter(explode(',', $ids), 'strlen');
    }
}
