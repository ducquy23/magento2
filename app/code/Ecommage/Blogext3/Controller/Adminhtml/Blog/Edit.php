<?php
namespace Ecommage\Blogext3\Controller\Adminhtml\Blog;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;

class Edit extends Action implements HttpGetActionInterface
{
    public function execute()
    {
        $pageResult = $this->createPageResult();
        $title = $pageResult->getConfig()->getTitle();
        $title->prepend(__('Blogs'));
        $title->prepend(__('New Blog'));
        return $pageResult;
    }

    private function createPageResult()
    {
        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}
