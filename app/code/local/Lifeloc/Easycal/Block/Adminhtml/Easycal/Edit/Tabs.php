<?php
/**
 * News List admin edit form tabs block
 *
 */
class Lifeloc_Easycal_Block_Adminhtml_Easycal_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    /**
     * Initialize tabs and define tabs block settings
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('page_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('lifeloc_easycal')->__('Info'));
    }
}
