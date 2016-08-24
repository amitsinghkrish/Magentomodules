<?php

namespace Training\Template\Block;

class Templateblock extends \Magento\Framework\View\Element\Template {
    public function beforeToHtml(\Magento\Catalog\Block\Product\View\Description
    $originalBlock) {
        $originalBlock->setTemplate('Training_Template::description.phtml');
    }
}
