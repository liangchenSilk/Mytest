<?php
/* List admin edit form main tab
 *
 * @author Magento
 */
class Lifeloc_Distributors_Block_Adminhtml_Distributors_Edit_Tab_Main
    extends Mage_Adminhtml_Block_Widget_Form
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    /**
     * Prepare form elements for tab
     *
     * @return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
	 $model = Mage::helper('lifeloc_distributors')->getDistributorsItemInstance();
        /**
         * Checking if user have permissions to save information
         */

        $form = new Varien_Data_Form();

        $form->setHtmlIdPrefix('distributors_main_');

       $fieldset = $form->addFieldset('base_fieldset', array(
            'legend' => Mage::helper('lifeloc_distributors')->__('Distributors Info')
        ));

        if ($model->getId()) {
            $fieldset->addField('list_id', 'hidden', array(
                'name' => 'list_id',
            ));
        }

        $fieldset->addField('location_id','text', array(
            'name'     => 'location_id',
            'label'    => Mage::helper('lifeloc_distributors')->__('Location ID'),
            'title'    => Mage::helper('lifeloc_distributors')->__('Location ID'),
            'required' => true,
        ));

        $fieldset->addField('location_name', 'text', array(
            'name'     => 'location_name',
            'label'    => Mage::helper('lifeloc_distributors')->__('Location Name'),
            'title'    => Mage::helper('lifeloc_distributors')->__('Location Name'),
            'required' => true,
        ));

        $fieldset->addField('distributor', 'text', array(
            'name'     => 'distributor',
            'label'    => Mage::helper('lifeloc_distributors')->__('Distributor'),
            'title'    => Mage::helper('lifeloc_distributors')->__('Distributor'),

        ));

        $fieldset->addField('email', 'text', array(
            'name'     => 'email',
            'label'    => Mage::helper('lifeloc_distributors')->__('Email'),
            'title'    => Mage::helper('lifeloc_distributors')->__('Email'),
           
        ));

        Mage::dispatchEvent('adminhtml_distributors_edit_tab_main_prepare_form', array('form' => $form));

        $form->setValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return Mage::helper('lifeloc_distributors')->__('Distributor Info');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return Mage::helper('lifeloc_distributors')->__('Distributor Info');
    }

    /**
     * Returns status flag about this tab can be shown or not
     *
     * @return true
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * Returns status flag about this tab hidden or not
     *
     * @return true
     */
    public function isHidden()
    {
        return false;
    }
}

