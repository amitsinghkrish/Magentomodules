<?php

namespace Training\Blog\Controller\Adminhtml\Post;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Training\Blog\Model\Post\Image;
use Magento\Backend\App\Action;
use Magento\TestFramework\ErrorLog\Logger;

class Save extends \Magento\Backend\App\Action {

    protected $_fileUploaderFactory;
    protected $pageFactory;

    /**
     * @param Action\Context $context
     */
    public function __construct(Action\Context $context,PageFactory $pageFactory, UploaderFactory $fileUploaderFactor) {
        $this->_fileUploaderFactory = $fileUploaderFactory;
        $this->pageFactory = $pageFactory;
        parent::__construct($context);
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed() {
        return $this->_authorization->isAllowed('Training_Blog::save');
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute() {
        $data = $this->getRequest()->getPostValue();
        
        echo '<pre>';
        print_r($data);
        exit;
        
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            /** @var \Training\Blog\Model\Post $model */
            $model = $this->_objectManager->create('Training\Blog\Model\Blog');

            $id = $this->getRequest()->getParam('post_id');
            if ($id) {
                $model->load($id);
            }

            $model->setData($data);
            
            $this->_eventManager->dispatch(
                    'blog_post_prepare_save', ['post' => $model, 'request' => $this->getRequest()]
            );

            try {
                $id = array();
                if (isset($data[$input]['delete'])) {
                    $id['name'] = '';
                }
                else{
                    if ($_FILES['post_image']['tmp_name']) {
                        $uploader = $this->_fileUploaderFactory->create(['fileId' => 'post_image']);
                        $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
                        $uploader->setAllowRenameFiles(false);
                        $uploader->setFilesDispersion(false);
                        $filesystem = $this->_objectManager->get('Magento\Framework\Filesystem');
                        $path = $filesystem->getDirectoryRead(DirectoryList::MEDIA)->getAbsolutePath('images/');
                        $id = $uploader->save($path);
                    }
                }
               
                $model->setData('post_image',$id['name']);
                
                $model->save();
                $this->messageManager->addSuccess(__('You saved this Post.'));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['post_id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the post.'));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['post_id' => $this->getRequest()->getParam('post_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }

}
