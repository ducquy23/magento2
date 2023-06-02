<?php
namespace Ecommage\Blogext3\Controller\Blog;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Ecommage\Blogext3\Model\BlogFactory;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Message\ManagerInterface;
use Magento\Customer\Model\Session as CustomerSession;

class Delete extends Action {
    protected $_blogFactory;
    protected $_messageManage;

    protected $_customerSession;

    /**
     * @param Context $context
     * @param ManagerInterface $messageManager
     * @param BlogFactory $blogFactory
     */
    public function __construct(
        Context $context,
        ManagerInterface $messageManager,
        BlogFactory $blogFactory,
        CustomerSession $customerSession
    )
    {
        $this->_messageManage = $messageManager;
        $this->_blogFactory = $blogFactory;
        $this->_customerSession = $customerSession;
        parent::__construct($context);
    }

    /**
     * @return ResponseInterface|Redirect|ResultInterface
     * @throws \Exception
     */
    public function execute()
    {
        if(!$this->_customerSession->isLoggedIn()) {
            $this->messageManager->addErrorMessage('You have logged in post a blog');
            $this->_redirect('customer/account/login');
        }
        $blogId = $this->getRequest()->getParam('id');
        // Handler xóa bài viết
        $blog = $this->_blogFactory->create()->load($blogId);
        $blog->delete();
        // Hiển thị thông báo thành công
        $this->_messageManage->addSuccessMessage('Đã xóa thành công bài post.');
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('ecommage_blogext3/blog/index');
        return $resultRedirect;
    }
}
