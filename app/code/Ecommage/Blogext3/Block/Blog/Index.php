<?php
namespace Ecommage\Blogext3\Block\Blog;
use Magento\Framework\View\Element\Template;
use Ecommage\Blogext3\Model\ResourceModel\Blog\Grid\CollectionFactory;
use Ecommage\Blogext3\Model\BlogFactory;
use Magento\Customer\Model\Session as CustomerSession;
class Index extends Template {
    protected $_collectionFactory;
    protected $_blogFactory;

    protected $_customerSession;
    public function __construct(
        Template\Context $context,
        CollectionFactory $collectionFactory,
        BlogFactory $blogFactory,
        CustomerSession $customerSession,
        array $data = []
    )
    {
        $this->_customerSession = $customerSession;
        $this->_collectionFactory = $collectionFactory;
        $this->_blogFactory = $blogFactory;
        parent::__construct($context, $data);
    }
    public function getBlogCollection() {
        $collection = $this->_collectionFactory->create();
        $collection->setMainTable('ecommage_blogs');
        $collection->getSelect()->join(
            ['t2' => $collection->getTable('customer_entity')],
            'main_table.author_id = t2.entity_id',
            ['firstname', 'email','lastname']
        );
        if($this->_customerSession->isLoggedIn()) {
            // lấy id của tác giả hiện tại
            $customerId = $this->_customerSession->getCustomerId();
            // lấy danh sách bài post đã được lọc theo author_id
            $collection->addFieldToFilter('author_id',$customerId);
            return $collection;
        } else {
            $collection->addFieldToFilter('status',1);
            return $collection;
        }
    }
    public function checkLogined() {
        return $this->_customerSession->isLoggedIn() ? true : false;
    }

}
