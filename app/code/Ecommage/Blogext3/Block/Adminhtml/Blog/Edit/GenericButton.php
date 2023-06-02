<?php
namespace Ecommage\Blogext3\Block\Adminhtml\Blog\Edit;

use Magento\Framework\UrlInterface;

class GenericButton
{
    protected $url;
    public function __construct(
        UrlInterface $url
    ) {
        $this->url = $url;
    }

    public function getUrl(string $route = '', array $params = []): string
    {
        return $this->url->getUrl($route, $params);
    }
}
