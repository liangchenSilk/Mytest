<?php
/**
 * News controller
 *
 * @author Magento
 */
class Lifeloc_Easycal_Adminhtml_EasycalController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Init actions
     *
     */
    protected function _initAction()
    {
        // load layout, set active menu and breadcrumbs
        $this->loadLayout()
            ->_setActiveMenu('easycal/manage')
            ->_addBreadcrumb(
                  Mage::helper('lifeloc_easycal')->__('Easycal'),
                  Mage::helper('lifeloc_easycal')->__('Easycal')
              )
            ->_addBreadcrumb(
                  Mage::helper('lifeloc_easycal')->__('Manage'),
                  Mage::helper('lifeloc_easycal')->__('Manage')
              )
        ;
        return $this;
    }

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->_title($this->__('Easycal'))
             ->_title($this->__('Manage'));

        $this->_initAction();
        $this->renderLayout();
    }

    /**
     * Create new News item
     */
    public function newAction()
    {
        // the same form is used to create and edit
        $this->_forward('edit');
    }

    /**
     * Edit News item
     */
    public function editAction()
    {
       $this->_title($this->__('Easycal'))
            ->_title($this->__('Manage'));
        // 1. instance news model
        /* @var $model Magentostudy_News_Model_Item */
        $model = Mage::getModel('lifeloc_easycal/easycal');

	// 2. if exists id, check it and load data
  	$easycalId = $this->getRequest()->getParam('id');
  	if ($easycalId) {
      	$model->load($easycalId);
      		if (!$model->getId()) {
          		$this->_getSession()->addError(
              		Mage::helper('lifeloc_easycal')->__('item does not exist.')
          		);
          		return $this->_redirect('*/*/');
      		}	
		$this->_title('Edit');
      		$breadCrumb = Mage::helper('lifeloc_easycal')->__('Edit');
  	} else {
      		$this->_title(Mage::helper('lifeloc_easycal')->__('New'));
      		$breadCrumb = Mage::helper('lifeloc_easycal')->__('New');
  	}

	$this->_initAction()->_addBreadcrumb($breadCrumb, $breadCrumb);

  	// 3. Set entered data if was error when we do save
        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
        if (!empty($data)) {
            $model->addData($data);
        }

        // 4. Register model to use later in blocks
        Mage::register('easycal_item', $model);

	//echo "end";

        $this->renderLayout();
    }

    /**
     * Save action
     */
    public function saveAction()
    {
        $redirectPath   = '*/*';
        $redirectParams = array();

        // check if data sent
        $data = $this->getRequest()->getPost();
        if ($data) {
           // $data = $this->_filterPostData($data);
            // init model and set data
            /* @var $model Magentostudy_News_Model_Item */
            $model = Mage::getModel('lifeloc_easycal/easycal');

            // if news item exists, try to load it
            $easycalId = $this->getRequest()->getParam('easycal_id');
            if ($easycalId) {
                $model->load($easycalId);
            }
		$model->addData($data);
                // save the data
                try{
			$hasError = false;
			$model->save();
                // display success message
                $this->_getSession()->addSuccess(
                    Mage::helper('lifeloc_easycal')->__('The new item has been saved.')
                );

                // check if 'Save and Continue'
                if ($this->getRequest()->getParam('back')) {
                    $redirectPath   = '*/*/edit';
                    $redirectParams = array('id' => $model->getId());
                }
            } catch (Mage_Core_Exception $e) {
                $hasError = true;
                $this->_getSession()->addError($e->getMessage());
            } catch (Exception $e) {
                $hasError = true;
                $this->_getSession()->addException($e,
                    Mage::helper('lifeloc_easycal')->__('An error occurred while saving the new item.')
                );
            }

            if ($hasError) {
                $this->_getSession()->setFormData($data);
                $redirectPath   = '*/*/edit';
                $redirectParams = array('id' => $this->getRequest()->getParam('id'));
            }
        }

        $this->_redirect($redirectPath, $redirectParams);
    }

    /**
     * Delete action
     */
    public function deleteAction()
    {
        // check if we know what should be deleted
        $easycalId = $this->getRequest()->getParam('id');
        if ($easycalId) {
            try {
                // init model and delete
                /** @var $model Magentostudy_News_Model_Item */
                $model = Mage::getModel('lifeloc_easycal/easycal');
                $model->load($easycalId);
                if (!$model->getId()) {
                    Mage::throwException(Mage::helper('lifeloc_easycal')->__('Unable to find an item.'));
                }
                $model->delete();

                // display success message
                $this->_getSession()->addSuccess(
                    Mage::helper('lifeloc_easycal')->__('The item has been deleted.')
                );
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            } catch (Exception $e) {
                $this->_getSession()->addException($e,
                    Mage::helper('lifeloc_easycal')->__('An error occurred while deleting the item.')
                );
            }
        }

        // go to grid
        $this->_redirect('*/*/');
    }

    /**
     * Check the permission to run it
     *
     * @return boolean
     */
    protected function _isAllowed()
    {
        switch ($this->getRequest()->getActionName()) {
            case 'new':
            case 'save':
                return Mage::getSingleton('admin/session')->isAllowed('easycal/manage/save');
                break;
            case 'delete':
                return Mage::getSingleton('admin/session')->isAllowed('easycal/manage/delete');
                break;
            default:
                return Mage::getSingleton('admin/session')->isAllowed('easycal/manage');
                break;
        }
    }

    /**
     * Filtering posted data. Converting localized data if needed
     *
     * @param array
     * @return array
     */
    protected function _filterPostData($data)
    {
        //$data = $this->_filterDates($data, array('time_published'));
        return $data;
    }

    /**
     * Grid ajax action
     */
    public function gridAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    /**
     * Flush News Posts Images Cache action
     */
/**
    public function flushAction()
    {
        if (Mage::helper('lifeloc_distributors/image')->flushImagesCache()) {
            $this->_getSession()->addSuccess('Cache successfully flushed');
        } else {
            $this->_getSession()->addError('There was error during flushing cache');
        }
        $this->_forward('index');
    }
*/
}
