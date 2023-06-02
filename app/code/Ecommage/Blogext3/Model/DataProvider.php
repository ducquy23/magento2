<?php

namespace Ecommage\Blogext3\Model;

use Ecommage\Blogext3\Model\Blog;
use Ecommage\Blogext3\Model\BlogFactory;
use Ecommage\Blogext3\Model\ResourceModel\Blog as BlogResource;
use Ecommage\Blogext3\Model\ResourceModel\Blog\CollectionFactory;
use Magento\Framework\App\RequestInterface;
use Magento\Ui\DataProvider\Modifier\PoolInterface;
use Magento\Ui\DataProvider\ModifierPoolDataProvider;

class DataProvider extends ModifierPoolDataProvider
{
    /*
     * Class ModifierPoolDataProvider được sử dụng để cung cấp dữ liệu lên phần UI
     * và áp dụng toàn bộ modifier (sửa đổi) trước khi nó được hiển thị
     */
    /**
     * @var array
     */
    private $loadedData;
    private $resource;
    private $blogFactory;
    private $request;

    /**
     * DataProvider constructor.
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param BlogResource $resource
     * @param BlogFactory $blogFactory
     * @param RequestInterface $request
     * @param array $meta
     * @param array $data
     * @param PoolInterface|null $pool
     */
    public function __construct(
        string            $name,
        string            $primaryFieldName,
        string            $requestFieldName,
        CollectionFactory $collectionFactory,
        BlogResource      $resource,
        BlogFactory       $blogFactory,
        RequestInterface  $request,
        array             $meta = [],
        array             $data = [],
        PoolInterface     $pool = null
    )
    {
        $this->request = $request;
        $this->blogFactory = $blogFactory;
        $this->resource = $resource;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data, $pool);
        $this->collection = $collectionFactory->create();
    }

    /**
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $post = $this->getCurrentPost();
        $this->loadedData[$post->getId()] = $post->getData();
        return $this->loadedData;
    }

    /**
     * @return Blog
     */
    private function getCurrentPost()
    {
        $postId = $this->getPostId();
        $post = $this->blogFactory->create();
        if (!$postId) {
            return $post;
        }
        $this->resource->load($post, $postId);
        return $post;
    }

    /**
     * @return int
     */
    private function getPostId()
    {
        return (int)$this->request->getParam($this->getRequestFieldName());
    }
}
