<?php

namespace Ecommage\HelloWorld\Model;

use Magento\Framework\Model\AbstractModel;
use Ecommage\HelloWorld\Model\ResourceModel\Post as PostResource;

class Post extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(PostResource::class);
    }
}
