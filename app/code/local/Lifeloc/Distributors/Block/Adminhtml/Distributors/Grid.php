<?php
/**
 * News List admin grid
 *
 * @author Magento
 */
class Lifeloc_Distributors_Block_Adminhtml_Distributors_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * Init Grid default properties
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('distributors_list_grid');
        $this->setDefaultSort('list_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    /**
     * Prepare collection for Grid
     *
     * @return Lifeloc_Distributors_Block_Adminhtml_Grid
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('lifeloc_distributors/distributors')->getResourceCollection();

        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * Prepare Grid columns
     *
     * @return Mage_Adminhtml_Block_Catalog_Search_Grid
     */
    protected function _prepareColumns()
    {
        $this->addColumn('list_id', array(
            'header'    => Mage::helper('lifeloc_distributors')->__('ID'),
            'width'     => '50px',
            'index'     => 'list_id',
        ));


        $this->addColumn('location_id', array(
            'header'    => Mage::helper('lifeloc_distributors')->__('Location ID'),
            'index'     => 'location_id',
        ));

        $this->addColumn('location_name', array(
            'header'    => Mage::helper('lifeloc_distributors')->__('Location Name'),
            'index'     => 'location_name',
		'sortable' => true,
        ));

        $this->addColumn('distributor', array(
            'header'   => Mage::helper('lifeloc_distributors')->__('Distributor'),
            'sortable' => true,
            'width'    => '170px',
            'index'    => 'distributor',
        ));

        $this->addColumn('email', array(
            'header'   => Mage::helper('lifeloc_distributors')->__('Email'),
            'sortable' => true,
            'width'    => '500px',
            'index'    => 'email',
        ));

        $this->addColumn('action',
            array(
                'header'    => Mage::helper('lifeloc_distributors')->__('Action'),
                'width'     => '100px',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(array(
                    'caption' => Mage::helper('lifeloc_distributors')->__('Edit'),
                    'url'     => array('base' => '*/*/edit'),
                    'field'   => 'id'
                )),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'distributors',
        ));

        return parent::_prepareColumns();
    }

    /**
     * Return row URL for js event handlers
     *
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

    /**
     * Grid url getter
     *
     * @return string current grid url
     */
    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current' => true));
    }
}
