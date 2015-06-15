# DoctrineExtensionsBundle

The additional Doctrine extensions with [Bootstrapped][1] Twig templates
using [Font Awesome][2] icons for Symfony Framework

## Install

Add repository link to your `composer.json` file:

``` json
    "repositories": [
        { "type": "vcs", "url": "git@github.com:LapaLabs/DoctrineExtensionsBundle.git" }
    ],
```

Install bundle with `Composer` dependency manager first by running the command:

`$ composer require "lapalabs/doctrine-extensions-bundle:dev-master"`

`Composer` will install the bundle to your project's `vendor` directory.

## Include

Including the bundle to your `Symfony` project is as easy as to do a few simple steps.

1) Enable the bundle in application kernel for `prod` environment:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // other bundles...
        new LapaLabs\DoctrineExtensionsBundle\LapaLabsDoctrineExtensionsBundle(),
    );
}
```

## Congratulations!

You're ready to rock with additional Doctrine extensions now!

More documentation for override bundle's parts:
* [Overriding Bundle Templates][3]
* [How to Use Bundle Inheritance to Override Parts of a Bundle][4]


[1]: http://getbootstrap.com/
[2]: http://fortawesome.github.io/Font-Awesome/
[3]: http://symfony.com/doc/current/book/templating.html#overriding-bundle-templates
[4]: http://symfony.com/doc/current/cookbook/bundles/inheritance.html
