<?php
namespace Ecommage\HelloWorld\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;
    protected $_postFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Ecommage\HelloWorld\Model\PostFactory $postFactory
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->_postFactory = $postFactory;
        return parent::__construct($context);
    }
    public function execute()
    {
        $post = $this->_postFactory->create();
//        var_dump($post->getId(6));
//        die();
        $collection = $post->getCollection();
        foreach($collection as $item){
            echo "<pre>";
            print_r($item->getData());
            echo "</pre>";
        }
        exit();
        $resultPage = $this->_pageFactory->create();
        // $resultPage->getConfig()->getTitle()->set('Hello World');
        return $resultPage;
    }
}
