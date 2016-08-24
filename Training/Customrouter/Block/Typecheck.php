<?php
namespace Training\Customrouter\Block;
use Magento\Framework\View\Element\Template;

class Typecheck extends Template
{
    public $check_rakho;
    public function __construct(array $checkList){
        $this->check_rakho = $checkList;
    }
}