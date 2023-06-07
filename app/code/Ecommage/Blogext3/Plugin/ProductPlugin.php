<?php

namespace Ecommage\Blogext3\Plugin;

class ProductPlugin {
    public function afterGetPrice(\Magento\Catalog\Model\Product $subject, $result)
    {
        return $result + 1000;
    }
}
