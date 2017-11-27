<?php
/**
 * News List admin edit form container
 *
 * @author Magento
 */
class Lifeloc_Distributors_Block_Adminhtml_Distributors_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Initialize edit form container
     *
     */
    public function __construct()
    {	
	echo "start";
        $this->_objectId   = 'id';
        $this->_blockGroup = 'lifeloc_distributors';
        $this->_controller = 'adminhtml_distributors';

        parent::__construct();

        if (Mage::helper('lifeloc_distributors/admin')->isActionAllowed('save')) {
            $this->_updateButton('save', 'label', Mage::helper('lifeloc_distributors')->__('Save a Distributor'));
            $this->_addButton('saveandcontinue', array(
                'label'   => Mage::helper('adminhtml')->__('Save and Continue Edit'),
                'onclick' => 'saveAndContinueEdit()',
                'class'   => 'save',
            ), -100);
        } else {
            $this->_removeButton('save');
        }

        if (Mage::helper('lifeloc_distributors/admin')->isActionAllowed('delete')) {
            $this->_updateButton('delete', 'label', Mage::helper('lifeloc_distributors')->__('Delete a Distributor'));
        } else {
            $this->_removeButton('delete');
        }

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('page_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'page_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'page_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    /**
     * Retrieve text for header element depending on loaded page
     *
     * @return string
     */
/**
    public function getHeaderText()
    {
        $model = Mage::helper('lifeloc_distributors')->getDistributorsItemInstance();
        if ($model->getId()) {
            return Mage::helper('lifeloc_distributors')->__("Edit Distributors Item '%s'",
                 $this->escapeHtml($model->getId()));
        } else {
            return Mage::helper('lifeloc_distributors')->__('New Distributors Item');
        }
    }
*/
}
