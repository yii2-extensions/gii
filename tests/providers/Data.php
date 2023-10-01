<?php

declare(strict_types=1);

namespace yiiunit\gii\providers;

use yii\gii\generators\model\Generator;

class Data
{
    /**
     * Data provider for [[testCheckAccess()]]
     */
    public static function checkAccess(): array
    {
        return [
            [
                [],
                '10.20.30.40',
                false,
            ],
            [
                ['10.20.30.40'],
                '10.20.30.40',
                true,
            ],
            [
                ['*'],
                '10.20.30.40',
                true,
            ],
            [
                ['10.20.30.*'],
                '10.20.30.40',
                true,
            ],
            [
                ['10.20.30.*'],
                '10.20.40.40',
                false,
            ],
            [
                ['172.16.0.0/12'],
                '172.15.1.2', // "below" CIDR range
                false,
            ],
            [
                ['172.16.0.0/12'],
                '172.16.0.0', // in CIDR range
                true,
            ],
            [
                ['172.16.0.0/12'],
                '172.22.33.44', // in CIDR range
                true,
            ],
            [
                ['172.16.0.0/12'],
                '172.31.255.255', // in CIDR range
                true,
            ],
            [
                ['172.16.0.0/12'],
                '172.32.1.2',  // "above" CIDR range
                false,
            ],
        ];
    }

    public static function controllerData(): array
    {
        return [
            ['\app\runtime\controllers\ProductController', ['ProductController.php', 'index.php']],
            ['app\runtime\controllers\ProductController', ['ProductController.php', 'index.php']],
        ];
    }

    public static function modelRelations(): array
    {
        return [
            ['category', 'Category.php', false, [
                [
                    'name' => 'function getCategoryPhotos()',
                    'relation' => "\$this->hasMany(CategoryPhoto::className(), ['category_id' => 'id']);",
                    'expected' => true,
                ],
                [
                    'name' => 'function getProduct()',
                    'relation' => "\$this->hasOne(Product::className(), ['category_id' => 'id', 'category_language_code' => 'language_code']);",
                    'expected' => true,
                ],
            ]],
            ['category_photo', 'CategoryPhoto.php', false, [
                [
                    'name' => 'function getCategory()',
                    'relation' => "\$this->hasOne(Category::className(), ['id' => 'category_id']);",
                    'expected' => true,
                ],
            ]],
            ['supplier', 'Supplier.php', false, [
                [
                    'name' => 'function getProducts()',
                    'relation' => "\$this->hasMany(Product::className(), ['supplier_id' => 'id']);",
                    'expected' => true,
                ],
                [
                    'name' => 'function getAttributes0()',
                    'relation' => "\$this->hasMany(Attribute::className(), ['supplier_id' => 'id']);",
                    'expected' => true,
                ],
                [
                    'name' => 'function getAttributes()',
                    'relation' => "\$this->hasOne(Attribute::className(), ['supplier_id' => 'id']);",
                    'expected' => false,
                ],
                [
                    'name' => 'function getProductLanguage()',
                    'relation' => "\$this->hasOne(ProductLanguage::className(), ['supplier_id' => 'id']);",
                    'expected' => true,
                ],
            ]],
            ['product', 'Product.php', false, [
                [
                    'name' => 'function getSupplier()',
                    'relation' => "\$this->hasOne(Supplier::className(), ['id' => 'supplier_id']);",
                    'expected' => true,
                ],
                [
                    'name' => 'function getCategory()',
                    'relation' => "\$this->hasOne(Category::className(), ['id' => 'category_id', 'language_code' => 'category_language_code']);",
                    'expected' => true,
                ],
                [
                    'name' => 'function getProductLanguage()',
                    'relation' => "\$this->hasOne(ProductLanguage::className(), ['supplier_id' => 'supplier_id', 'id' => 'id']);",
                    'expected' => true,
                ],
            ]],
            ['product_language', 'ProductLanguage.php', false, [
                [
                    'name' => 'function getSupplier()',
                    'relation' => "\$this->hasOne(Product::className(), ['supplier_id' => 'supplier_id', 'id' => 'id']);",
                    'expected' => true,
                ],
                [
                    'name' => 'function getSupplier0()',
                    'relation' => "\$this->hasOne(Supplier::className(), ['id' => 'supplier_id']);",
                    'expected' => true,
                ],
            ]],

            ['organization', 'Organization.php', false, [
                [
                    'name' => 'function getIdentityProviders()',
                    'relation' => "\$this->hasMany(IdentityProvider::className(), ['organization_id' => 'id']);",
                    'expected' => true,
                ],
            ]],
            ['identity_provider', 'IdentityProvider.php', false, [
                [
                    'name' => 'function getOrganization()',
                    'relation' => "\$this->hasOne(Organization::className(), ['id' => 'organization_id']);",
                    'expected' => true,
                ],
            ]],
            ['user_rtl', 'UserRtl.php', false, [
                [
                    'name' => 'function getBlogRtls()',
                    'relation' => "\$this->hasMany(BlogRtl::className(), ['id_user' => 'id']);",
                    'expected' => true,
                ],
            ]],
            ['blog_rtl', 'BlogRtl.php', false, [
                [
                    'name' => 'function getUser()',
                    'relation' => "\$this->hasOne(UserRtl::className(), ['id' => 'id_user']);",
                    'expected' => true,
                ],
            ]],

            // useClassConstant = true
            ['category', 'Category.php', true, [
                [
                    'name' => 'function getCategoryPhotos()',
                    'relation' => "\$this->hasMany(CategoryPhoto::class, ['category_id' => 'id']);",
                    'expected' => true,
                ],
                [
                    'name' => 'function getProduct()',
                    'relation' => "\$this->hasOne(Product::class, ['category_id' => 'id', 'category_language_code' => 'language_code']);",
                    'expected' => true,
                ],
            ]],
        ];
    }

