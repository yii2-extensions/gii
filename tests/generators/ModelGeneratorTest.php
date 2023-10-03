<?php

declare(strict_types=1);

namespace yiiunit\gii\generators;

use yii\gii\generators\model\Generator as ModelGenerator;
use yiiunit\gii\GiiTestCase;

/**
 * ModelGeneratorTest checks that Gii model generator produces valid results
 *
 * @group gii
 */
class ModelGeneratorTest extends GiiTestCase
{
    public function testDefaultuseClassConstant(): void
    {
        $generator = new ModelGenerator();
        $this->assertEquals(
            PHP_MAJOR_VERSION > 5  || (PHP_MAJOR_VERSION === 5 && PHP_MINOR_VERSION > 4),
            $generator->useClassConstant
        );

        $generator = new ModelGenerator([
            'useClassConstant' => false,
        ]);
        $this->assertFalse($generator->useClassConstant);

        $generator = new ModelGenerator([
            'useClassConstant' => true,
        ]);
        $this->assertTrue($generator->useClassConstant);
    }

    public function testAll(): void
    {
        $generator = new ModelGenerator();
        $generator->template = 'default';
        $generator->tableName = '*';

        $generator->queryNs = 'application\models';

        $valid = $generator->validate();
        $this->assertFalse($valid);
        $this->assertEquals(
            'Namespace must be associated with an existing directory.',
            $generator->getFirstError('queryNs'),
        );

        $generator->queryNs = 'app\models';

        $valid = $generator->validate();
        $this->assertTrue($valid, 'Validation failed: ' . print_r($generator->getErrors(), true));

        $files = $generator->generate();
        $this->assertCount(12, $files);
        $expectedNames = [
            'Attribute.php',
            'BlogRtl.php',
            'Category.php',
            'CategoryPhoto.php',
            'Customer.php',
            'IdentityProvider.php',
            'Organization.php',
            'Product.php',
            'ProductLanguage.php',
            'Profile.php',
            'Supplier.php',
            'UserRtl.php',
        ];
        $fileNames = array_map(static fn ($f) => basename($f->path), $files);
        sort($fileNames);
        $this->assertEquals($expectedNames, $fileNames);
    }

    /**
     * @dataProvider \yiiunit\gii\providers\Data::modelRelations
     */
    public function testRelations(string $tableName, string $fileName, bool $useClassConstant, array $relations): void
    {
        $generator = new ModelGenerator();
        $generator->template = 'default';
        $generator->generateRelationsFromCurrentSchema = false;
        $generator->useClassConstant = $useClassConstant;
        $generator->tableName = $tableName;

        $files = $generator->generate();
        $this->assertCount(1, $files);
        $this->assertEquals($fileName, basename($files[0]->path));

        $code = $files[0]->content;
        foreach ($relations as $relation) {
            $found = str_contains($code, (string) $relation['relation']);
            $this->assertSame(
                $relation['expected'], $found, "Relation \"{$relation['relation']}\" should"
                . ($relation['expected'] ? '' : ' not') . " be there:\n" . $code
            );

            $found = str_contains($code, (string) $relation['name']);
            $this->assertSame(
                $relation['expected'], $found, "Relation Name \"{$relation['name']}\" should"
                . ($relation['expected'] ? '' : ' not') . " be there:\n" . $code
            );
        }
    }

    /**
     * @dataProvider \yiiunit\gii\providers\Data::modelRules
     */
    public function testRules(string $tableName, string $fileName, bool $useClassConstant, array $rules): void
    {
        $generator = new ModelGenerator();
        $generator->template = 'default';
        $generator->tableName = $tableName;
        $generator->useClassConstant = $useClassConstant;

        $files = $generator->generate();
        $this->assertCount(1, $files);
        $this->assertEquals($fileName, basename($files[0]->path));

        $code = $files[0]->content;
        foreach ($rules as $rule) {
            $location = strpos($code, (string) $rule);
            $this->assertNotFalse($location, "Rule \"$rule\" should be there:\n" . $code);
        }
    }

