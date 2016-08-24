<?php

namespace Training\Blog\Block;

class Mainblog extends \Magento\Framework\View\Element\Template {

    protected function _prepareLayout()
    {
         $this->setMessage('Hello Again World');
    }

}
