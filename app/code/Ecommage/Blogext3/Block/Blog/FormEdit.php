<?php
namespace Ecommage\Blogext3\Block\Blog;
use Ecommage\Blogext3\Model\Blog;
use Magento\Framework\View\Element\Template;
use Ecommage\Blogext3\Model\BlogFactory;
use Magento\Framework\View\Element\Template\Context;

class FormEdit extends Template {
    protected $_blocFactory;

    /**
     * @param Context $context
     * @param BlogFactory $blogFactory
     * @param array $data
     */
    public function __construct(
        Context $context,
        BlogFactory $blogFactory,
        array $data = []
    )
    {
        $this->_blocFactory = $blogFactory;
        parent::__construct($context, $data);
    }

    /**
     * @return Blog
     */
    public function  getBlogById() {
        $blogId = $this->getRequest()->getParam('id');
        $blog = $this->_blocFactory->create();
        $blog->load($blogId);
        return $blog;
    }
}