    public static function modelRules(): array
    {
        return [
            ['category_photo', 'CategoryPhoto.php', false, [
                "[['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],",
                "[['category_id', 'display_number'], 'unique', 'targetAttribute' => ['category_id', 'display_number']],",
            ]],
            ['product', 'Product.php', false, [
                "[['supplier_id'], 'exist', 'skipOnError' => true, 'targetClass' => Supplier::className(), 'targetAttribute' => ['supplier_id' => 'id']],",
                "[['category_id', 'category_language_code'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id', 'category_language_code' => 'language_code']],",
                "[['category_id', 'category_language_code'], 'unique', 'targetAttribute' => ['category_id', 'category_language_code']],",
            ]],
            ['product_language', 'ProductLanguage.php', false, [
                "[['supplier_id', 'id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['supplier_id' => 'supplier_id', 'id' => 'id']],",
                "[['supplier_id'], 'exist', 'skipOnError' => true, 'targetClass' => Supplier::className(), 'targetAttribute' => ['supplier_id' => 'id']],",
                "[['supplier_id'], 'unique']",
                "[['id', 'supplier_id', 'language_code'], 'unique', 'targetAttribute' => ['id', 'supplier_id', 'language_code']]",
                "[['id', 'supplier_id'], 'unique', 'targetAttribute' => ['id', 'supplier_id']]",
            ]],

            // useClassConstant = true
            ['product_language', 'ProductLanguage.php', true, [
                "[['supplier_id', 'id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::class, 'targetAttribute' => ['supplier_id' => 'supplier_id', 'id' => 'id']],",
                "[['supplier_id'], 'exist', 'skipOnError' => true, 'targetClass' => Supplier::class, 'targetAttribute' => ['supplier_id' => 'id']],",
                "[['supplier_id'], 'unique']",
                "[['id', 'supplier_id', 'language_code'], 'unique', 'targetAttribute' => ['id', 'supplier_id', 'language_code']]",
                "[['id', 'supplier_id'], 'unique', 'targetAttribute' => ['id', 'supplier_id']]",
            ]],
        ];
    }

    public static function modelTableProperties(): array
    {
        return [
            [
                'tableName' => 'category_photo',
                'columns' => [
                    [
                        'columnName' => 'id',
                        'propertyRow' => '* @property int $id',
                    ],
                    [
                        'columnName' => 'category_id',
                        'propertyRow' => '* @property int $category_id',
                    ],
                    [
                        'columnName' => 'display_number',
                        'propertyRow' => '* @property int $display_number',
                    ],
                ],
            ],
            [
                'tableName' => 'product',
                'columns' => [
                    [
                        'columnName' => 'id',
                        'propertyRow' => '* @property int $id',
                    ],
                    [
                        'columnName' => 'category_id',
                        'propertyRow' => '* @property int $supplier_id',
                    ],
                    [
                        'columnName' => 'category_language_code',
                        'propertyRow' => '* @property string $category_language_code',
                    ],
                    [
                        'columnName' => 'category_id',
                        'propertyRow' => '* @property int $category_id',
                    ],
                    [
                        'columnName' => 'internal_name',
                        'propertyRow' => '* @property string|null $internal_name',
                    ],
                ],
            ],
        ];
    }

