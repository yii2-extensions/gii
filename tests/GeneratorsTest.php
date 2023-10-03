<?php

declare(strict_types=1);

namespace yiiunit\gii;

use Yii;
use yii\gii\generators\controller\Generator as ControllerGenerator;
use yii\gii\generators\crud\Generator as CRUDGenerator;
use yii\gii\generators\extension\Generator as ExtensionGenerator;
use yii\gii\generators\form\Generator as FormGenerator;
use yii\gii\generators\model\Generator as ModelGenerator;
use yii\gii\generators\module\Generator as ModuleGenerator;

/**
 * GeneratorsTest checks that Gii generators aren't throwing any errors during generation
 *
 * @group gii
 */
class GeneratorsTest extends GiiTestCase
{
    public function testControllerGenerator(): void
    {
        $generator = new ControllerGenerator();
        $generator->template = 'default';
        $generator->controllerClass = 'app\runtime\TestController';

        $valid = $generator->validate();

        $this->assertTrue($valid, 'Validation failed: ' . print_r($generator->getErrors(), true));
        $this->assertNotEmpty($generator->generate());
    }

    public function testExtensionGenerator(): void
    {
        $generator = new ExtensionGenerator();
        $generator->template = 'default';
        $generator->vendorName = 'samdark';
        $generator->namespace = 'samdark\\';
        $generator->license = 'BSD';
        $generator->title = 'Sample extension';
        $generator->description = 'This is sample description.';
        $generator->authorName = 'Alexander Makarov';
        $generator->authorEmail = 'sam@rmcreative.ru';

        $valid = $generator->validate();

        $this->assertTrue($valid, 'Validation failed: ' . print_r($generator->getErrors(), true));
        $this->assertNotEmpty($generator->generate());
    }

    public function testModelGenerator(): void
    {
        $generator = new ModelGenerator();
        $generator->template = 'default';
        $generator->tableName = 'profile';
        $generator->modelClass = 'Profile';

        $valid = $generator->validate();

        $this->assertTrue($valid, 'Validation failed: ' . print_r($generator->getErrors(), true));

        $files = $generator->generate();
        $modelCode = $files[0]->content;

        $this->assertStringContainsString("'id' => 'ID'", $modelCode, "ID label should be there:\n" . $modelCode);
        $this->assertStringContainsString(
            "'description' => 'Description',",
            $modelCode,
            "Description label should be there:\n" . $modelCode,
        );
    }

    public function testModuleGenerator(): void
    {
        $generator = new ModuleGenerator();
        $generator->template = 'default';
        $generator->moduleID = 'test';
        $generator->moduleClass = 'app\modules\test\Module';

        $valid = $generator->validate();

        $this->assertTrue($valid, 'Validation failed: ' . print_r($generator->getErrors(), true));
        $this->assertNotEmpty($generator->generate());
    }

    public function testFormGenerator(): void
    {
        $generator = new FormGenerator();
        $generator->template = 'default';
        $generator->modelClass = Profile::class;
        $generator->viewName = 'profile';
        $generator->viewPath = '@app/runtime';

        $valid = $generator->validate();

        $this->assertTrue($valid, 'Validation failed: ' . print_r($generator->getErrors(), true));
        $this->assertNotEmpty($generator->generate());
    }

    public function testCRUDGenerator(): void
    {
        $generator = new CRUDGenerator();
        $generator->template = 'default';
        $generator->modelClass = Profile::class;
        $generator->controllerClass = 'app\TestController';

        $valid = $generator->validate();

        $this->assertTrue($valid, 'Validation failed: ' . print_r($generator->getErrors(), true));
        $this->assertNotEmpty($generator->generate());
    }

    public function testTemplateValidation(): void
    {
        $generator = new ModelGenerator();

        // Validate default template
        $generator->template = 'default';
        $this->assertTrue($generator->validate(['template']));

        // Validate custom template
        Yii::setAlias('@customTemplate', __DIR__ . '/data/templates');

        $generator->templates = ['custom' => '@customTemplate/custom'];
        $generator->template = 'custom';

        $this->assertTrue($generator->validate(['template']));
    }
}
