<?php

namespace Ecommage\HelloWorld\Controller\Adminhtml\Post;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Ecommage\HelloWorld\Model\ResourceModel\Post as PostResource;
use Ecommage\HelloWorld\Model\PostFactory;

class Delete extends Action implements HttpPostActionInterface
{
    private $resource;
    private $postFactory;

    /**
     * Delete constructor.
     * @param Context $context
     * @param PostResource $resource
     * @param PostFactory $postFactory
     */
    public function __construct(
        Context $context,
        PostResource $resource,
        PostFactory $postFactory
    ) {
        $this->postFactory = $postFactory;
        $this->resource = $resource;
        parent::__construct($context);
    }

    /**
     * @return ResultInterface
     */
    public function execute(): ResultInterface
    {
        $postId = (int) $this->getRequest()->getParam('post_id');
        $resultRedirect = $this->resultRedirectFactory->create();
        if (!$postId) {
            $this->messageManager->addErrorMessage(__('We can\'t find a post to delete'));
            return $resultRedirect->setPath('*/*/');
        }

        $model = $this->postFactory->create();

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
