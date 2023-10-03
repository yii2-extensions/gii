<?php

declare(strict_types=1);

namespace yiiunit\gii;

use yii\gii\generators\model\Generator;
use Yii;

/**
 * SchemaTest checks that Gii model generator supports multiple schemas
 *
 * @group gii
 * @group pgsql
 */
class SchemaTest extends GiiTestCase
{
    protected string $driverName = 'pgsql';

    public function testPrefixesGenerator(): void
    {
        $generator = new Generator();
        $generator->template = 'default';
        $generator->tableName = 'schema1.*';
        $generator->generateRelationsFromCurrentSchema = false;

        $files = $generator->generate();

        if (version_compare(str_replace('-dev', '', Yii::getVersion()), '2.0.4', '<')) {
            $this->markTestSkipped('This feature is only available since Yii 2.0.4.');
        }

        $this->assertCount(5, $files);
        $this->assertEquals('Schema1Table1', basename($files[3]->path, '.php'));
        $this->assertEquals('Schema1Table2', basename($files[4]->path, '.php'));
    }

    /**
     * @dataProvider \yiiunit\gii\providers\Data::schemaRelations
     */
    public function testViaTableRelationsGenerator(
        $template,
        $tableName,
        $filesCount,
        $useClassConstant,
        $relationSets
    ): void {
        $this->relationsGeneratorTest(
            $template,
            $tableName,
            $filesCount,
            $useClassConstant,
            $relationSets,
            Generator::JUNCTION_RELATION_VIA_TABLE,
        );
    }

    /**
     * @dataProvider \yiiunit\gii\providers\Data::schemaRelations
     */
    public function testViaModelRelationsGenerator(
        $template,
        $tableName,
        $filesCount,
        $useClassConstant,
        $relationSets
    ): void {
        $this->relationsGeneratorTest(
            $template,
            $tableName,
            $filesCount,
            $useClassConstant,
            $relationSets,
            Generator::JUNCTION_RELATION_VIA_MODEL,
        );
    }

    protected function relationsGeneratorTest(
        $template,
        $tableName,
        $filesCount,
        $useClassConstant,
        $relationSets,
        $generateViaRelationMode
    ): void {
        $generator = new Generator();
        $generator->template = $template;
        $generator->tableName = $tableName;
        $generator->generateRelationsFromCurrentSchema = false;
        $generator->useClassConstant = $useClassConstant;
        $generator->generateJunctionRelationMode = $generateViaRelationMode;

        $files = $generator->generate();

        $this->assertCount($filesCount, $files);

        foreach ($relationSets as $index => $relations) {
            $modelCode = $files[$index]->content;
            $modelClass = basename($files[$index]->path, '.php');

            if (version_compare(str_replace('-dev', '', Yii::getVersion()), '2.0.4', '<')) {
                $this->markTestSkipped('This feature is only available since Yii 2.0.4.');
            }

            foreach ($relations as $relation) {
                if (is_array($relation)) {
                    $relation = $relation[$generateViaRelationMode];
                }

                $this->assertStringContainsString(
                    (string) $relation,
                    $modelCode,
                    "Model $modelClass should contain this relation: $relation.\n$modelCode"
                );
            }
        }
    }
}
