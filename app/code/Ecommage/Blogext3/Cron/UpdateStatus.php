<?php

namespace Ecommage\Blogext3\Cron;

use Ecommage\Blogext3\Model\ResourceModel\Blog\CollectionFactory;
use Ecommage\Blogext3\Model\BlogFactory;
use Psr\Log\LoggerInterface;

class UpdateStatus
{
    protected $logger;
    protected $collection;
    protected $blogFactory;

    public function __construct
    (
        LoggerInterface   $logger,
        CollectionFactory $collectionFactory,
        BlogFactory       $blogFactory
    )
    {
        $this->logger = $logger;
        $this->blogFactory = $blogFactory;
        $this->collection = $collectionFactory;
    }

    public function execute()
    {
        try {
            $collection = $this->collection->create();
            foreach ($collection as $item) {
                $item->setStatus(1)->save();
            }
            $this->logger->info('Blog status updated successfully.');
        } catch (\Exception $e) {
            $this->logger->error("Error updating blog status: " . $e->getMessage());
        }
    }

}