    public function testGenerateStandardizedCapitalsForClassNames(): void
    {
        $modelGenerator = new ModelGeneratorMock();
        $modelGenerator->standardizeCapitals = true;

        $tableNames = [
            'lower_underline_name' => 'LowerUnderlineName',
            'Ucwords_Underline_Name' => 'UcwordsUnderlineName',
            'UPPER_UNDERLINE_NAME' => 'UpperUnderlineName',
            'lower-hyphen-name' => 'LowerHyphenName',
            'Ucwords-Hyphen-Name' => 'UcwordsHyphenName',
            'UPPER-HYPHEN-NAME' => 'UpperHyphenName',
            'CamelCaseName' => 'CamelCaseName',
            'lowerUcwordsName' => 'LowerUcwordsName',
            'lowername' => 'Lowername',
            'UPPERNAME' => 'Uppername',
        ];

        foreach ($tableNames as $tableName => $expectedClassName) {
            $generatedClassName = $modelGenerator->publicGenerateClassName($tableName);
            $this->assertEquals($expectedClassName, $generatedClassName);
        }
    }

    public function testGenerateNotStandardizedCapitalsForClassNames(): void
    {
        $modelGenerator = new ModelGeneratorMock();
        $modelGenerator->standardizeCapitals = false;

        $tableNames = [
            'lower_underline_name' => 'LowerUnderlineName',
            'Ucwords_Underline_Name' => 'UcwordsUnderlineName',
            'UPPER_UNDERLINE_NAME' => 'UPPERUNDERLINENAME',
            'ABBRMyTable' => 'ABBRMyTable',
            'lower-hyphen-name' => 'Lower-hyphen-name',
            'Ucwords-Hyphen-Name' => 'Ucwords-Hyphen-Name',
            'UPPER-HYPHEN-NAME' => 'UPPER-HYPHEN-NAME',
            'CamelCaseName' => 'CamelCaseName',
            'lowerUcwordsName' => 'LowerUcwordsName',
            'lowername' => 'Lowername',
            'UPPERNAME' => 'UPPERNAME',
            'PARTIALUpperName' => 'PARTIALUpperName',
        ];

        foreach ($tableNames as $tableName => $expectedClassName) {
            $generatedClassName = $modelGenerator->publicGenerateClassName($tableName);
            $this->assertEquals($expectedClassName, $generatedClassName);
        }
    }

    public function testGenerateSingularizedClassNames(): void
    {
        $modelGenerator = new ModelGeneratorMock();
        $modelGenerator->singularize = true;

        $tableNames = [
            'clients' => 'Client',
            'client_programs' => 'ClientProgram',
            'noneexistingwords' => 'Noneexistingword',
            'noneexistingword' => 'Noneexistingword',
            'children' => 'Child',
            'good_children' => 'GoodChild',
            'user' => 'User',
        ];

        foreach ($tableNames as $tableName => $expectedClassName) {
            $generatedClassName = $modelGenerator->publicGenerateClassName($tableName);
            $this->assertEquals($expectedClassName, $generatedClassName);
        }
    }

    public function testGenerateNotSingularizedClassNames(): void
    {
        $modelGenerator = new ModelGeneratorMock();

        $tableNames = [
            'clients' => 'Clients',
            'client_programs' => 'ClientPrograms',
            'noneexistingwords' => 'Noneexistingwords',
            'noneexistingword' => 'Noneexistingword',
            'children' => 'Children',
            'good_children' => 'GoodChildren',
            'user' => 'User',
        ];

        foreach ($tableNames as $tableName => $expectedClassName) {
            $generatedClassName = $modelGenerator->publicGenerateClassName($tableName);
            $this->assertEquals($expectedClassName, $generatedClassName);
        }
    }

    /**
     * @dataProvider \yiiunit\gii\providers\Data::modelTableProperties
     */
    public function testGenerateProperties(string $tableName, array|string $columns): void
    {
        $generator = new ModelGenerator();
        $generator->template = 'default';
        $generator->tableName = $tableName;

        $files = $generator->generate();

        $code = $files[0]->content;
        foreach ($columns as $column) {
            $location = strpos($code, (string) $column['propertyRow']);
            $this->assertNotFalse(
                $location, "Column \"{$column['columnName']}\" properties should be there:\n" . $column['propertyRow']
            );
        }
    }
}
