<?php

namespace Ecommage\Validation\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Message\ManagerInterface;
use Magento\Store\Model\StoreManagerInterface;
class CheckBadWordsObserver implements ObserverInterface
{
    protected $response;
    protected $messageManager;
    protected $_storeManager;
    public function __construct(
        ResponseInterface $response,
        ManagerInterface $messageManager,
        StoreManagerInterface $storeManager
    )
    {
        $this->response = $response;
        $this->_storeManager = $storeManager;
        $this->messageManager = $messageManager;
    }

    public function execute(Observer $observer)
    {
        $registry = \Magento\Framework\App\ObjectManager::getInstance()
            ->get(\Magento\Framework\Registry::class);
        $dataBlog = $observer->getData('ec_blogs');
        if($this->containsBadWords($dataBlog['content'])) {
            $registry->register('test',false);
            $this->messageManager->addErrorMessage('Bad words acquired, please update.');
            return false;
        }
        $registry->register('test',true);
        return true;
    }
    private function containsBadWords($content)
    {
        $badWords = ['123','test','test123'];
        $contentLowercase = strtolower($content);
        foreach ($badWords as $word) {
            if (strpos($contentLowercase, strtolower($word)) !== false) {
                return true;
            }
        }
        return false;
    }
    private function getRedirectUrl()
    {
        // Return the URL to redirect the user back to the blog creation/editing page
        return $this->_storeManager->getStore()->getUrl('ecommage_blogext3/blog/create');
    }
}
