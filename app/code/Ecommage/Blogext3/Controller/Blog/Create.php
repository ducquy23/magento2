<?php
namespace Ecommage\Blogext3\Controller\Blog;
use Magento\Customer\Model\Session as CustomerSession;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Create extends Action
{
    protected $_pageFactory;
    protected $_customerSession;

    /**
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param CustomerSession $customerSession
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        CustomerSession $customerSession
    )
    {
        $this->_customerSession = $customerSession;
        $this->_pageFactory = $pageFactory;
        parent::__construct($context);
    }
    public function execute()
    {
        if(!$this->_customerSession->isLoggedIn()) {
            $this->messageManager->addErrorMessage('You must be logged in to post a blog');
            $this->_redirect('customer/account/login');
        }
        $resultPage = $this->_pageFactory->create();
        $resultPage->getConfig()->getTitle()->set('FORM CREATE BLOGS');
        return $resultPage;
    }
}
