<?php
/**
* Copyright © 2015 Saffron.com. All rights reserved.

* @author Saffron Team <contact@Saffron.com>
*/

namespace Saffron\Bannerslider\Block\Adminhtml\Banner\Edit\Tab;

use Saffron\Bannerslider\Model\Status;

class Banner extends \Magento\Backend\Block\Widget\Form\Generic
 implements \Magento\Backend\Block\Widget\Tab\TabInterface {
	/**
	 * @var \Magento\Framework\ObjectFactory
	 */
	protected $_objectFactory;

	/**
	 * @var \Magento\Store\Model\System\Store
	 */
	protected $_systemStore;

	/**
	 * helper
	 * @var \Saffron\Bannerslider\Helper\Data
	 */
	protected $_bannersliderHelper;

	/**
	 * @var \Saffron\Bannerslider\Model\Banner
	 */
	protected $_banner;

	/**
	 * [__construct description]
	 * @param \Magento\Backend\Block\Template\Context    $context            [description]
	 * @param \Saffron\Bannerslider\Helper\Data        $bannersliderHelper [description]
	 * @param \Magento\Framework\Registry                $registry           [description]
	 * @param \Magento\Framework\Data\FormFactory        $formFactory        [description]
	 * @param \Magento\Store\Model\System\Store          $systemStore        [description]
	 * @param \Magento\Framework\ObjectFactory           $objectFactory      [description]
	 * @param \Saffron\Bannerslider\Model\Banner       $banner             [description]
	 * @param array                                      $data               [description]
	 */
	public function __construct(
		\Magento\Backend\Block\Template\Context $context,
		\Saffron\Bannerslider\Helper\Data $bannersliderHelper,
		\Magento\Framework\Registry $registry,
		\Magento\Framework\Data\FormFactory $formFactory,
		\Magento\Store\Model\System\Store $systemStore,
		\Saffron\Bannerslider\Model\Banner $banner,
		array $data = []
	) {
		$this->_localeDate = $context->getLocaleDate();
		$this->_systemStore = $systemStore;
		$this->_bannersliderHelper = $bannersliderHelper;
		$this->_banner = $banner;
		parent::__construct($context, $registry, $formFactory, $data);
	}

	protected function _prepareLayout() {
		$this->getLayout()->getBlock('page.title')->setPageTitle($this->getPageTitle());

		\Magento\Framework\Data\Form::setFieldsetElementRenderer(
			$this->getLayout()->createBlock(
				'Saffron\Bannerslider\Block\Adminhtml\Form\Renderer\Fieldset\Element',
				$this->getNameInLayout() . '_fieldset_element'
			)
		);
	}

	/**
	 * Prepare form
	 *
	 * @return $this
	 */
	protected function _prepareForm() {
		$model = $this->_coreRegistry->registry('banner');

		// $storeViewId = $this->getRequest()->getParam('store');
		
		/** @var \Magento\Framework\Data\Form $form */
		$form = $this->_formFactory->create();

		$form->setHtmlIdPrefix($this->_banner->getFormFieldHtmlIdPrefix());

		$fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Banner Information')]);

		if ($model->getId()) {
			$fieldset->addField('banner_id', 'hidden', ['name' => 'banner_id']);
		}

		$elements = [];
		
		$elements['categories'] = $fieldset->addField(
			'categories',
			'select',
			[
				'label' => __('Select Home Page'),
				'title' => __('Select Home Page'),
				'name' => 'categories',
				'options' => \Saffron\Bannerslider\Block\Adminhtml\Banner\Grid::getCategoriesAction(),
			]
		);
		
		
		$elements['name'] = $fieldset->addField(
			'name',
			'text',
			[
				'name' => 'name',
				'label' => __('Name'),
				'title' => __('Name'),
			]
		);
		
		/**
         * Check is single store mode
         */
		
        $elements['store_id'] = $fieldset->addField(
			'store_id',
			'multiselect',
			[
				'name' => 'stores[]',
				'label' => __('Store View'),
				'title' => __('Store View'),
				'required' => true,
				'values' => $this->_systemStore->getStoreValuesForForm(false, true),
			]
		);
		
		$elements['title1'] = $fieldset->addField(
			'title1',
			'text',
			[
				'name' => 'title1',
				'label' => __('Title 1'),
				'title' => __('Title 1'),
			]
		);
		
		
		
		$elements['status'] = $fieldset->addField(
			'status',
			'select',
			[
				'label' => __('Status'),
				'title' => __('Banner Status'),
				'name' => 'status',
				'options' => Status::getAvailableStatuses(),
			]
		);


		
		 $elements['title2'] = $fieldset->addField(
			'title2',
			'text',
			[
				'name' => 'title2',
				'label' => __('Mobile vedio  URL'),
				'title' => __('Mobile vedio  URL'),
			]
		);
		
		$elements['click_url'] = $fieldset->addField(
			'click_url',
			'text',
			[
				'title' => __(' Desktop vedio  URL'),
				'label' => __('Vedio  URL'),
				'name' => 'click_url',
			]
		);
		
		
		
		$elements['image_alt'] = $fieldset->addField(
			'image_alt',
			'text',
			[
				'title' => __('Vedio Sound'),
				'label' => __('Vedio Sound'),
				'name' => 'image_alt',
				'note' => 'Used for SEO',
			]
		);


   

		$elements['image'] = $fieldset->addField(
			'image',
			'image',
			[
				'title' => __('Banner Image'),
				'label' => __('Banner Image'),
				'name' => 'image',
				'note' => 'Allow image type: jpg, jpeg, gif, png',
			]

		);
		
		$elements['description'] = $fieldset->addField(
			'description',
			'textarea',
			[
				'title' => __('Description'),
				'label' => __('Description'),
				'name' => 'description',
			]
		);
		
		$elements['order'] = $fieldset->addField(
			'order',
			'text',
			[
				'name' => 'order',
				'label' => __('Order'),
				'title' => __('Order'),
			]
		);
		
		$this->_eventManager->dispatch('adminhtml_cms_page_edit_tab_main_prepare_form', ['form' => $form]);
		
		$form->setValues($model->getData());
		$this->setForm($form);

		return parent::_prepareForm();
	}

	public function getBanner() {
		return $this->_coreRegistry->registry('banner');
	}

	public function getPageTitle() {
		// return $this->getBanner()->getId() ? __("Edit Banner '%1'", $this->escapeHtml($this->getBanner()->getName())) : __('New Banner');
	}

	/**
	 * Prepare label for tab
	 *
	 * @return string
	 */
	public function getTabLabel() {
		return __('Banner Information');
	}

	/**
	 * Prepare title for tab
	 *
	 * @return string
	 */
	public function getTabTitle() {
		return __('Banner Information');
	}

	/**
	 * {@inheritdoc}
	 */
	public function canShowTab() {
		return true;
	}

	/**
	 * {@inheritdoc}
	 */
	public function isHidden() {
		return false;
	}

	/**
	 * Check permission for passed action
	 *
	 * @param string $resourceId
	 * @return bool
	 */
	protected function _isAllowedAction($resourceId) {
		return $this->_authorization->isAllowed($resourceId);
	}
}
