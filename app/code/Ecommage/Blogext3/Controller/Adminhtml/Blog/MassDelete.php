<?php
namespace Ecommage\Blogext3\Controller\Adminhtml\Blog;

use Magento\Backend\App\Action\Context;
use Ecommage\Blogext3\Model\ResourceModel\Blog\CollectionFactory;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Ui\Component\MassAction\Filter;

class MassDelete extends \Magento\Backend\App\Action
{
    protected $collectionFactory;
    protected $filter;

    /**
     * @param Context $context
     * @param CollectionFactory $collectionFactory
     * @param Filter $filter
     */
    public function __construct(
        Context $context,
        CollectionFactory $collectionFactory,
        Filter $filter
    ) {
        parent::__construct($context);
        $this->collectionFactory = $collectionFactory;
        $this->filter = $filter;
    }

    /**
     * @return ResponseInterface|Redirect|(Redirect&ResultInterface)|ResultInterface
     * @throws LocalizedException
     */
    public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $blogsId = $collection->getAllIds();
        if (!is_array($blogsId)) {
            $this->messageManager->addError(__('Please select item(s).'));
        } else {
            try {
                $collection->addFieldToFilter('id', ['in' => $blogsId]);
                $collection->walk('delete');

                $this->messageManager->addSuccess(__('Item(s) were successfully deleted.'));
            } catch (\Exception $e) {
                $this->messageManager->addError(__('An error occurred while deleting item(s): %1', $e->getMessage()));
            }
        }

        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setPath('*/*/index');
        return $resultRedirect;
    }
}
