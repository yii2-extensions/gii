<p align="center">
    <a href="https://github.com/yii2-extensions/gii" target="_blank">
        <img src="https://www.yiiframework.com/image/yii_logo_light.svg" height="100px;">
    </a>
    <h1 align="center">Gii.</h1>
</p>

<p align="center">
    <a href="https://www.php.net/releases/8.1/en.php" target="_blank">
        <img src="https://img.shields.io/badge/PHP-%3E%3D8.1-787CB5" alt="php-version">
    </a>
    <a href="https://github.com/yiisoft/yii2/tree/2.2" target="_blank">
        <img src="https://img.shields.io/badge/Yii2%20version-2.2-blue" alt="yii2-version">
    </a>
    <a href="https://github.com/yii2-extensions/gii/actions/workflows/build.yml" target="_blank">
        <img src="https://github.com/yii2-extensions/gii/actions/workflows/build.yml/badge.svg" alt="PHPUnit">
    </a>
    <a href="https://codecov.io/gh/yii2-extensions/gii" target="_blank">
        <img src="https://codecov.io/gh/yii2-extensions/gii/branch/main/graph/badge.svg?token=MF0XUGVLYC" alt="Codecov">
    </a>
    <a href="https://github.com/yii2-extensions/gii/actions/workflows/static.yml" target="_blank">
        <img src="https://github.com/yii2-extensions/gii/actions/workflows/static.yml/badge.svg" alt="PHPStan">
    </a>
    <a href="https://github.com/yii2-extensions/gii/actions/workflows/static.yml" target="_blank">
        <img src="https://img.shields.io/badge/PHPStan%20level-2-blue" alt="PHPStan level">
    </a>    
    <a href="https://github.styleci.io/repos/698630757?branch=main" target="_blank">
        <img src="https://github.styleci.io/repos/698630757/shield?branch=main" alt="Code style">
    </a>        
</p>

## Installation

The preferred way to install this extension is through [composer](https://getcomposer.org/download/).

Either run

```
php composer.phar require --dev --prefer-dist yii2-extensions/gii
```

or add

```
"yii2-extensions/gii": "dev-main"
```

to the require-dev section of your `composer.json` file.

## Usage

Once the extension is installed, simply modify your application configuration as follows:

```php
return [
    'bootstrap' => ['gii'],
    'modules' => [
        'gii' => [
            'class' => 'yii\gii\Module',
        ],
        // ...
    ],
    // ...
];
```

You can then access Gii through the following URL:

```
http://localhost/path/to/index.php?r=gii
```

or if you have enabled pretty URLs, you may use the following URL:

```
http://localhost/path/to/index.php/gii
```

Using the same configuration for your console application, you will also be able to access Gii via
command line as follows,

```
# change path to your application's base path
cd path/to/AppBasePath

# show help information about Gii
yii help gii

# show help information about the model generator in Gii
yii help gii/model

# generate City model from city table
yii gii/model --tableName=city --modelClass=City
```

## Testing

[Check the documentation testing](/docs/testing.md) to learn about testing.

## Our social networks

[![Twitter](https://img.shields.io/badge/twitter-follow-1DA1F2?logo=twitter&logoColor=1DA1F2&labelColor=555555?style=flat)](https://twitter.com/Terabytesoftw)

## License

The MIT License. Please see [License File](LICENSE.md) for more information.
