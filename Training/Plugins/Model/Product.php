<?php
namespace Training\Plugins\Model;

class Product {
    public function afterGetPrice(\Magento\Catalog\Model\Product $product, $result) {
        
        return $result.'hii';
    }
    public function afterGetName(\Magento\Catalog\Model\Product $product, $result) {
        return $result.'hii2';
    }
}
?>