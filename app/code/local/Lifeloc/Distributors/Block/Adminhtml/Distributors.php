<?php
/**
 * News List admin grid container
 *
 * @author Magento
 */
class Lifeloc_Distributors_Block_Adminhtml_Distributors extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    /**
     * Block constructor
     */
    public function __construct()
    {
        $this->_blockGroup = 'lifeloc_distributors';
        $this->_controller = 'adminhtml_distributors';
        $this->_headerText = Mage::helper('lifeloc_distributors')->__('Manage Distributors');

        parent::__construct();

        if (Mage::helper('lifeloc_distributors/admin')->isActionAllowed('save')) {
            $this->_updateButton('add', 'label', Mage::helper('lifeloc_distributors')->__('Add a New Distributor'));
        } else {
            $this->_removeButton('add');
        }


    }
}
