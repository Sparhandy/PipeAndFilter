[![Build Status](https://travis-ci.org/Sparhandy/PipeAndFilter.svg?branch=master)](https://travis-ci.org/Sparhandy/PipeAndFilter) [![Github Releases](https://img.shields.io/github/downloads/Sparhandy/PipeAndFilter/latest/total.svg)]() [![Release](https://img.shields.io/github/release/Sparhandy/PipeAndFilter.svg)]() [![Packagist](https://img.shields.io/packagist/l/Sparhandy/PipeAndFilter.svg)]()

# PipeAndFilter

This repository contains all necessary files to use the [Pipe & Filter Architecture](http://www.dossier-andreas.net/software_architecture/pipe_and_filter.html) in PHP.

## Installation with composer

For now you have to use the dev-master version.

```bash
composer require "sparhandy/pipeandfilter" "dev-master"
```

## Usage

### PipeFactory

```php
<?php 
// Implements \Sparhandy\PipeAndFilter\FilterInterface
$exampleFilterFoo = new Acme\Filter\Foo(); 
$exampleFilterBar = new Acme\Filter\Bar(); 
$exampleFilterBaz = new Acme\Filter\Baz(); 

$filters = [
  $exampleFilterFoo,  
  $exampleFilterBar,  
  $exampleFilterBaz,  
];

$factory = new \Sparhandy\PipeAndFilter\PipeFactory();
$pipe = $factory->build($filters);

// The variable, to be processed by the $filters
$context = [];

// The context, to be processed by the $filters
$someParameter = [
    'foo' => 'bar',
];

$pipe->run($context, $someParameter);

// $context is now modified by your filters.
?>
```

### Filter

```php
<?php 

class FooFilter implements Sparhandy\PipeAndFilter\FilterInterface
{
    /**
     * @param mixed   $context
     * @param mixed[] $someParameter
     *
     * @return void
     */
    public function execute(&$context, array $someParameter)
    {
        if (isset($context['foo']))
        {
            $context['bar'] = $someParameter['baz'];
        }
    }
}
?>
```

# How to contribute

If you want to contribute to the standard here is how it works.

* Create a fork of Sparhandy/PipeAndFilter.
* Create your branch from master and commit your changes.
* Push your branch to your fork.
* Create a pull request on GitHub.
* Discuss your pull request with us.
* Our devs will then merge or close the pull request.