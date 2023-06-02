<?php

namespace Ecommage\Blogext3\Controller\Adminhtml\Blog;

use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Page;

class Index extends \Magento\Backend\App\Action // class này kế thừa cho phép class Index sử dụng các tính năng và chức năng chính của controller admin
{
    protected $resultPageFactory = false;

    public function __construct(
        \Magento\Backend\App\Action\Context        $context,
        // đối tượng Context sẽ có các thông tin liên quan đến dữ liệu action và request nó cung cấp
        // các dịch vụ cần thiếp để xử lí yêu cầu và giao tiếp với admin
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * @return ResponseInterface|ResultInterface|Page
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend((__('Manage Blogs')));
        return $resultPage;
    }
}
