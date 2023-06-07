<?php

namespace Ecommage\Validation\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Ecommage\Blogext3\Model\BlogFactory;

class CreateBlog implements ObserverInterface
{
    protected $blogFactory;

    public function __construct(BlogFactory $blogFactory)
    {
        $this->blogFactory = $blogFactory;
    }

    public function execute(Observer $observer)
    {
        $customer = $observer->getEvent()->getCustomer();
        $customerEmail = $customer->getEmail();
        $blogData = [
            'title' => 'Hello ' . $customerEmail,
            'author_id' => $customer->getId(),
            'content' => 'Hello ' . $customerEmail,
            'url_key' => 'Hello-' . $customerEmail,
            'status' => 1 // Publish status
        ];
        try {
            $blog = $this->blogFactory->create();
            $blog->setData($blogData);
            $blog->save();
        } catch (CouldNotSaveException $e) {

        }
    }
}
