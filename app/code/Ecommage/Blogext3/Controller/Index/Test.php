<?php

namespace Ecommage\Blogext3\Controller\Index;
use Ecommage\Blogext3\Model\ResourceModel\Blog\CollectionFactory;
class Test extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;
    protected $collectionFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context      $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        CollectionFactory $collectionFactory
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    public function execute()
    {
    }
}
