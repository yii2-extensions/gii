<p align="center">
    <a href="https://github.com/yii2-extensions/template" target="_blank">
        <img src="https://www.yiiframework.com/image/yii_logo_light.svg" height="100px;">
    </a>
    <h1 align="center">Gii.</h1>
    <br>
</p>

[![build](https://github.com/yii2-extensions/template/actions/workflows/build.yml/badge.svg)](https://github.com/yii2-extensions/template/actions/workflows/build.yml)
[![codecov](https://codecov.io/gh/yii2-extensions/template/branch/main/graph/badge.svg?token=MF0XUGVLYC)](https://codecov.io/gh/yii2-extensions/template)
[![static analysis](https://github.com/yii2-extensions/template/actions/workflows/static.yml/badge.svg)](https://github.com/yii2-extensions/template/actions/workflows/static.yml)
[![StyleCI](https://github.styleci.io/repos/698621511/shield?branch=main)](https://github.styleci.io/repos/698621511?branch=main)

## Requirements

The minimun version of `PHP` required by this package is `PHP 8.1`.

## Installation

The preferred way to install this extension is through [composer](https://getcomposer.org/download/).

Either run

```
php composer.phar require --dev --prefer-dist yiisoft/yii2-gii
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

The BSD 3-Clause License. Please see [License File](LICENSE.md) for more information.
