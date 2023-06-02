<?php
namespace Ecommage\HelloWorld\Controller\Adminhtml\Post;

use Magento\Backend\App\Action\Context;
use Ecommage\HelloWorld\Model\ResourceModel\Post\CollectionFactory;
use Magento\Framework\Controller\ResultFactory;

class MassDelete extends \Magento\Backend\App\Action
{
    protected $collectionFactory;

    public function __construct(
        Context $context,
        CollectionFactory $collectionFactory
    ) {
        parent::__construct($context);
        $this->collectionFactory = $collectionFactory;
    }

    public function execute()
    {
        $selectedIds = $this->getRequest()->getParam('selected');
        if (!is_array($selectedIds)) {
            $this->messageManager->addError(__('Please select item(s).'));
        } else {
            try {
                $collection = $this->collectionFactory->create();
                $collection->addFieldToFilter('post_id', ['in' => $selectedIds]);
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
