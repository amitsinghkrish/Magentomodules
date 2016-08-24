<?php
namespace Training\Customrouter\Controller\Test;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\LayoutFactory;
 
class Typetest extends \Magento\Framework\App\Action\Action
{
    protected $layoutFactory;
    
    public function __construct(Context $context,LayoutFactory $layoutFactory)
    {
        $this->layoutFactory = $layoutFactory;
        return parent::__construct($context);
    }
    
    public function execute()
    {
        
        echo get_class($this->_objectManager);
        
        $typeblockobject = $this->layoutFactory->create()->createBlock('Training\Customrouter\Block\Typecheck');
        echo '<pre>';
        print_r($typeblockobject->check_rakho);
        exit;
    }
}