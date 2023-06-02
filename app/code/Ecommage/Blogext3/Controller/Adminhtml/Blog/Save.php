<?php
namespace Ecommage\Blogext3\Controller\Adminhtml\Blog;

use Ecommage\Blogext3\Model\BlogFactory;
use Ecommage\Blogext3\Model\ResourceModel\Blog as BlogResource;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;

class Save extends Action implements HttpPostActionInterface // định nghĩa một hành động được thực thi là một HTTP POST request được gửi
{
    /*
     * Khi một controller action của magento 2 triển khai interface 'HttpPostActionInterface',nó sẽ được gọi là http post request được
     * gửi đến địa chỉ url tương ứng với action đó.     * */
    private $_blogFactory;
    private $_resource;

    /**
     * @param Context $context
     * @param BlogResource $resource
     * @param BlogFactory $blogFactory
     */
    public function __construct(
        Context $context,
        BlogResource $resource,
        BlogFactory $blogFactory
    ) {
        $this->_resource = $resource;
        $this->_blogFactory = $blogFactory;
        parent::__construct($context);
    }

    /**
     * @return ResultInterface
     */
    public function execute(): ResultInterface
    {
        $data = $this->getRequest()->getPostValue();
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $model = $this->_blogFactory->create();
            if (empty($data['id'])) {
                $data['id'] = null;
            }
            $model->setData($data);

            try {
                $this->_resource->save($model);
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
