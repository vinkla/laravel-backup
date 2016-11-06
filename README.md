# Laravel Backup

![backup](https://cloud.githubusercontent.com/assets/499192/11957534/9ecc53ee-a8c2-11e5-8ee6-24bc8c0ac6d4.png)

> An easy-to-use [backup](https://github.com/kbond/php-backup) manager for Laravel.

```php
use Vinkla\Backup\Backup;

$backup = new Backup();

$backup->run();
```

[![Build Status](https://img.shields.io/travis/vinkla/laravel-backup/master.svg?style=flat)](https://travis-ci.org/vinkla/laravel-backup)
[![StyleCI](https://styleci.io/repos/48389801/shield?style=flat)](https://styleci.io/repos/48389801)
[![Coverage Status](https://img.shields.io/codecov/c/github/vinkla/laravel-backup.svg?style=flat)](https://codecov.io/github/vinkla/laravel-backup)
[![Latest Version](https://img.shields.io/github/release/vinkla/backup.svg?style=flat)](https://github.com/vinkla/backup/releases)
[![License](https://img.shields.io/packagist/l/vinkla/backup.svg?style=flat)](https://packagist.org/packages/vinkla/backup)

## Installation

Require this package, with [Composer](https://getcomposer.org/), in the root directory of your project.

```bash
$ composer require vinkla/backup
```

Add the service provider to `config/app.php` in the `providers` array.

```php
Vinkla\Backup\BackupServiceProvider::class
```

## Configuration

Laravel Backup requires connection configuration. To get started, you'll need to publish all vendor assets:

```bash
$ php artisan vendor:publish
```

This will create a `config/backup.php` file in your app that you can modify to set your configuration. Also, make sure you check for changes to the original config file in this package between releases.

> Out of the box the backups will be stored in `storage/backups`. To prevent the backups from being committed be sure to add the directory to the `.gitignore` file.

#### Backup Profiles

The profiles array allows you to setup multiple backup profiles. Example configuration has been included, but you may add as many profiles as you would like.

#### Backup Sources

What to backup (i.e. database/files). The source fetches files and copies them to a "scratch" directory. These files are typically persisted between backups (improves rsync performance) but can be cleared by the executor.

#### Backup Destinations

Where to send the backup i.e. filesystem, S3, Dropbox, etc. We have provided a default local destination that will save the backup file the Laravel's storage directory (storage/backups).

#### Backup Processors

The processors converts the backup to a single file (i.e. zip/tar.gz). The processors use a namer to name the file (read more below).

#### Backup Namers

Generates the backup filename to be used by the processors. Below we've provided default namers. Of course, you may setup custom namers.

## Usage

First you need to create a new `Vinkla\Backup\Backup` instance.

```php
use Vinkla\Backup\Backup;

class Foo
{
    protected $backup;

    public function __construct(Backup $backup)
    {
        $this->backup = $backup;
    }

    public function bar()
    {
        $this->backup->run();
    }
}
```

To start the backup, use the `run()` method.

```php
$backup->run();
```

If you want to clear the files on the profile you can pass the a boolean to the `run()` method.

```php
$backup->run(true);
```

You can also specify which profile you want to backup with the `profile()` method.

> If you don't specify any profile the backup manager will use your default profile.

```php
$backup->profile('alternative')->run();
```

If you're curious on how you can write your own destinations, namers, processors and sources, we suggest you checkout the source code:

- [LocalDestination](src/Destinations/LocalDestination.php)
- [SimpleNamer](src/Namers/SimpleNamer.php)
- [UploadsSource](src/Sources/UploadsSource.php)
- [ZipProcessor](src/Processors/ZipProcessor.php)

Once you've registered your new class in the config it will be ready to use in the profiles array.

The `getName()` method should return a lowercase string which you can later use in the profile array.

## Documentation

There are other classes in this package that are not documented here. This is because the package is a Laravel wrapper of [Kevin Bond's](https://github.com/kbond) [backup](https://github.com/kbond/php-backup) package.

## License

[MIT](LICENSE) © [Vincent Klaiber](https://vinkla.com)
