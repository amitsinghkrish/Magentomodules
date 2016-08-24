<?php
namespace Training\Template\Controller\Tempcont;

class Index extends \Magento\Framework\App\Action\Action
{
    public function execute()
    {
        $block = $this->_view->getLayout()->createBlock('Training\Template\Block\Templateblock');
        $block->setTemplate('temptest.phtml');
        $this->getResponse()->appendBody($block->toHtml());
    }
}