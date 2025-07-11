<?php

class LCB_Redirect_Model_Resource_Url_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('lcb_redirect/url');
    }
}
