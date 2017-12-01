<?php
/**
 * News List admin grid container
 *
 * @author Magento
 */
class Lifeloc_Easycal_Block_Adminhtml_Easycal extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    /**
     * Block constructor
     */
    public function __construct()
    {
        $this->_blockGroup = 'lifeloc_easycal';
        $this->_controller = 'adminhtml_easycal';
        $this->_headerText = Mage::helper('lifeloc_easycal')->__('Manage');

        parent::__construct();

        if (Mage::helper('lifeloc_easycal/admin')->isActionAllowed('save')) {
            $this->_updateButton('add', 'label', Mage::helper('lifeloc_easycal')->__('Add'));
        } else {
            $this->_removeButton('add');
        }


    }
}
