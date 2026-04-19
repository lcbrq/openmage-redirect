<?php

class LCB_Redirect_Model_System_Config_Source_CustomerGroups
{
    /**
     * @return array
     */
    public function toOptionArray()
    {
        $options = array();
        $groups = Mage::getResourceModel('customer/group_collection')
            ->toOptionArray();

        foreach ($groups as $group) {
            $options[] = array(
                'value' => $group['value'],
                'label' => $group['label'],
            );
        }

        return $options;
    }
}
