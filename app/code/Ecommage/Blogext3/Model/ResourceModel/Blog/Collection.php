<?php
namespace Ecommage\Blogext3\Model\ResourceModel\Blog;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id';
    protected $_eventPrefix = 'ecommage_blogext3_blog_collection';
    protected $_eventObject = 'blog_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Ecommage\Blogext3\Model\Blog', 'Ecommage\Blogext3\Model\ResourceModel\Blog');
    }
    protected function _initSelect()
    {
        parent::_initSelect();

        $this->getSelect()->joinLeft(
            ['ce' => $this->getTable('customer_entity')],
            'main_table.author_id = ce.entity_id',
            ['firstname' => 'ce.firstname',
                'email' => 'ce.email'
            ]
        );
    }

}

