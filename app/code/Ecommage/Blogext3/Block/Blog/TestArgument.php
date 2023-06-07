<?php
namespace Ecommage\Blogext3\Block\Blog;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class TestArgument extends Template {
    public function __construct(
        Context $context,
        array $data = []
    )
    {
        parent::__construct($context, $data);
    }
    public function testData():string {
        return 'test data overriding layout file';
    }
    public function getArgument(){
        return $this->getData('view_model');
    }
    public function getArgument1() {
        return $this->hasTestArgument() ? ' ' . $this->getTestArgument() : 'Không có giá trị này';
    }
    public function getArgument2() {
        return $this->getCustomArgument();
    }
    public function getDataHelper() {
        return $this->getData('test_helper');
    }
}
