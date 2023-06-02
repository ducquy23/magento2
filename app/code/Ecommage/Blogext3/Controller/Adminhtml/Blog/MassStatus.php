<?php
namespace Ecommage\Blogext3\Controller\Adminhtml\Blog;

use Magento\Backend\App\Action\Context;
use Ecommage\Blogext3\Model\ResourceModel\Blog\CollectionFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter; // lớp này cung cấp các phương thức để lọc và trích xuất thông tin về mục đã chọn trong tình năng

class MassStatus extends \Magento\Backend\App\Action
{
    protected $filter;
    protected $collectionFactory;

    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory
    ) {
        parent::__construct($context);
        $this->collectionFactory = $collectionFactory;
        $this->filter = $filter;
    }

    public function execute()
    {
        $status = $this->getRequest()->getParam('status');
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $blogsId = $collection->getAllIds();
        if (!is_array($blogsId)) {
            $this->messageManager->addError(__('Please select item(s).'));
        } else {
            try {
                $updatedCount = 0;
                foreach ($collection as $item) {
                    $item->setStatus($status)->save();
                    $updatedCount++;
                }
                $status_name = '';
                switch ($status) {
                    case -1:
                         $status_name =  'Publish';
                        break;
                    case 2:
                        $status_name =  'Draft';
                        break;
                    case 3:
                        $status_name =  'Non-Publish';
                        break;
                }
                $this->messageManager->addSuccess( $updatedCount . (' Item(s) were successfully status is ') . $status_name);
            } catch (\Exception $e) {
                $this->messageManager->addError(__('An error occurred while deleting item(s): %1', $e->getMessage()));
            }
        }

        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setPath('*/*/index');
        return $resultRedirect;
    }
}
