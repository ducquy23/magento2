<?php

namespace Ecommage\HelloWorld\Helper;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class Test implements ArgumentInterface
{
    public function test() {
        return "Get Argument";
    }

}
