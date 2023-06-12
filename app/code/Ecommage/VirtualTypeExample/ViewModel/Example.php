<?php

declare(strict_types=1);

namespace Ecommage\VirtualTypeExample\ViewModel;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Ecommage\VirtualTypeExample\Api\WarehouseRepositoryInterface;

class Example implements ArgumentInterface
{
    /**
     * @var WarehouseRepositoryInterface
     */
    protected WarehouseRepositoryInterface $warehouseRepository;

    public function __construct(WarehouseRepositoryInterface  $warehouseRepository)
    {
        $this->warehouseRepository = $warehouseRepository;
    }

    public function getWarehouse(RequestInterface $request)
    {
        return $this->warehouseRepository->newWarehouse((string) $request->getParam('code'));
    }
}
