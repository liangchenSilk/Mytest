 <?php
 /**
 * News frontend controller
 *
 * @author Magento
 */
class Lifeloc_Distributors_IndexController extends Mage_Core_Controller_Front_Action
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
       $lifeloc_email = "sales@lifeloc.com";
       $post = $this->getRequest()->getPost();
       if($post){
         echo "<br>".$post['email']."<br>".$post['firstname']."<br>".$post['lastname']."<br>";
         echo $post['message']."<br>";
         $distributor_name = $post['distributor'];
         echo $distributor_name."<br>";
         $distributor = Mage::getModel('lifeloc_distributors/distributors')->load($distributor_name, 'distributor');
         $distributor_email = $distributor->getData('email');
         echo $distributor_email;

         $mailTemplate = Mage::getModel('core/email_template')->loadDefault('distributors_email_email_template');

         $mailTemplate->setSenderName($post['firstname'].$post['lastname']);
         $mailTemplate->setSenderEmail('distributor');
         $mailTemplate->setType('html');
         $mailTemplate->setTemplateSubject('message to distributor');
         //echo $post['email']."<br>";
         $variables = array();
         $variables['firstname'] = $post['firstname'];
         $variables['lastname'] = $post['lastname'];
         $variables['customer_email'] = $post['email'];
         $variables['message'] = $post['message'];
         $mailTemplate->send(
           array('liang.chen@silksoftware.com', 'lchensilk@gmail.com'),
           $post['firstname'].$post['lastname'],
           $variables
           );
       }
       $this->_redirect('*/*/');
     }

}
