<?php
namespace Ecommage\HelloWorld\Model;
use Ecommage\HelloWorld\Model\Post;
use Ecommage\HelloWorld\Model\PostFactory;
use Ecommage\HelloWorld\Model\ResourceModel\Post as PostResource;
use Ecommage\HelloWorld\Model\ResourceModel\Post\CollectionFactory;
use Magento\Framework\App\RequestInterface;
use Magento\Ui\DataProvider\Modifier\PoolInterface;
use Magento\Ui\DataProvider\ModifierPoolDataProvider;

class DataProvider extends ModifierPoolDataProvider
{
    /**
     * @var array
     */
    private $loadedData;
    private $resource;
    private $postFactory;
    private $request;

    /**
     * DataProvider constructor.
     * @param $name
     * @param $primaryFieldName
     * @param $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param PostResource $resource
     * @param PostFactory $postFactory
     * @param RequestInterface $request
     * @param array $meta
     * @param array $data
     * @param PoolInterface|null $pool
     */
    public function __construct(
        string $name,
        string $primaryFieldName,
        string $requestFieldName,
        CollectionFactory $collectionFactory,
        PostResource $resource,
        PostFactory $postFactory,
        RequestInterface $request,
        array $meta = [],
        array $data = [],
        PoolInterface $pool = null
    ) {
        $this->request = $request;
        $this->postFactory = $postFactory;
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
     * @return Post
     */
    private function getCurrentPost()
    {
        $postId = $this->getPostId();
        $post = $this->postFactory->create();
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
        return (int) $this->request->getParam($this->getRequestFieldName());
    }
}
