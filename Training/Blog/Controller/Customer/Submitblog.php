<?php
namespace Training\Blog\Controller\Customer;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Context;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\MediaStorage\Model\File\UploaderFactory;

class Submitblog extends \Magento\Framework\App\Action\Action
{
    protected $pageFactory;
    protected $session;
    
    protected $_fileUploaderFactory;
    
    public function __construct(Context $context,Session $session, PageFactory $pageFactory,UploaderFactory $fileUploaderFactory)
    {
        $this->_fileUploaderFactory = $fileUploaderFactory;
        
        $this->pageFactory = $pageFactory;
        $this->session = $session;
        return parent::__construct($context);
    }
    
    public function execute()
    {
        if(!$this->session->isLoggedIn()) {
            $this->_redirect("customer/account/login");
        }
         try {
            $productsData = $this->getRequest()->getParams();
            
            if ($_FILES['post_image']['tmp_name']){
                $uploader = $this->_fileUploaderFactory->create(['fileId' => 'post_image']);
                $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
                $uploader->setAllowRenameFiles(false);
                $uploader->setFilesDispersion(false);
                $filesystem = $this->_objectManager->get('Magento\Framework\Filesystem');
                $path = $filesystem->getDirectoryRead(DirectoryList::MEDIA)->getAbsolutePath('images/');
                $id = $uploader->save($path);
            }
            
            $model = $this->_objectManager->create('Training\Blog\Model\Blog');
            $model->setData($productsData);
            $model->setData('user_id',$this->session->getCustomerId());
            $model->setData('user_type','customer');
            $model->setData('status','0');
            $model->setData('post_image',$id['name']);
            
            if ($model->save()) {
                $this->messageManager->addSuccess(__('Post is added, It will be posted shortly'));
            } else {
                $this->messageManager->addError(__('Somthing went Wrong. Pleae try again.'));
            }
            
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            $this->messageManager->addException(
                    $e, __('%1', $e->getMessage())
            );
        } catch (\Exception $e) {
            $this->messageManager->addException(
                    $e, __('%1', $e->getMessage())
            );
        }
            $this->_redirect("*/*/index");
    }
}
