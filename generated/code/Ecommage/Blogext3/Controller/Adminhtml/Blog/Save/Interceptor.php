<?php
namespace Ecommage\Blogext3\Controller\Adminhtml\Blog\Save;

/**
 * Interceptor class for @see \Ecommage\Blogext3\Controller\Adminhtml\Blog\Save
 */
class Interceptor extends \Ecommage\Blogext3\Controller\Adminhtml\Blog\Save implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Ecommage\Blogext3\Model\ResourceModel\Blog $resource, \Ecommage\Blogext3\Model\BlogFactory $blogFactory)
    {
        $this->___init();
        parent::__construct($context, $resource, $blogFactory);
    }

    /**
     * {@inheritdoc}
     */
    public function execute() : \Magento\Framework\Controller\ResultInterface
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'execute');
        return $pluginInfo ? $this->___callPlugins('execute', func_get_args(), $pluginInfo) : parent::execute();
    }

    /**
     * {@inheritdoc}
     */
    public function dispatch(\Magento\Framework\App\RequestInterface $request)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'dispatch');
        return $pluginInfo ? $this->___callPlugins('dispatch', func_get_args(), $pluginInfo) : parent::dispatch($request);
    }
}
