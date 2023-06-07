<?php

namespace Ecommage\Blogext3\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\DataObject;
class GetBaseUrl extends Action
{
    protected $_urlInterface;
    protected $_storeManager;

    protected $_object;
    public function __construct(
        Context $context,
        UrlInterface $urlInterface,
        StoreManagerInterface $storeManager,
        DataObject $object
    )
    {
        $this->_object = $object;
        $this->_storeManager = $storeManager;
        $this->_urlInterface = $urlInterface;
        parent::__construct($context);
    }

    public function execute()
    {
        echo "USE URLINTERFACE TO GET BASE URL" . "<br>";
        echo "=====================================" . "<br>";
        $this->getUrlInterFace();
        echo "<br>";
        echo "=====================================" . "<br>";
        echo "USE STOREMANAGER TO GET BASE URL" . "<br>";
        $this->getStoreManagerData();
        die();
    }
    public function getStoreManagerData() {
        echo $this->_storeManager->getStore()->getId() . '<br />';

        // by default: URL_TYPE_LINK is returned
        echo $this->_storeManager->getStore()->getBaseUrl() . '<br />';

        echo $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_WEB) . '<br />';
        echo $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_DIRECT_LINK) . '<br />';
        echo $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . '<br />';
        echo $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_STATIC) . '<br />';

        echo $this->_storeManager->getStore()->getUrl('product/33') . '<br />';

        echo $this->_storeManager->getStore()->getCurrentUrl(false) . '<br />';

        echo $this->_storeManager->getStore()->getBaseMediaDir() . '<br />';

        echo $this->_storeManager->getStore()->getBaseStaticDir() . '<br />';
    }
    public function getUrlInterFace() {
        echo $this->_urlInterface->getBaseUrl() . "<br>";
        echo $this->_urlInterface->getCurrentUrl() . "<br>";
        echo $this->_urlInterface->getUrl() . "<br>";
        echo $this->_urlInterface->getUrl('ecommage_blogex3/blog/create');
    }
}
