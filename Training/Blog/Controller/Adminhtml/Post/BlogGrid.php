<?php
    /**
     * Blog Admin Blog blogGrid Controller
     *
      * @category    Training
     * @package     Training_Blog
     * @author      KTPL
     *
     */
    namespace Training\Blog\Controller\Adminhtml\Blog;
 
    class BlogGrid extends \Magento\Backend\App\Action
    {
        
        public function execute()
        {
            echo 'asd';
            exit;
            $page_object = $this->pageFactory->create();
            return $page_object;
        }
    }