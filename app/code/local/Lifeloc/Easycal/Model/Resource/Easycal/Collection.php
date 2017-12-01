<?php
/**
 * News collection
 *
 * @author Magento
 */
class Lifeloc_Easycal_Model_Resource_Easycal_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * Define collection model
     */
    protected function _construct()
    {
        $this->_init('lifeloc_easycal/easycal');
    }

    /**
     * Prepare for displaying in list
     *
     * @param integer $page
     * @return Lifeloc_Distributors_Model_Resource_Distributors_Collection
     */
    public function prepareForList($page)
    {
        //$this->setPageSize(Mage::helper('lifeloc_distributors')->getNewsPerPage());
        //$this->setCurPage($page)->setOrder('published_at', Varien_Data_Collection::SORT_ORDER_DESC);
        $this->setCurPage($page)->setOrder('easycal_id', Varien_Data_Collection::SORT_ORDER_ASC);
        return $this;
    }
}
