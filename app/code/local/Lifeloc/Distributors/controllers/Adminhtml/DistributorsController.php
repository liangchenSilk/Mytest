<?php
/**
 * News controller
 *
 * @author Magento
 */
class Lifeloc_Distributors_Adminhtml_DistributorsController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Init actions
     *
     * @return Lifeloc_Distributors_Adminhtml_DistributorsController
     */
    protected function _initAction()
    {
        // load layout, set active menu and breadcrumbs
        $this->loadLayout()
            ->_setActiveMenu('distributors/manage')
            ->_addBreadcrumb(
                  Mage::helper('lifeloc_distributors')->__('Distributors'),
                  Mage::helper('lifeloc_distributors')->__('Distributors')
              )
            ->_addBreadcrumb(
                  Mage::helper('lifeloc_distributors')->__('Manage Distributors'),
                  Mage::helper('lifeloc_distributors')->__('Manage Distributors')
              )
        ;
        return $this;
    }

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->_title($this->__('Distributors'))
             ->_title($this->__('Manage Distributors'));

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
       $this->_title($this->__('Distributors'))
            ->_title($this->__('Manage Distributors'));
        // 1. instance news model
        /* @var $model Magentostudy_News_Model_Item */
        $model = Mage::getModel('lifeloc_distributors/distributors');

	// 2. if exists id, check it and load data
  	$distributorsId = $this->getRequest()->getParam('id');
  	if ($distributorsId) {
      	$model->load($distributorsId);
      		if (!$model->getId()) {
          		$this->_getSession()->addError(
              		Mage::helper('lifeloc_distributors')->__('distributors item does not exist.')
          		);
          		return $this->_redirect('*/*/');
      		}	
		$this->_title('Edit');
      		$breadCrumb = Mage::helper('lifeloc_distributors')->__('Edit Item');
  	} else {
      		$this->_title(Mage::helper('lifeloc_distributors')->__('New Item'));
      		$breadCrumb = Mage::helper('lifeloc_distributors')->__('New Item');
  	}

	$this->_initAction()->_addBreadcrumb($breadCrumb, $breadCrumb);

  	// 3. Set entered data if was error when we do save
        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
        if (!empty($data)) {
            $model->addData($data);
        }

        // 4. Register model to use later in blocks
        Mage::register('distributors_item', $model);

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
            $model = Mage::getModel('lifeloc_distributors/distributors');

            // if news item exists, try to load it
            $distributorsId = $this->getRequest()->getParam('list_id');
            if ($distributorsId) {
                $model->load($distributorsId);
            }
		$model->addData($data);
                // save the data
                try{
			$hasError = false;
			$model->save();
                // display success message
                $this->_getSession()->addSuccess(
                    Mage::helper('lifeloc_distributors')->__('The new item has been saved.')
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
                    Mage::helper('lifeloc_distributors')->__('An error occurred while saving the new item.')
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
        $distributorsId = $this->getRequest()->getParam('id');
        if ($distributorsId) {
            try {
                // init model and delete
                /** @var $model Magentostudy_News_Model_Item */
                $model = Mage::getModel('lifeloc_distributors/distributors');
                $model->load($distributorsId);
                if (!$model->getId()) {
                    Mage::throwException(Mage::helper('lifeloc_distributors')->__('Unable to find a distributor item.'));
                }
                $model->delete();

                // display success message
                $this->_getSession()->addSuccess(
                    Mage::helper('lifeloc_distributors')->__('The distributor has been deleted.')
                );
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            } catch (Exception $e) {
                $this->_getSession()->addException($e,
                    Mage::helper('lifeloc_distributors')->__('An error occurred while deleting the item.')
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
                return Mage::getSingleton('admin/session')->isAllowed('distributors/manage/save');
                break;
            case 'delete':
                return Mage::getSingleton('admin/session')->isAllowed('distributors/manage/delete');
                break;
            default:
                return Mage::getSingleton('admin/session')->isAllowed('distributors/manage');
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
