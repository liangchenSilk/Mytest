<?php
/**
 * distributor item resource model
 *
 */
class Lifeloc_Easycal_Model_Resource_Easycal extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Initialize connection and define main table and primary key
     */
    protected function _construct()
    {
        $this->_init('lifeloc_easycal/easycal', 'easycal_id');
    }
}
