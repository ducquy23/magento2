<?php
namespace Ecommage\HelloWorld\Controller\Adminhtml\Post;

use Ecommage\HelloWorld\Model\PostFactory;
use Ecommage\HelloWorld\Model\ResourceModel\Post as PostResource;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;

class Save extends Action implements HttpPostActionInterface
{
    private $postFactory;
    private $resource;

    public function __construct(
        Context $context,
        PostResource $resource,
        PostFactory $postFactory
    ) {
        $this->resource = $resource;
        $this->postFactory = $postFactory;
        parent::__construct($context);
    }

    public function execute(): ResultInterface
    {
        $data = $this->getRequest()->getPostValue();

        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $model = $this->postFactory->create();
            if (empty($data['post_id'])) {
                $data['post_id'] = null;
            }
            $model->setData($data);

            try {
                $this->resource->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the post.'));
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $exception) {
                $this->messageManager->addExceptionMessage($exception);
            } catch (\Throwable $e) {
                $this->messageManager->addErrorMessage(__('Something went wrong while saving the post.'));
            }
        }

        return $resultRedirect->setPath('*/*/');
    }
}
