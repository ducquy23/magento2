<?php
namespace Ecommage\HelloWorld\Block;
class Index extends \Magento\Framework\View\Element\Template
{
    protected $_helperData;
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Ecommage\HelloWorld\Helper\Data $helperData
    )
    {
        $this->_helperData = $helperData;
        parent::__construct($context);
    }

    public function sayHello()
    {
        return __('Hello World');
    }
    public function getTextHelloWorld() {
        $check = $this->_helperData->getGeneralConfig('enable');
        $text = '';
        if($check) {
            $text = $this->_helperData->getGeneralConfig('display_text');
        }
        return $text;
    }
    public function getMediaUrl($path)
    {
        return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . $path;

    }
    public function getImageHelloWorld() {
        return $this->_helperData->getGeneralConfig('logo');
    }
}
