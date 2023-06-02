<?php

namespace Ecommage\Blogext3\Controller\Adminhtml\Blog;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Ecommage\Blogext3\Model\ResourceModel\Blog as BlogResource;
use Ecommage\Blogext3\Model\BlogFactory;

class Delete extends Action implements HttpPostActionInterface
{
    private $resource;
    private $blogFactory;

    /**
     * Delete constructor.
     * @param Context $context
     * @param BlogResource $resource
     * @param BlogFactory $blogFactory
     */
    public function __construct(
        Context $context,
        BlogResource $resource,
        BlogFactory $blogFactory
    ) {
        $this->blogFactory = $blogFactory;
        $this->resource = $resource;
        parent::__construct($context);
    }

    /**
     * @return ResultInterface
     */
    public function execute(): ResultInterface
    {
        $postId = (int) $this->getRequest()->getParam('id');
        $resultRedirect = $this->resultRedirectFactory->create();
        if (!$postId) {
            $this->messageManager->addErrorMessage(__('We can\'t find a post to delete'));
            return $resultRedirect->setPath('*/*/');
        }

        $model = $this->blogFactory->create();

        try {
            $this->resource->load($model, $postId);
            $this->resource->delete($model);

            $this->messageManager->addSuccessMessage(__('The post has been deleted.'));
        } catch (\Throwable $exception) {
            $this->messageManager->addErrorMessage($exception->getMessage());
        }

        return $resultRedirect->setPath('*/*/');
    }
}
