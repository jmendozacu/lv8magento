<?php

namespace Saffron\News\Block\Adminhtml\Newspost\Edit\Tab;

/**
 * Newspost edit form main tab
 */
class Main extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @var \Saffron\News\Model\Status
     */
    protected $_status;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        \Saffron\News\Model\Status $status,
        array $data = []
    ) {
        $this->_systemStore = $systemStore;
        $this->_status = $status;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form
     *
     * @return $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareForm()
    {
        /* @var $model \Saffron\News\Model\BlogPosts */
        $model = $this->_coreRegistry->registry('newspost');

        $isElementDisabled = false;

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $form->setHtmlIdPrefix('page_');

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Item Information')]);

        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', ['name' => 'id']);
        }

		
      /*  $fieldset->addField(
            'id',
            'text',
            [
                'name' => 'id',
                'label' => __('ID'),
                'title' => __('ID'),
				
                'disabled' => $isElementDisabled
            ]
        );*/
					
        $fieldset->addField(
            'post_title',
            'text',
            [
                'name' => 'post_title',
                'label' => __('Post Title'),
                'title' => __('Post Title'),
				'required' => true,
                'disabled' => $isElementDisabled
            ]
        );
					

        $fieldset->addField(
            'thumbnail',
            'image',
            [
                'name' => 'thumbnail',
                'label' => __('Thumbnail Image'),
                'title' => __('Thumbnail Image'),
				'required' => true,
                'disabled' => $isElementDisabled
            ]
        );
        
		
		 $fieldset->addField(
            'featuredimg',
            'image',
            [
                'name' => 'featuredimg',
                'label' => __('Featured Image'),
                'title' => __('Featured Image'),
				'required' => true,
                'disabled' => $isElementDisabled
            ]
        );
		
		 $fieldset->addField(
            'vedioimg',
            'image',
            [
                'name' => 'vedioimg',
                'label' => __('Vedio Image'),
                'title' => __('Vedio Image'),
				'required' => true,
                'disabled' => $isElementDisabled
            ]
        );
			

       $fieldset->addField(
            'detailpagebanner',
            'image',
            [
                'name' => 'detailpagebanner',
                'label' => __('Detail Page Banner'),
                'title' => __('Detail Page Banner'),
				'required' => true,
                'disabled' => $isElementDisabled
            ]
        );			
        $fieldset->addField(
            'url_key',
            'text',
            [
                'name' => 'url_key',
                'label' => __('URL Key'),
                'title' => __('URL Key'),
				'required' => true,
                'disabled' => $isElementDisabled
            ]
        );
					

        $fieldset->addField(
            'categories',
            'select',
            [
                'label' => __('Categories'),
                'title' => __('Categories'),
                'name' => 'categories',
				
                'options' => \Saffron\News\Block\Adminhtml\Newspost\Grid::getOptionArray4(),
                'disabled' => $isElementDisabled
            ]
        );

		
		  $fieldset->addField(
            'short_content',
            'textarea',
            [
                'name' => 'short_content',
                'label' => __('Short Content'),
                'title' => __('Short Content'),
				'required' => true,
                'disabled' => $isElementDisabled
            ]
        );
					
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
		$wysiwygConfig = $objectManager->create('Magento\Cms\Model\Wysiwyg\Config');
        $widgetFilters = ['is_email_compatible' => 1];
        $wysiwygConfig = $wysiwygConfig->getConfig(['widget_filters' => $widgetFilters]);

        $fieldset->addField(
            'full_content',
            'editor',
            [
                'name' => 'full_content',
                'label' => __('Full Content'),
                'title' => __('Full Content'),
                'config' => $wysiwygConfig,
				'required' => true,
                'disabled' => $isElementDisabled
            ]
        );
						
        $fieldset->addField(
            'video_url',
            'text',
            [
                'name' => 'video_url',
                'label' => __('Video Url '),
                'title' => __('Video Url '),
				
                'disabled' => $isElementDisabled
            ]
        );
					
      
		
		
        $fieldset->addField(
            'featured',
            'select',
            [
                'label' => __('Select Type'),
                'title' => __('Select Type'),
                'name' => 'featured',
				
                'options' => \Saffron\News\Block\Adminhtml\Newspost\Grid::getOptionArray7(),
                'disabled' => $isElementDisabled
            ]
        );

						

        $dateFormat = $this->_localeDate->getDateFormat(
            \IntlDateFormatter::MEDIUM
        );
        $timeFormat = $this->_localeDate->getTimeFormat(
            \IntlDateFormatter::MEDIUM
        );

        $fieldset->addField(
            'publish_at',
            'date',
            [
                'name' => 'publish_at',
                'label' => __('Publish At'),
                'title' => __('Publish At'),
                    'date_format' => $dateFormat,
                    //'time_format' => $timeFormat,
				
                'disabled' => $isElementDisabled
            ]
        );


						

        $fieldset->addField(
            'status',
            'select',
            [
                'label' => __('Status'),
                'title' => __('Status'),
                'name' => 'status',
				'required' => true,
                'options' => \Saffron\News\Block\Adminhtml\Newspost\Grid::getOptionArray9(),
                'disabled' => $isElementDisabled
            ]
        );

						

		


						

        if (!$model->getId()) {
            $model->setData('is_active', $isElementDisabled ? '0' : '1');
        }

        $form->setValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabLabel()
    {
        return __('Item Information');
    }

    /**
     * Prepare title for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle()
    {
        return __('Item Information');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }

    public function getTargetOptionArray(){
    	return array(
    				'_self' => "Self",
					'_blank' => "New Page",
    				);
    }
}
