<?php

namespace Ecommage\Blogext3\Plugin;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\Controller\Result\RedirectFactory;
class SavePlugin
{
    protected $_message;
    protected $_resultRedirectFactory;
    public function __construct(
        ManagerInterface $message,
        RedirectFactory $redirectFactory
    )
    {
        $this->_resultRedirectFactory = $redirectFactory;
        $this->_message = $message;
    }

    public function aroundExecute(\Ecommage\Blogext3\Controller\Blog\Save $subject, callable $proceed)
    {
        $postData = $subject->getRequest()->getPostValue();
        if (empty($postData['id'])) {
            $postData['id'] = null;
        }
        if($this->containsBadWords($postData['content'])) {
            $this->_message->addErrorMessage('Bad word existing !');
            $resultRedirect = $this->_resultRedirectFactory->create();
            if($postData['id'] == null ) {
                return $resultRedirect->setPath('ecommage_blogext3/blog/create');
            } else {
                $resultRedirect->setPath('ecommage_blogext3/blog/edit/' . $postData['id']);
                return false;
            }
        }
        return $proceed();
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


}
