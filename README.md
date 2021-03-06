# Staff Monthly Appraisal System

[![PHPUnit](https://github.com/InterNACHI/modular/workflows/PHPUnit/badge.svg)](https://github.com/InterNACHI/modular/actions?query=workflow%3APHPUnit) [![Test Coverage](https://api.codeclimate.com/v1/badges/dd927802d52f4f75ea6c/test_coverage)](https://codeclimate.com/github/InterNACHI/modular/test_coverage)

This `Staff Appraisal system` repo uses `InterNACHI/Modular`, a module system for Laravel applications. It uses
[Composer path repositories](https://getcomposer.org/doc/05-repositories.md#path) for autoloading, 
and [Laravel package discovery](https://laravel.com/docs/7.x/packages#package-discovery) for module
initialization, and then provides minimal tooling to fill in any gaps.

This project is as much a set of conventions as it is a package. The fundamental idea
is that you can create “modules” in a separate `app-modules/` directory, which allows you to
better organize large projects. These modules use the existing 
[Laravel package system](https://laravel.com/docs/7.x/packages), and follow existing Laravel
conventions.

## This also uses slack for error reporting, just bring in your own slack channel api and configure

- [Installation](#installation)
- [Usage](#usage)



## Installation

To get started after installing your laravel application, run:

```shell script
composer require internachi/modular
``` 

Laravel will auto-discover the package and everything will be automatically set up for you.

### Publish the config

While not required, it's highly recommended that you customize your default namespace
for modules. By default, this is set to `Modules\`, which works just fine but makes it
harder to extract your module to a separate package should you ever choose to.

We recommend configuring a organization namespace (we use `"InterNACHI"`, for example).
To do this, you'll need to publish the package config:

```shell script
php artisan vendor:publish --tag=modular-config
```

### Create a module

Next, let's create a module:

```shell script
php artisan make:module my-module 
```

Modular will scaffold up a new module for you:

```
app-modules/
  my-module/
    composer.json
    src/
    tests/
    routes/
    resources/
    database/
```

It will also add two new entries to your app's `composer.json` file. The first entry registers
`./app-modules/my-module/` as a [path repository](https://getcomposer.org/doc/05-repositories.md#path),
and the second requires `modules/my-module:*` (like any other Composer dependency).

Modular will then remind you to perform a Composer update, so let's do that now:

```shell script
composer update modules/my-module
```

### Optional: Config synchronization

You can run the sync command to make sure that your project is set up
for module support:

```shell script
php artisan modules:sync
```

This will add a `Modules` test suite to your `phpunit.xml` file (if one exists)
and update your [PhpStorm Laravel plugin](https://plugins.jetbrains.com/plugin/7532-laravel)
configuration (if it exists) to properly find your module's views.

It is safe to run this command at any time, as it will only add missing configurations.
You may even want to add it to your `post-autoload-dump` scripts in your application's
`composer.json` file.

## Usage

All modules follow existing Laravel conventions, and auto-discovery 
should work as expected in most cases:

- Commands are auto-registered with Artisan
- Migrations will be run by the Migrator
- Factories are auto-loaded for `factory()`
- Policies are auto-discovered for your Models

There is **currently one exception**:

- [Event discovery](https://laravel.com/docs/7.x/events#event-discovery) (which is optional 
  and disabled by default in Laravel) is currently not supported.

### Commands

We provide a few helper commands:

- `php artisan make:module`  — scaffold a new module
- `php artisan modules:cache` — cache the loaded modules for slightly faster auto-discovery
- `php artisan modules:clear` — clear the module cache
- `php artisan modules:sync`  — update project configs (like `phpunit.xml`) with module settings
- `php artisan modules:list`  — list all modules

We also add a `--module=` option to most Laravel `make:` commands so that you can
use all the existing tooling that you know. The commands themselves are exactly the
same, which means you can use your [custom stubs](https://laravel.com/docs/7.x/artisan#stub-customization)
and everything else Laravel provides:

- `php artisan make:controller MyModuleController --module=my-module`
- `php artisan make:command MyModuleCommand --module=my-module`
- `php artisan make:component MyModuleComponent --module=my-module`
- `php artisan make:channel MyModuleChannel --module=my-module`
- `php artisan make:event MyModuleEvent --module=my-module`
- `php artisan make:exception MyModuleException --module=my-module`
- `php artisan make:factory MyModuleFactory --module=my-module`
- `php artisan make:job MyModuleJob --module=my-module`
- `php artisan make:listener MyModuleListener --module=my-module`
- `php artisan make:mail MyModuleMail --module=my-module`
- `php artisan make:middleware MyModuleMiddleware --module=my-module`
- `php artisan make:model MyModule --module=my-module`
- `php artisan make:notification MyModuleNotification --module=my-module`
- `php artisan make:observer MyModuleObserver --module=my-module`
- `php artisan make:policy MyModulePolicy --module=my-module`
- `php artisan make:provider MyModuleProvider --module=my-module`
- `php artisan make:request MyModuleRequest --module=my-module`
- `php artisan make:resource MyModule --module=my-module`
- `php artisan make:rule MyModuleRule --module=my-module`
- `php artisan make:seeder MyModuleSeeder --module=my-module`
- `php artisan make:test MyModuleTest --module=my-module`

## Extras
- This repo uses spatie permissions for authorisation and access provision, look in the AccessGateController
- Also uses middleware to make sure only users given permissions can create evaluation or carry out appraisal eg Teamlead, HR, admin etc 