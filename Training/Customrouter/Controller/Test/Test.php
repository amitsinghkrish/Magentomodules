<?php
namespace Training\Customrouter\Controller\Test;

use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Context;
 
class Test extends \Magento\Framework\App\Action\Action
{
    protected $pageFactory;
    public function __construct(Context $context, PageFactory $pageFactory)
    {
        $this->pageFactory = $pageFactory;
        return parent::__construct($context);
    }
    
    public function execute()
    {
        $page_object = $this->pageFactory->create();
        return $page_object;
    }
}