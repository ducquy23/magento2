<?php

namespace Ecommage\Blogext3\Block\Blog;

use Magento\Framework\View\Element\Template;
use Ecommage\Blogext3\Model\ResourceModel\Blog\CollectionFactory;
use Ecommage\Blogext3\Model\BlogFactory;
use Magento\Customer\Model\Session as CustomerSession;

class Slider extends Template
{
    protected $_collectionFactory;
    protected $_blogFactory;

    protected $_custom_param;

    protected $_customerSession;

    protected $_template = 'Ecommage_Blogext3::slider.phtml';

    public function __construct(
        Template\Context  $context,
        CollectionFactory $collectionFactory,
        BlogFactory       $blogFactory,
        CustomerSession   $customerSession,
        array             $data = []
    )
    {
//        $this->setTemplate('Ecommage_Blogext3::slider.phtml');
        $this->_customerSession = $customerSession;
        $this->_collectionFactory = $collectionFactory;
//        $this->_customParam = 'cu'
        $this->_blogFactory = $blogFactory;
        parent::__construct($context, $data);
    }

    public function getBlogCollection()
    {
        if ($this->_customerSession->isLoggedIn()) {
            // lấy id của tác giả hiện tại
            $customerId = $this->_customerSession->getCustomerId();
            // lấy danh sách bài post đã được lọc theo author_id
            $blogs = $this->_blogFactory->create()->getCollection()->addFieldToFilter('author_id', $customerId);
            return $blogs;
        } else {
            $blogs = $this->_blogFactory->create()->getCollection()->addFieldToFilter('status', 1);
            return $blogs;
        }

    }
    public function checkLogin()
    {
        return $this->_customerSession->isLoggedIn() ? true : false;
    }

}
