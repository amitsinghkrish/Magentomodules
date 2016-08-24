<?php

namespace Training\Events\Model\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;


class Changerequestparams implements ObserverInterface {

    public function execute(\Magento\Framework\Event\Observer $observer){
        $request = $observer->getEvent()->getData('request');
        $request->setModuleName('catalog');
        $request->setControllerName('product');
        $request->setActionName('view');
        $request->setParams(array('id' => 1));
    }

}