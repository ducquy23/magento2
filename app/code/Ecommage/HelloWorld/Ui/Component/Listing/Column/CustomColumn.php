<?php
namespace Ecommage\HelloWorld\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class CustomColumn extends Column
{
    protected $searchCriteriaBuilder;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $fieldName = $this->getData('name');
            foreach ($dataSource['data']['items'] as &$item) {
                $postId = $item['post_id'];
                $postName = $item['name'];
                $customValueWithId = $postId . ' - ' . $postName;
                $item[$fieldName] = $customValueWithId;
            }
        }

        return $dataSource;
    }
}
