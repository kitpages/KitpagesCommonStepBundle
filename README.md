KitpagesCommonStepBundle
==============================

This bundle contains some common steps (copy a directory, send an email, run a unix command,...) used by the KitpagesChainBundle.

## Versions




## Actual state

This bundle is early alpha state.

## Installation

Add KitpagesCommonStepBundle in your composer.json

```js
{
    "require": {
        "kitpages/common-step-bundle": "*"
    }
}
```

Now tell composer to download the bundle by running the command:

``` bash
$ php composer.phar update kitpages/common-step-bundle
```

in AppKernel.php, you have to add the KitpagesChainBundle and the KitpagesCommonStepBundle

``` php
$bundles = array(
    ...
    new Kitpages\ChainBundle\KitpagesChainBundle(),
    new Kitpages\CommonStepBundle\KitpagesCommonStepBundle(),
    new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
);
```


## User's guide

