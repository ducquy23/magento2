<?php

namespace Ecommage\Blogext3\Ui\Component\Listing\Column;

use Magento\Customer\Model\ResourceModel\Customer\CollectionFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class AuthorName extends Column
{
    protected $customerCollectionFactory;

    public function __construct(
        ContextInterface   $context,
        UiComponentFactory $uiComponentFactory,
        CollectionFactory  $customerCollectionFactory,
        array              $components = [],
        array              $data = []
    )
    {
        $this->customerCollectionFactory = $customerCollectionFactory;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $fieldName = $this->getData('name');
            foreach ($dataSource['data']['items'] as &$item) {
                $customerId = $item['author_id'];
                $customerCollection = $this->customerCollectionFactory->create();
                $customerCollection->addFieldToFilter('entity_id', $customerId);
                $customer = $customerCollection->getFirstItem();
                $authorName = $customer->getName();
                $item[$fieldName] = $authorName;
            }
        }
        return $dataSource;
    }
}
