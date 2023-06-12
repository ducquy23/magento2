<?php

declare(strict_types=1);

namespace Ecommage\VirtualTypeExample\Api;

use Magento\Framework\DataObject;

interface WarehouseRepositoryInterface
{
    public function newWarehouse(string $code): DataObject; // method này để tạo mới một kho trong magento 2
}
