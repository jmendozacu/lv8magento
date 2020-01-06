<?php
namespace Saffron\News\Controller\Adminhtml\newspost;

use Magento\Backend\App\Action;
use Magento\Framework\App\Filesystem\DirectoryList;


class Save extends \Magento\Backend\App\Action
{

    /**
     * @param Action\Context $context
     */
    public function __construct(Action\Context $context)
    {
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();


        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $model = $this->_objectManager->create('Saffron\News\Model\Newspost');

            $id = $this->getRequest()->getParam('id');
            if ($id) {
                $model->load($id);
                $model->setCreatedAt(date('Y-m-d H:i:s'));
            }
			 if (isset($_FILES['thumbnail']) && !empty($_FILES['thumbnail']['name']) ) {
			
		
			try{
				$uploader = $this->_objectManager->create(
					'Magento\MediaStorage\Model\File\Uploader',
					['fileId' => 'thumbnail']
				);
				$uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
				/** @var \Magento\Framework\Image\Adapter\AdapterInterface $imageAdapter */
				$imageAdapter = $this->_objectManager->get('Magento\Framework\Image\AdapterFactory')->create();
				$uploader->setAllowRenameFiles(true);
				$uploader->setFilesDispersion(true);
				/** @var \Magento\Framework\Filesystem\Directory\Read $mediaDirectory */
				$mediaDirectory = $this->_objectManager->get('Magento\Framework\Filesystem')
					->getDirectoryRead(DirectoryList::MEDIA);
				$result = $uploader->save($mediaDirectory->getAbsolutePath('news_newspost'));
					if($result['error']==0)
					{
						$data['thumbnail'] = 'news_newspost' . $result['file'];
					}
			} catch (\Exception $e) {
				//unset($data['image']);
            }
			//var_dump($data);die;
			if(isset($data['thumbnail']['delete']) && $data['thumbnail']['delete'] == '1')
				$data['thumbnail'] = '';
           }else {
                if (isset($data['thumbnail']) && isset($data['thumbnail']['value'])) {
                    if (isset($data['thumbnail']['delete'])) {
                        $data['thumbnail'] = '';
                    } elseif (isset($data['thumbnail']['value'])) {
                        $data['thumbnail'] = $data['thumbnail']['value'];
                    } else {
                        $data['thumbnail'] = '';
                    }
                }
            }
             
			 
			if (isset($_FILES['vedioimg']) && !empty($_FILES['vedioimg']['name']) ) {
			
		
			try{
				$uploader = $this->_objectManager->create(
					'Magento\MediaStorage\Model\File\Uploader',
					['fileId' => 'vedioimg']
				);
				$uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
				/** @var \Magento\Framework\Image\Adapter\AdapterInterface $imageAdapter */
				$imageAdapter = $this->_objectManager->get('Magento\Framework\Image\AdapterFactory')->create();
				$uploader->setAllowRenameFiles(true);
				$uploader->setFilesDispersion(true);
				/** @var \Magento\Framework\Filesystem\Directory\Read $mediaDirectory */
				$mediaDirectory = $this->_objectManager->get('Magento\Framework\Filesystem')
					->getDirectoryRead(DirectoryList::MEDIA);
				$result = $uploader->save($mediaDirectory->getAbsolutePath('news_newspost'));
					if($result['error']==0)
					{
						$data['vedioimg'] = 'news_newspost' . $result['file'];
					}
			} catch (\Exception $e) {
				//unset($data['image']);
            }
			//var_dump($data);die;
			if(isset($data['vedioimg']['delete']) && $data['vedioimg']['delete'] == '1')
				$data['vedioimg'] = '';
           }else {
                if (isset($data['vedioimg']) && isset($data['vedioimg']['value'])) {
                    if (isset($data['vedioimg']['delete'])) {
                        $data['vedioimg'] = '';
                    } elseif (isset($data['vedioimg']['value'])) {
                        $data['vedioimg'] = $data['vedioimg']['value'];
                    } else {
                        $data['vedioimg'] = '';
                    }
                }
            }

          if (isset($_FILES['featuredimg']) && !empty($_FILES['featuredimg']['name']) ) {
			
		
			try{
				$uploader = $this->_objectManager->create(
					'Magento\MediaStorage\Model\File\Uploader',
					['fileId' => 'featuredimg']
				);
				$uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
				/** @var \Magento\Framework\Image\Adapter\AdapterInterface $imageAdapter */
				$imageAdapter = $this->_objectManager->get('Magento\Framework\Image\AdapterFactory')->create();
				$uploader->setAllowRenameFiles(true);
				$uploader->setFilesDispersion(true);
				/** @var \Magento\Framework\Filesystem\Directory\Read $mediaDirectory */
				$mediaDirectory = $this->_objectManager->get('Magento\Framework\Filesystem')
					->getDirectoryRead(DirectoryList::MEDIA);
				$result = $uploader->save($mediaDirectory->getAbsolutePath('news_newspost'));
					if($result['error']==0)
					{
						$data['featuredimg'] = 'news_newspost' . $result['file'];
					}
			} catch (\Exception $e) {
				//unset($data['image']);
            }
			//var_dump($data);die;
			if(isset($data['featuredimg']['delete']) && $data['featuredimg']['delete'] == '1')
				$data['featuredimg'] = '';
           }else {
                if (isset($data['featuredimg']) && isset($data['featuredimg']['value'])) {
                    if (isset($data['featuredimg']['delete'])) {
                        $data['featuredimg'] = '';
                    } elseif (isset($data['featuredimg']['value'])) {
                        $data['featuredimg'] = $data['featuredimg']['value'];
                    } else {
                        $data['featuredimg'] = '';
                    }
                }
            }			
			 
			 if (isset($_FILES['detailpagebanner']) && !empty($_FILES['detailpagebanner']['name']) ) {
			
		
			try{
				$uploader = $this->_objectManager->create(
					'Magento\MediaStorage\Model\File\Uploader',
					['fileId' => 'detailpagebanner']
				);
				$uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
				/** @var \Magento\Framework\Image\Adapter\AdapterInterface $imageAdapter */
				$imageAdapter = $this->_objectManager->get('Magento\Framework\Image\AdapterFactory')->create();
				$uploader->setAllowRenameFiles(true);
				$uploader->setFilesDispersion(true);
				/** @var \Magento\Framework\Filesystem\Directory\Read $mediaDirectory */
				$mediaDirectory = $this->_objectManager->get('Magento\Framework\Filesystem')
					->getDirectoryRead(DirectoryList::MEDIA);
				$result = $uploader->save($mediaDirectory->getAbsolutePath('news_newspost'));
					if($result['error']==0)
					{
						$data['detailpagebanner'] = 'news_newspost' . $result['file'];
					}
			} catch (\Exception $e) {
				//unset($data['image']);
            }
			//var_dump($data);die;
			if(isset($data['detailpagebanner']['delete']) && $data['detailpagebanner']['delete'] == '1')
				$data['detailpagebanner'] = '';
           }else {
                if (isset($data['detailpagebanner']) && isset($data['detailpagebanner']['value'])) {
                    if (isset($data['detailpagebanner']['delete'])) {
                        $data['detailpagebanner'] = '';
                    } elseif (isset($data['detailpagebanner']['value'])) {
                        $data['detailpagebanner'] = $data['detailpagebanner']['value'];
                    } else {
                        $data['detailpagebanner'] = '';
                    }
                }
            }	 
			 
			 
            $model->setData($data);

            try {
                $model->save();
                $this->messageManager->addSuccess(__('The Newspost has been saved.'));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the Newspost.'));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}