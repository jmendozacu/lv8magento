<?php
namespace Saffron\News\Block\Adminhtml\Newspost;

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * @var \Magento\Framework\Module\Manager
     */
    protected $moduleManager;

    /**
     * @var \Saffron\News\Model\newspostFactory
     */
    protected $_newspostFactory;

    /**
     * @var \Saffron\News\Model\Status
     */
    protected $_status;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data $backendHelper
     * @param \Saffron\News\Model\newspostFactory $newspostFactory
     * @param \Saffron\News\Model\Status $status
     * @param \Magento\Framework\Module\Manager $moduleManager
     * @param array $data
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Saffron\News\Model\NewspostFactory $NewspostFactory,
        \Saffron\News\Model\Status $status,
        \Magento\Framework\Module\Manager $moduleManager,
        array $data = []
    ) {
        $this->_newspostFactory = $NewspostFactory;
        $this->_status = $status;
        $this->moduleManager = $moduleManager;
        parent::__construct($context, $backendHelper, $data);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('postGrid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(false);
        $this->setVarNameFilter('post_filter');
    }

    /**
     * @return $this
     */
    protected function _prepareCollection()
    {
        $collection = $this->_newspostFactory->create()->getCollection();
        $this->setCollection($collection);

        parent::_prepareCollection();

        return $this;
    }

    /**
     * @return $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'id',
            [
                'header' => __('ID'),
                'type' => 'number',
                'index' => 'id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id'
            ]
        );


		
				$this->addColumn(
					'post_title',
					[
						'header' => __('Post Title'),
						'index' => 'post_title',
					]
				);
				
				$this->addColumn(
					'url_key',
					[
						'header' => __('URL Key'),
						'index' => 'url_key',
					]
				);
				

						$this->addColumn(
							'categories',
							[
								'header' => __('Categories'),
								'index' => 'categories',
								'type' => 'options',
								'options' => \Saffron\News\Block\Adminhtml\Newspost\Grid::getOptionArray4()
							]
						);

						
				$this->addColumn(
					'video_url',
					[
						'header' => __('Video Url '),
						'index' => 'video_url',
					]
				);
				
				$this->addColumn(
					'short_content',
					[
						'header' => __('Short Content'),
						'index' => 'short_content',
					]
				);
				

						$this->addColumn(
							'featured',
							[
								'header' => __('Featured'),
								'index' => 'featured',
								'type' => 'options',
								'options' => \Saffron\News\Block\Adminhtml\Newspost\Grid::getOptionArray7()
							]
						);

						
				$this->addColumn(
					'publish_at',
					[
						'header' => __('Publish At'),
						'index' => 'publish_at',
						'type'      => 'datetime',
					]
				);

					

						$this->addColumn(
							'status',
							[
								'header' => __('Status'),
								'index' => 'status',
								'type' => 'options',
								'options' => \Saffron\News\Block\Adminhtml\Newspost\Grid::getOptionArray9()
							]
						);

						


		
        //$this->addColumn(
            //'edit',
            //[
                //'header' => __('Edit'),
                //'type' => 'action',
                //'getter' => 'getId',
                //'actions' => [
                    //[
                        //'caption' => __('Edit'),
                        //'url' => [
                            //'base' => '*/*/edit'
                        //],
                        //'field' => 'id'
                    //]
                //],
                //'filter' => false,
                //'sortable' => false,
                //'index' => 'stores',
                //'header_css_class' => 'col-action',
                //'column_css_class' => 'col-action'
            //]
        //);
		

		
		   $this->addExportType($this->getUrl('news/*/exportCsv', ['_current' => true]),__('CSV'));
		   $this->addExportType($this->getUrl('news/*/exportExcel', ['_current' => true]),__('Excel XML'));

        $block = $this->getLayout()->getBlock('grid.bottom.links');
        if ($block) {
            $this->setChild('grid.bottom.links', $block);
        }

        return parent::_prepareColumns();
    }

	
    /**
     * @return $this
     */
    protected function _prepareMassaction()
    {

        $this->setMassactionIdField('id');
        //$this->getMassactionBlock()->setTemplate('Saffron_News::newspost/grid/massaction_extended.phtml');
        $this->getMassactionBlock()->setFormFieldName('newspost');

        $this->getMassactionBlock()->addItem(
            'delete',
            [
                'label' => __('Delete'),
                'url' => $this->getUrl('news/*/massDelete'),
                'confirm' => __('Are you sure?')
            ]
        );

        $statuses = $this->_status->getOptionArray();

        $this->getMassactionBlock()->addItem(
            'status',
            [
                'label' => __('Change status'),
                'url' => $this->getUrl('news/*/massStatus', ['_current' => true]),
                'additional' => [
                    'visibility' => [
                        'name' => 'status',
                        'type' => 'select',
                        'class' => 'required-entry',
                        'label' => __('Status'),
                        'values' => $statuses
                    ]
                ]
            ]
        );


        return $this;
    }
		

    /**
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('news/*/index', ['_current' => true]);
    }

    /**
     * @param \Saffron\News\Model\newspost|\Magento\Framework\Object $row
     * @return string
     */
    public function getRowUrl($row)
    {
		
        return $this->getUrl(
            'news/*/edit',
            ['id' => $row->getId()]
        );
		
    }

	
		static public function getOptionArray4()
		{
            $data_array=array(); 
			
			
			$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
         	$newcategories = $objectManager->create('Saffron\News\Model\ResourceModel\Newcategories\Collection')
			 ->addFieldToFilter('status', array('eq' => 0))
			 ->setOrder('position', 'DESC');
			$data_array[]='Select Category';
			foreach($newcategories as $categoriesitem){
				$newitem = $categoriesitem->getData();;
				$data_array[$newitem['id']]=$newitem['categorie_title'];

				   
			}
			
			 return($data_array);
            
		}
		static public function getValueArray4()
		{
            $data_array=array();
			foreach(\Saffron\News\Block\Adminhtml\Newspost\Grid::getOptionArray4() as $k=>$v){
               $data_array[]=array('value'=>$k,'label'=>$v);
			}
            return($data_array);

		}
		
		static public function getOptionArray7()
		{
           $data_array=array();
            $data_array[0]='other';		   
			$data_array[1]='Featured';
			$data_array[2]='Video';
			
            return($data_array);
		}
		static public function getValueArray7()
		{
            $data_array=array();
			foreach(\Saffron\News\Block\Adminhtml\Newspost\Grid::getOptionArray7() as $k=>$v){
               $data_array[]=array('value'=>$k,'label'=>$v);
			}
            return($data_array);

		}
		
		static public function getOptionArray9()
		{
            $data_array=array(); 
			$data_array[0]='Enable'; 
			$data_array[1]='Disable';
            return($data_array);
		}
		static public function getValueArray9()
		{
            $data_array=array();
			foreach(\Saffron\News\Block\Adminhtml\Newspost\Grid::getOptionArray9() as $k=>$v){
               $data_array[]=array('value'=>$k,'label'=>$v);
			}
            return($data_array);

		}
		

}