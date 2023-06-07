<?php

namespace Ecommage\Blogext3\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class ChangeDisplayText implements ObserverInterface
{

    public function execute(Observer $observer)
    {
        $displayText = $observer->getData('ec_text');
        echo $displayText->getText() . '- EVENT <br> ';
        $displayText->setText('Execute event Successfully');
        return $this;
    }
}
