<?php
class Lifeloc_Distributors_Model_Distributors extends Mage_Core_Model_Abstract {
	protected function _construct() {
		$this -> _init('lifeloc_distributors/distributors');
	}
  /**
   * If object is new adds creation date
   *
   * @return Lifeloc_Distributors_Model_Distributors
   */
/**  protected function _beforeSave()
  {
      parent::_beforeSave();
      if ($this->isObjectNew()) {
          $this->setData('created_at', Varien_Date::now());
      }
      return $this;
  }
*/
}
