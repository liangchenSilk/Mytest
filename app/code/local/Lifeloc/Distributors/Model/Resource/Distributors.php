<?php
/**
 * distributor item resource model
 *
 */
class Lifeloc_Distributors_Model_Resource_Distributors extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Initialize connection and define main table and primary key
     */
    protected function _construct()
    {
        $this->_init('lifeloc_distributors/distributors', 'list_id');
    }
}
