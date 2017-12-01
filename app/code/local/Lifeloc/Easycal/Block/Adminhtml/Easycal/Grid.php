<?php
/**
 * News List admin grid
 *
 */
class Lifeloc_Easycal_Block_Adminhtml_Easycal_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * Init Grid default properties
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('easycal_list_grid');
        $this->setDefaultSort('easycal_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    /**
     * Prepare collection for Grid
     *
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('lifeloc_easycal/easycal')->getResourceCollection();

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
        $this->addColumn('easycal_id', array(
            'header'    => Mage::helper('lifeloc_easycal')->__('ID'),
            'width'     => '50px',
            'index'     => 'easycal_id',
        ));

        $this->addColumn('serial_no', array(
            'header'    => Mage::helper('lifeloc_easycal')->__('Serial Number'),
            'index'     => 'serial_no',
		'sortable' => true,
        ));

        $this->addColumn('model', array(
            'header'   => Mage::helper('lifeloc_easycal')->__('Model'),
            'sortable' => true,
            'width'    => '170px',
            'index'    => 'model',
        ));

        $this->addColumn('message', array(
            'header'   => Mage::helper('lifeloc_easycal')->__('Message'),
            'width'    => '500px',
            'index'    => 'message',
        ));

        $this->addColumn('action',
            array(
                'header'    => Mage::helper('lifeloc_easycal')->__('Action'),
                'width'     => '100px',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(array(
                    'caption' => Mage::helper('lifeloc_easycal')->__('Edit'),
                    'url'     => array('base' => '*/*/edit'),
                    'field'   => 'id'
                )),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'easycal',
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
