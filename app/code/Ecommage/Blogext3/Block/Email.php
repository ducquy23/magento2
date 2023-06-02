<?php
namespace Ecommage\Blogext3\Block;
use Magento\Framework\View\Element\Template;

class Email  extends Template {
    /**
     * @var Template\Context
     */
    protected $context;

    public function __construct(Template\Context $context, array $data = [])
    {
        parent::__construct($context, $data);
        $this->context = $context;
    }
}
