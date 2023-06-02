<?php
//namespace Ecommage\Blogext3\Setup;
//
//use Magento\Framework\Setup\InstallDataInterface;
//use Magento\Framework\Setup\ModuleContextInterface;
//use Magento\Framework\Setup\ModuleDataSetupInterface;
//use Ecommage\Blogext3\Model\BlogFactory;
//
//class InstallData implements InstallDataInterface
//{
//    private $postFactory;
//
//    public function __construct(BlogFactory $postFactory)
//    {
//        $this->postFactory = $postFactory;
//    }
//
//    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
//    {
//        $setup->startSetup();
//
//        $postData = [
//            [
//                'title' => 'Post 1',
//                'author_id' => 1,
//                'content' => 'Content for Post 1',
//            ],
//            [
//                'title' => 'Post 2',
//                'author_id' => 1,
//                'content' => 'Content for Post 2',
//            ],
//            [
//                'title' => 'Post 3',
//                'author_id' => 1,
//                'content' => 'Content for Post 3',
//            ],
//        ];
//        foreach ($postData as $data) {
//            $this->postFactory->create()->setData($data)->save();
//        }
//
//        $setup->endSetup();
//    }
//}
