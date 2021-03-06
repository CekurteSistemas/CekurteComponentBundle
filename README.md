# Cekurte\ComponentBundle

[![Build Status](https://img.shields.io/travis/jpcercal/CekurteComponentBundle/master.svg?style=flat-square)](http://travis-ci.org/jpcercal/CekurteComponentBundle)
[![Coverage Status](https://coveralls.io/repos/jpcercal/CekurteComponentBundle/badge.svg)](https://coveralls.io/r/jpcercal/CekurteComponentBundle)
[![Latest Stable Version](https://img.shields.io/packagist/v/cekurte/componentbundle.svg?style=flat-square)](https://packagist.org/packages/cekurte/componentbundle)
[![Total Downloads](https://img.shields.io/packagist/dt/cekurte/componentbundle.svg?style=flat-square)](https://packagist.org/packages/cekurte/componentbundle)
[![License](https://img.shields.io/packagist/l/cekurte/componentbundle.svg?style=flat-square)](https://packagist.org/packages/cekurte/componentbundle)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/33034475-e92d-4298-8357-b82f2e092ba0/mini.png)](https://insight.sensiolabs.com/projects/33034475-e92d-4298-8357-b82f2e092ba0)

- A set of components to build REST applications with Symfony2.
- See also the [CekurteGeneratorBundle](https://github.com/jpcercal/CekurteGeneratorBundle) to build CRUD's automatically 
with custom templates for REST Controllers, Entities, Services, Forms and Resources.
- Currently this package contains only support for one resource manager, the Doctrine ORM. But, this bundle adds easy way to 
  add any resource manager through the interface [ResourceManagerInterface](https://github.com/jpcercal/CekurteComponentBundle/blob/master/src/Service/ResourceManagerInterface.php), 
**contribute with this project**! 

## Installation

The package is available on [Packagist](http://packagist.org/packages/cekurte/componentbundle).
Autoloading is [PSR-4](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader.md) compatible.

```shell
composer require cekurte/componentbundle
```