    public static function schemaRelations(): array
    {
        return [
            // useClassConstant = false
            ['default', 'schema1.*', 5, false, [
                0 => [ // relations from junction1 table
                    "\$this->hasOne(Schema1Table1::className(), ['id' => 'table1_id']);",
                    "\$this->hasOne(Schema1MultiPk::className(), ['id1' => 'multi_pk_id1', 'id2' => 'multi_pk_id2']);",
                ],
                2 => [ // relations from multi_pk table
                    [
                        Generator::JUNCTION_RELATION_VIA_TABLE =>
                            "\$this->hasMany(Schema1Table1::className(), ['id' => 'table1_id'])->viaTable('junction1', ['multi_pk_id1' => 'id1', 'multi_pk_id2' => 'id2']);",
                        Generator::JUNCTION_RELATION_VIA_MODEL =>
                            "\$this->hasMany(Schema1Table1::className(), ['id' => 'table1_id'])->via('schema1Junction1s');",
                    ],
                    [
                        Generator::JUNCTION_RELATION_VIA_TABLE =>
                            "\$this->hasMany(Schema1Table1::className(), ['id' => 'table1_id'])->viaTable('junction2', ['multi_pk_id1' => 'id1', 'multi_pk_id2' => 'id2']);",
                        Generator::JUNCTION_RELATION_VIA_MODEL =>
                            "\$this->hasMany(Schema1Table1::className(), ['id' => 'table1_id'])->via('schema1Junction2s');",
                    ],
                    "\$this->hasMany(Schema1Junction1::className(), ['multi_pk_id1' => 'id1', 'multi_pk_id2' => 'id2']);",
                    "\$this->hasMany(Schema1Junction2::className(), ['multi_pk_id1' => 'id1', 'multi_pk_id2' => 'id2']);",
                ],
                3 => [ // relations from table1 table
                    "\$this->hasMany(Schema2Table1::className(), ['fk1' => 'fk2', 'fk2' => 'fk1']);",
                    "\$this->hasMany(Schema2Table1::className(), ['fk3' => 'fk4', 'fk4' => 'fk3']);",
                    "\$this->hasOne(Schema2Table2::className(), ['fk1' => 'fk1', 'fk2' => 'fk2']);",
                    [
                        Generator::JUNCTION_RELATION_VIA_TABLE =>
                            "\$this->hasMany(Schema1MultiPk::className(), ['id1' => 'multi_pk_id1', 'id2' => 'multi_pk_id2'])->viaTable('junction1', ['table1_id' => 'id']);",
                        Generator::JUNCTION_RELATION_VIA_MODEL =>
                            "\$this->hasMany(Schema1MultiPk::className(), ['id1' => 'multi_pk_id1', 'id2' => 'multi_pk_id2'])->via('schema1Junction1s');",
                    ],
                    [
                        Generator::JUNCTION_RELATION_VIA_TABLE =>
                            "\$this->hasMany(Schema1MultiPk::className(), ['id1' => 'multi_pk_id1', 'id2' => 'multi_pk_id2'])->viaTable('junction2', ['table1_id' => 'id']);",
                        Generator::JUNCTION_RELATION_VIA_MODEL =>
                            "\$this->hasMany(Schema1MultiPk::className(), ['id1' => 'multi_pk_id1', 'id2' => 'multi_pk_id2'])->via('schema1Junction2s');",
                    ],
                    "\$this->hasMany(Schema1Junction1::className(), ['table1_id' => 'id']);",
                    "\$this->hasMany(Schema1Junction2::className(), ['table1_id' => 'id']);",
                ],
            ]],
            ['default', 'schema2.*', 2, false, [
                0 => [
                    "\$this->hasOne(Schema1Table1::className(), ['fk2' => 'fk1', 'fk1' => 'fk2']);",
                    "\$this->hasOne(Schema1Table1::className(), ['fk4' => 'fk3', 'fk3' => 'fk4']);",
                    "\$this->hasOne(Schema2Table2::className(), ['fk5' => 'fk5', 'fk6' => 'fk6']);",
                ],
            ]],

            // useClassConstant = true
            ['default', 'schema1.*', 5, true, [
                0 => [ // relations from junction1 table
                    "\$this->hasOne(Schema1Table1::class, ['id' => 'table1_id']);",
                    "\$this->hasOne(Schema1MultiPk::class, ['id1' => 'multi_pk_id1', 'id2' => 'multi_pk_id2']);",
                ],
                2 => [ // relations from multi_pk table
                    [
                        Generator::JUNCTION_RELATION_VIA_TABLE =>
                            "\$this->hasMany(Schema1Table1::class, ['id' => 'table1_id'])->viaTable('junction1', ['multi_pk_id1' => 'id1', 'multi_pk_id2' => 'id2']);",
                        Generator::JUNCTION_RELATION_VIA_MODEL =>
                            "\$this->hasMany(Schema1Table1::class, ['id' => 'table1_id'])->via('schema1Junction1s');",
                    ],
                    [
                        Generator::JUNCTION_RELATION_VIA_TABLE =>
                            "\$this->hasMany(Schema1Table1::class, ['id' => 'table1_id'])->viaTable('junction2', ['multi_pk_id1' => 'id1', 'multi_pk_id2' => 'id2']);",
                        Generator::JUNCTION_RELATION_VIA_MODEL =>
                            "\$this->hasMany(Schema1Table1::class, ['id' => 'table1_id'])->via('schema1Junction2s');",
                    ],
                    "\$this->hasMany(Schema1Junction1::class, ['multi_pk_id1' => 'id1', 'multi_pk_id2' => 'id2']);",
                    "\$this->hasMany(Schema1Junction2::class, ['multi_pk_id1' => 'id1', 'multi_pk_id2' => 'id2']);",
                ],
                3 => [ // relations from table1 table
                    "\$this->hasMany(Schema2Table1::class, ['fk1' => 'fk2', 'fk2' => 'fk1']);",
                    "\$this->hasMany(Schema2Table1::class, ['fk3' => 'fk4', 'fk4' => 'fk3']);",
                    "\$this->hasOne(Schema2Table2::class, ['fk1' => 'fk1', 'fk2' => 'fk2']);",
                    [
                        Generator::JUNCTION_RELATION_VIA_TABLE =>
                            "\$this->hasMany(Schema1MultiPk::class, ['id1' => 'multi_pk_id1', 'id2' => 'multi_pk_id2'])->viaTable('junction1', ['table1_id' => 'id']);",
                        Generator::JUNCTION_RELATION_VIA_MODEL =>
                            "\$this->hasMany(Schema1MultiPk::class, ['id1' => 'multi_pk_id1', 'id2' => 'multi_pk_id2'])->via('schema1Junction1s');",
                    ],
                    [
                        Generator::JUNCTION_RELATION_VIA_TABLE =>
                            "\$this->hasMany(Schema1MultiPk::class, ['id1' => 'multi_pk_id1', 'id2' => 'multi_pk_id2'])->viaTable('junction2', ['table1_id' => 'id']);",
                        Generator::JUNCTION_RELATION_VIA_MODEL =>
                            "\$this->hasMany(Schema1MultiPk::class, ['id1' => 'multi_pk_id1', 'id2' => 'multi_pk_id2'])->via('schema1Junction2s');",
                    ],
                    "\$this->hasMany(Schema1Junction1::class, ['table1_id' => 'id']);",
                    "\$this->hasMany(Schema1Junction2::class, ['table1_id' => 'id']);",
                ],
            ]],
            ['default', 'schema2.*', 2, true, [
                0 => [
                    "\$this->hasOne(Schema1Table1::class, ['fk2' => 'fk1', 'fk1' => 'fk2']);",
                    "\$this->hasOne(Schema1Table1::class, ['fk4' => 'fk3', 'fk3' => 'fk4']);",
                    "\$this->hasOne(Schema2Table2::class, ['fk5' => 'fk5', 'fk6' => 'fk6']);",
                ],
            ]],
        ];
    }
}
