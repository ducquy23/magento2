<?php

namespace Ecommage\Blogext3\Controller\Index;
use Magento\Framework\App\Action\Context;
use Ecommage\Blogext3\Controller\Index\GetBaseUrlExtended;
class Test1 extends \Magento\Framework\App\Action\Action
{
    public function __construct
    (
        Context $context

    )
    {
        parent::__construct($context);
    }
    public function execute()
    {
        $objectManager =  \Magento\Framework\App\ObjectManager::getInstance();
        $value = $objectManager->create('Ecommage\Blogext3\Controller\Index\GetBaseUrl');
        $objectManager =  \Magento\Framework\App\ObjectManager::getInstance();
        $value1 = $objectManager->create('GetBaseurlExtended');
        var_dump(get_class($value));
        die();

        $test = $objectManager->create('Ecommage\Blogext3\Controller\Index\GetBaseUrl');
        print_r($test);
        echo "</br>";
    }

}
