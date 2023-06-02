<?php
namespace Ecommage\Blogext3\Ui\Component\Listing\Column;

use Magento\Ui\Component\Listing\Columns\Column;

class Status extends Column
{
    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $fieldName = $this->getData('name');
            foreach ($dataSource['data']['items'] as &$item) {
                $status = $item[$fieldName];
                $item[$fieldName] = $this->getStatusLabel($status);
            }
        }

        return $dataSource;
    }

    /**
     * Get Label for Status
     *
     * @param int $status
     * @return string
     */
    private function getStatusLabel($status)
    {
        switch ($status) {
            case 1:
                return __('Public');
            case 2:
                return __('Draft');
            case 3:
                return __('Non-Public');
            default:
                return __('Unknown');
        }
    }
}





