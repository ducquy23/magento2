<?php
namespace Ecommage\Blogext3\Controller\Blog;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Ecommage\Blogext3\Model\BlogFactory;
use Magento\Framework\View\Result\PageFactory;
use Magento\Customer\Model\Session as CustomerSession;

class Edit extends Action {
    protected $_blogFactory;
    protected $_customerSession;
    protected $_pageFactory;
    public function __construct(
        Context $context,
        BlogFactory $blogFactory,
        PageFactory $pageFactory,
        CustomerSession $customerSession
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->_blogFactory = $blogFactory;
        $this->_customerSession = $customerSession;
        parent::__construct($context);
    }

    public function execute()
    {
        if(!$this->_customerSession->isLoggedIn()) {
            $this->messageManager->addErrorMessage('You must be logged in to post a blog');
            $this->_redirect('customer/account/login');
        }
        $resultPage = $this->_pageFactory->create();
        $resultPage->getConfig()->getTitle()->set('FORM EDIT BLOGS');
        return $resultPage;
    }
}
