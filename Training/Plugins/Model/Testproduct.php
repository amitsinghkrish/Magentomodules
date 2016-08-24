<?php

namespace Training\Plugins\Model;

class Testproduct extends \Magento\Catalog\Model\Product {
    public function getName() {
        return 'asd';
    }
    
    public function getPrice() {
        return 3;
    }
}