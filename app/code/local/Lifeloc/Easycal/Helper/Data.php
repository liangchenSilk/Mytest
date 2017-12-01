<?php
/**
 * News Data helper
 *
 * @author Magento
 */
class Lifeloc_Easycal_Helper_Data extends Mage_Core_Helper_Data
{
    /**
     * Path to store config if front-end output is enabled
     *
     * @var string
     */
//    const XML_PATH_ENABLED            = 'distributors/view/enabled';

    /**
     * Path to store config where count of news posts per page is stored
     *
     * @var string
     */
//    const XML_PATH_ITEMS_PER_PAGE     = 'distributors/view/items_per_page';

    /**
     * Path to store config where count of days while news is still recently added is stored
     *
     * @var string
     */
 //   const XML_PATH_DAYS_DIFFERENCE    = 'distributors/view/days_difference';

    /**
     * News Item instance for lazy loading
     *
     * @var Lifeloc_Distributors_Model_Distributors
     */
    protected $_easycalItemInstance;

    /**
     * Checks whether news can be displayed in the frontend
     *
     * @param integer|string|Mage_Core_Model_Store $store
     * @return boolean
     */
   /** public function isEnabled($store = null)
    {
        return Mage::getStoreConfigFlag(self::XML_PATH_ENABLED, $store);
    }
*/
    /**
     * Return the number of items per page
     *
     * @param integer|string|Mage_Core_Model_Store $store
     * @return int
     */
  /**  public function getDistributorsPerPage($store = null)
    {
        return abs((int)Mage::getStoreConfig(self::XML_PATH_ITEMS_PER_PAGE, $store));
    }
*/
    /**
     * Return difference in days while news is recently added
     *
     * @param integer|string|Mage_Core_Model_Store $store
     * @return int
     */
  /**  public function getDaysDifference($store = null)
    {
        return abs((int)Mage::getStoreConfig(self::XML_PATH_DAYS_DIFFERENCE, $store));
    }
*/
    /**
     * Return current news item instance from the Registry
     *
     * @return Lifeloc_Distributors_Model_Distributors
     */
    public function getEasycalItemInstance()
    {
        if (!$this->_easycalItemInstance) {
            $this->_easycalItemInstance = Mage::registry('easycal_item');

            if (!$this->_easycalItemInstance) {
                Mage::throwException($this->__('Easycal instance does not exist in Registry'));
            }
        }

        return $this->_easycalItemInstance;
    }
}
