<?php
namespace Ecommage\Blogext3\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Sales\Model\Order\Email\Sender\OrderSender;
use Magento\Sales\Model\Order;

class Save extends \Magento\Framework\App\Action\Action implements HttpPostActionInterface
{
    protected $_pageFactory;
    protected $_order;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        Order $order
    )
    {
        $this->_order = $order;
        $this->_pageFactory = $pageFactory;
        parent::__construct($context);
    }
    public function execute()
    {
        $email = $this->getRequest()->getParam('email');
        $order = $this->_order->load(2);
//        $order = $this->_objectManager->create('Magento\Sales\Model\Order')->load(2);// this is entity id
        echo "<pre>";
        var_dump($order->getData());
        echo "</pre>";
        die();
        $order->setCustomerEmail($email);
        if ($order) {
            try {
                $this->_objectManager->create('\Magento\Sales\Model\OrderNotifier')
                    ->notify($order);
                $this->messageManager->addSuccess(__('You sent the order email.'));
                return $this->_redirect('ecommage_blogext3/index/index');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
                return $this->_redirect('ecommage_blogext3/index/index');
            } catch (\Exception $e) {
                $this->messageManager->addError(__('We can\'t send the email order right now.'));
                $this->_objectManager->create('Magento\Sales\Model\OrderNotifier')->critical($e);
                return $this->_redirect('ecommage_blogext3/index/index');
            }
        }
        return $this->_redirect('ecommage_blogext3/index/index');
    }
}
