<?php
namespace Training\Blog\Controller\Customer;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Context;
use \Magento\Customer\Model\Session;


class Index extends \Magento\Framework\App\Action\Action
{
    protected $pageFactory;
    protected $session;
    public function __construct(Context $context,Session $session, PageFactory $pageFactory)
    {
        $this->pageFactory = $pageFactory;
        $this->session = $session;
        return parent::__construct($context);
    }
    
    public function execute()
    {
        if(!$this->session->isLoggedIn()) {
            $this->_redirect("customer/account/login");
        }
        $page_object = $this->pageFactory->create();
        $page_object->getConfig()->getTitle()->set(__('Blog'));
        return $page_object;
    }
}
