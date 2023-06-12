<?php


declare(strict_types=1);

namespace Ecommage\VirtualTypeExample\Api;

interface WarehouseManagementInterface
{
    public function getWarehouseInfo(string $code): array; // method này được dùng để lấy thông tin kho hàng và trả về một mảng
}
