<?php

namespace Ecommage\Blogext3\Plugin;

class ProductPlugin {
    public function afterGetPrice(\Magento\Catalog\Model\Product $subject, $result)
    {
        return $result + 1000;
    }
    public function afterGetName(\Magento\Catalog\Model\Product $subject, $result)
    {
        $result = $result . ' (Ecommage)';
        return $result;
    }
    public function aroundGetPrice(\Magento\Catalog\Model\Product $subject,\Closure $proceed)
    {
        // Thực hiện logic trước khi phương thức gốc được gọi

        // Gọi phương thức gốc và lấy giá trị trả về
        $result = $proceed();

        $result = $result * 0.10;
        // Thực hiện logic sau khi phương thức gốc được gọi

        return $result;
    }




}
