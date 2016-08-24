<?php
namespace Training\Design\Controller\Exercise1;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\Page as ResultPage;

class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var ResultPage
     */
    private $resultPage;

    /**
     * @param Context $context
     * @param ResultPage $resultPage
     */
    public function __construct(Context $context, ResultPage $resultPage)
    {
        $this->resultPage = $resultPage;
        parent::__construct($context);
    }
    
    public function execute()
    {
        $this->resultPage->initLayout();
        return $this->resultPage;
    }
}