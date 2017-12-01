 <?php
 /**
 * News frontend controller
 *
 * @author Magento
 */
class Lifeloc_Easycal_IndexController extends Mage_Core_Controller_Front_Action
{
    /**
     * Pre dispatch action that allows to redirect to no route page in case of disabled extension through admin panel
     */
    public function preDispatch()
    {
        parent::preDispatch();

    }
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->loadLayout();
	$this->renderLayout();
    }
	/**
	public function testAction() {
		echo "test";
		$this->loadLayout();
		$this->renderLayout();
	}
*/

    /**
     * News view action
     */
     //deleted the code block

     /**
     * post form and find a distributor
     */
     public function postAction() {

     }

}
