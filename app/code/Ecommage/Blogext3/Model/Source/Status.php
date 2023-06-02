<?php

namespace Ecommage\Blogext3\Model\Source;
use Magento\Framework\Option\ArrayInterface;

class Status implements ArrayInterface
{
    /**
     * {@inheritdoc}
     */
    public function toOptionArray()
    {
        $options = [
            ['value' => -1, 'label' => __('Publish')],
            ['value' => 2, 'label' => __('Draft')],
            ['value' => 3, 'label' => __('Non-Publish')],
            ['value' => 1, 'label' => __('Unknown')],
        ];
        return $options;
    }
}
