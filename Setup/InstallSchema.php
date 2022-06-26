<?php

namespace PixieMedia\CMSOpenGraph\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * Class InstallSchema to add custom field CMS field
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $setup->startSetup();

        $setup->getConnection()->addColumn($setup->getTable('cms_page'), 'pixie_meta', [
            'type'     => Table::TYPE_TEXT,
            'nullable' => true,
            'comment'  => 'Custom Meta',
        ]);

        $setup->endSetup();
    }
}
