<?php
namespace Ecommage\Blogext3\Model;
class Blog extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'ecommage_blogext3_blog';

    protected $_cacheTag = 'ecommage_blogext3_blog';

    protected $_eventPrefix = 'ecommage_blogext3_blog';

    protected function _construct()
    {
        $this->_init('Ecommage\Blogext3\Model\ResourceModel\Blog');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }
}
