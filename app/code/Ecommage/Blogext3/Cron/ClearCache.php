<?php
namespace Ecommage\Blogext3\Cron;

use Magento\Framework\App\Cache\Manager;

class ClearCache
{
    protected $cacheManager;

    public function __construct(Manager $cacheManager)
    {
        $this->cacheManager = $cacheManager;
    }

    public function execute()
    {
        $this->cacheManager->flush($this->cacheManager->getAvailableTypes());
    }
}
