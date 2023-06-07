<?php
namespace Ecommage\Blogext3\ViewModel;

class MyNewViewModel implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    public function getTitle()
    {
        return 'Hello World';
    }
}
