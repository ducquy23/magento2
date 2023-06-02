<?php

namespace Ecommage\Blogext3\Controller\Blog;

use Ecommage\Blogext3\Model\Blog;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\App\Action\Context;
use Ecommage\Blogext3\Model\BlogFactory;
use Magento\Customer\Model\Session as CustomerSession;
use Ecommage\Blogext3\Model\ResourceModel\Blog as ResourceBlog;

class Save extends \Magento\Framework\App\Action\Action
{
    protected $_blogFactory;
    protected $_messageManager;

    protected $_customerSession;
    protected $_resource;

    protected $reviews;

    protected $resultJsonFactory;

    public function __construct(
        Context          $context,
        BlogFactory      $blogFactory,
        ManagerInterface $messageManager,
        CustomerSession  $customerSession,
        ResourceBlog     $resource
    )
    {
        $this->_blogFactory = $blogFactory;
        $this->_customerSession = $customerSession;
        $this->_messageManager = $messageManager;
        $this->_resource = $resource;
        parent::__construct($context);
    }

    public function execute()
    {
        $postData = $this->getRequest()->getPostValue();
        $currentIdCustomer = $this->_customerSession->getCustomerId();
        $postData['author_id'] = $currentIdCustomer;
        $blog = $this->_blogFactory->create();
        if (empty($postData['id'])) {
            $postData['id'] = null;
        }
        $blog->setData($postData);
        try {
            $this->_resource->save($blog);
            $this->_messageManager->addSuccessMessage(__('You saved post blog.'));
        } catch (LocalizedException $exception) {
            $this->_messageManager->addExceptionMessage($exception);
        } catch (\Throwable $e) {
            $this->_messageManager->addErrorMessage(__('Something went wrong while saving the post.'));
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($postData['id'] == null) {
            $resultRedirect->setPath('ecommage_blogext3/blog/index/');
        } else {
            $resultRedirect->setPath('ecommage_blogext3/blog/edit/' . $postData->getId());
        }
        return $resultRedirect;
    }
}
