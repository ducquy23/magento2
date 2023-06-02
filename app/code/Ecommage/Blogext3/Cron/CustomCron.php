<?php
namespace Ecommage\Blogext3\Cron;

use Psr\Log\LoggerInterface;

class CustomCron
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function execute()
    {
        $this->logger->info('Starting running cron example');
        sleep(2);
        $this->logger->info('cron example finished');
    }
}
