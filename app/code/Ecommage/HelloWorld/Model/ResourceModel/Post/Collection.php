<?php
namespace Ecommage\HelloWorld\Model\ResourceModel\Post;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Ecommage\HelloWorld\Model\Post;
use Ecommage\HelloWorld\Model\ResourceModel\Post as PostResource;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Post::class, PostResource::class);
    }
}
