<?php

namespace Ecommage\Blogext3\Controller\Blog;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Ecommage\Blogext3\Model\BlogFactory;
use Magento\Framework\View\Result\PageFactory;
use Magento\Customer\Model\Session as CustomerSession;
use Magento\Framework\Message\ManagerInterface;

class Index extends Action
{
    protected $_blogFactory;
    protected $_pageFactory;
    protected $_customerSession;

    public function __construct(
        Context         $context,
        BlogFactory     $blogFactory,
        PageFactory     $pageFactory,
        CustomerSession $customerSession
    )
    {
        $this->_blogFactory = $blogFactory;
        $this->_pageFactory = $pageFactory;
        $this->_customerSession = $customerSession;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->_pageFactory->create();
        $resultPage->getConfig()->getTitle()->set('MANAGE BLOGS');
        return $resultPage;
    }
}
