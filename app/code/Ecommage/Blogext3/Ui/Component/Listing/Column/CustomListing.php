<?php

namespace Ecommage\Blogext3\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Ecommage\Blogext3\Model\ResourceModel\Blog\CollectionFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class CustomListing extends Column
{
    protected $collectionFactory;

    public function __construct(
        ContextInterface   $context,
        UiComponentFactory $uiComponentFactory,
        CollectionFactory  $collectionFactory,
        array              $components = [],
        array              $data = []
    )
    {
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $fieldName = $this->getData('name');
            foreach ($dataSource['data']['items'] as &$item) {
                $customerId = $item['author_id'];
                $customerCollection = $this->collectionFactory->create();
//                $customerCollection->getSelect()->join(['ce' => $customerCollection->])
//                $customerCollection->getSelect()->join(['ce' => $customerCollection->getTable('customer_entity')],
//                    'ecommage_blogs.author_id = ce.entity',
//                ['customer_name' => 'ce.firstname']);
//                $customerCollection->addFieldToFilter('entity_id', $customerId);
//                $customer = $customerCollection->getFirstItem();
//                $authorName = $customer->getName();
//                $item[$fieldName] = $authorName;
            }
        }
        return $dataSource;
    }
}
