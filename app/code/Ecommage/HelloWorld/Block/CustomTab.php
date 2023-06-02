<?php

namespace Ecommage\HelloWorld\Block;

use Magento\Framework\View\Element\Template;

class CustomTab extends Template
{
    // Custom logic for the tab
    protected $_test;
    public function __construct(
        Template\Context $context,
        array $data = [])
    {
        parent::__construct($context, $data);
    }
}
