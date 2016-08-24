<?php
    /**
     * Training Admin Blog Grid Controller
     *
     * @category    Training
     * @package     Training_Blog
     * @author      KTPL
     *
     */
    namespace Training\Blog\Controller\Adminhtml\Blog;
 
    class Grid extends \Training\Blog\Controller\Adminhtml\Blog
    {
        /**
         * @var \Magento\Framework\View\Result\LayoutFactory
         */
        protected $resultLayoutFactory;
 
        /**
         * @param \Magento\Backend\App\Action\Context $context
         * @param \Webkul\Hello\Controller\Adminhtml\Hello\Builder $HelloBuilder
         * @param \Magento\Framework\View\Result\LayoutFactory $resultLayoutFactory
         */
        public function __construct(
            \Magento\Backend\App\Action\Context $context,
            \Magento\Framework\View\Result\LayoutFactory $resultLayoutFactory
        ) {
            parent::__construct($context);
            $this->resultLayoutFactory = $resultLayoutFactory;
        }
 
        /**
         * @return \Magento\Framework\View\Result\Layout
         */
        public function execute()
        {
            $resultLayout = $this->resultLayoutFactory->create();
            $resultLayout->getLayout()->getBlock('blog.blog.edit.tab.grid');
            return $resultLayout;
        }
 
    }