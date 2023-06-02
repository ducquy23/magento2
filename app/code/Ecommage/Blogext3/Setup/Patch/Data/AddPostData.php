<?php

namespace Ecommage\Blogext3\Setup\Patch\Data; // định nghĩa namespace
// import các class cần thiết cho patch data
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface; // class này được sử dụng để truy cập và thao tác với csdl trong quá trình cài đặt hoặc nâng cấp
use Magento\Framework\Setup\Patch\PatchRevertableInterface;

class AddPostData implements DataPatchInterface, PatchRevertableInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * Constructor
     *
     * @param ModuleDataSetupInterface $moduleDataSetup
     */
    public function __construct(ModuleDataSetupInterface $moduleDataSetup)
    {
        $this->moduleDataSetup = $moduleDataSetup;
        /**
         * Được sử dụng để truy cập và thao tác với cơ sở dữ liêu trong quá trình cài đặt hoặc cập nhập module
         */
    }

    /**
     * {@inheritdoc}
     */
    public function apply() // được inheritdoc từ DataPatchInterface
    {
        $this->moduleDataSetup->getConnection()->startSetup();

        $table = $this->moduleDataSetup->getTable('ecommage_blogs');
        $data = [
            [
                'title' => 'First Post',
                'content' => 'This is the content of the first post.',
                'status' => -1
            ],
            [
                'title' => 'Second Post',
                'content' => 'This is the content of the second post.',
                'status' => 2
            ],
            [
                'title' => 'Three Post',
                'content' => 'This is the content of the three post.',
                'status' => 3
            ]
        ];

        $this->moduleDataSetup->getConnection()->insertMultiple($table, $data);

        $this->moduleDataSetup->getConnection()->endSetup();
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies() // thêm những phụ thuộc cho patch data
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function revert()
    {
        $this->moduleDataSetup->getConnection()->startSetup();

        $table = $this->moduleDataSetup->getTable('ecommage_blogs');

        $this->moduleDataSetup->getConnection()->delete($table, ['title IN (?)' => ['First Post', 'Second Post', 'Three Post']]);

        $this->moduleDataSetup->getConnection()->endSetup();
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}
