<?php
namespace Ecommage\Blogext3\Block;
class Display extends \Magento\Framework\View\Element\Template
{
    protected $_blogFactory;
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Ecommage\Blogext3\Model\BlogFactory $blogFactory
    )
    {
        $this->_blogFactory = $blogFactory;
        parent::__construct($context);
    }

    public function sayHello()
    {
        return __('Hello World');
    }

    public function getBlogCollection(){
        $blog = $this->_blogFactory->create();
        return $blog->getCollection();
    }
}
