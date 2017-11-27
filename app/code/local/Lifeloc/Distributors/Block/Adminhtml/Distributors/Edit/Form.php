<?php
/**
 * News List admin edit form block
 *
 * @author Magento
 */
class Lifeloc_Distributors_Block_Adminhtml_Distributors_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * Prepare form action
     *
     * @return Lifeloc_Distributors_Block_Adminhtml_Distributors_Edit_Form
     */
    protected function _prepareForm ()
    {
        $form = new Varien_Data_Form(array(
            'id'      => 'edit_form',
            'action'  => $this->getUrl('*/*/save'),
            'method'  => 'post',
            'enctype' => 'multipart/form-data'
        ));

        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }
}