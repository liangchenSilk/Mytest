<?php
/* List admin edit form main tab
 *
 * @author Magento
 */
class Lifeloc_Easycal_Block_Adminhtml_Easycal_Edit_Tab_Main
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
	 $model = Mage::helper('lifeloc_easycal')->getEasycalItemInstance();
        /**
         * Checking if user have permissions to save information
         */

        $form = new Varien_Data_Form();

        $form->setHtmlIdPrefix('easycal_main_');

       $fieldset = $form->addFieldset('base_fieldset', array(
            'legend' => Mage::helper('lifeloc_easycal')->__('Info')
        ));

        if ($model->getId()) {
            $fieldset->addField('easycal_id', 'hidden', array(
                'name' => 'easycal_id',
            ));
        }

        $fieldset->addField('serial_no','text', array(
            'name'     => 'serial_no',
            'label'    => Mage::helper('lifeloc_easycal')->__('Serial Number'),
            'title'    => Mage::helper('lifeloc_easycal')->__('Serial Number'),
            'required' => true,
        ));

        $fieldset->addField('model', 'text', array(
            'name'     => 'model',
            'label'    => Mage::helper('lifeloc_easycal')->__('Model'),
            'title'    => Mage::helper('lifeloc_easycal')->__('Model'),
            'required' => true,
        ));

        $fieldset->addField('message', 'text', array(
            'name'     => 'message',
            'label'    => Mage::helper('lifeloc_easycal')->__('Message'),
            'title'    => Mage::helper('lifeloc_easycal')->__('Message'),

        ));

        Mage::dispatchEvent('adminhtml_easycal_edit_tab_main_prepare_form', array('form' => $form));

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
        return Mage::helper('lifeloc_easycal')->__('Info');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return Mage::helper('lifeloc_easycal')->__('Info');
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

