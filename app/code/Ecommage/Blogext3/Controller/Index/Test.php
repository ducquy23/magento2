<?php

namespace Ecommage\Blogext3\Controller\Index;
use Ecommage\Blogext3\Model\ResourceModel\Blog\CollectionFactory;
use Magento\Framework\DataObject;

class Test extends \Magento\Framework\App\Action\Action
{
    public function __construct(
        \Magento\Framework\App\Action\Context      $context
    )
    {
        parent::__construct($context);
    }

    public function execute()
    {
      $textDisplay = new DataObject(array('text' => 'Bùi Linh Giang'));
      $this->_eventManager->dispatch('ecommage_blogext3_display_text',['ec_text' => $textDisplay]);
      echo $textDisplay->getText();
      die();
    }
}
