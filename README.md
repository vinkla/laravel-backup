Laravel Backup
==============

![backup](https://cloud.githubusercontent.com/assets/499192/11957534/9ecc53ee-a8c2-11e5-8ee6-24bc8c0ac6d4.png)

A backup manager for Laravel built on top of [Kevin Bond's](https://github.com/kbond) [backup](https://github.com/kbond/php-backup) package.

```bash
$ php artisan backup:run
Profile was successfully backed up!

$ php artisan backup:list
+------------------------------------------------+---------+---------------------+
| Key                                            | Size    | Created At          |
+------------------------------------------------+---------+---------------------+
| /var/www/storage/backups/20151222144908.tar.gz | 2500856 | 2015-12-22 13:49:08 |
| /var/www/storage/backups/20151222144954.tar.gz | 5003001 | 2015-12-22 13:49:54 |
+------------------------------------------------+---------+---------------------+
```

[![Build Status](https://img.shields.io/travis/vinkla/backup/master.svg?style=flat)](https://travis-ci.org/vinkla/backup)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/vinkla/backup.svg?style=flat)](https://scrutinizer-ci.com/g/vinkla/backup/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/vinkla/backup.svg?style=flat)](https://scrutinizer-ci.com/g/vinkla/backup)
[![Latest Version](https://img.shields.io/github/release/vinkla/backup.svg?style=flat)](https://github.com/vinkla/backup/releases)
[![License](https://img.shields.io/packagist/l/vinkla/backup.svg?style=flat)](https://packagist.org/packages/vinkla/backup)

## Installation
Require this package, with [Composer](https://getcomposer.org/), in the root directory of your project.

```bash
composer require vinkla/backup
```

Add the service provider to `config/app.php` in the `providers` array.

```php
Vinkla\Backup\BackupServiceProvider::class
```

## Configuration

Laravel Backup requires connection configuration. To get started, you'll need to publish all vendor assets:

```bash
php artisan vendor:publish
```

This will create a `config/backup.php` file in your app that you can modify to set your configuration. Also, make sure you check for changes to the original config file in this package between releases.

## Usage

In order to run a backup use the command below.

```bash
$ php artisan backup:run
Profile was successfully backed up!
```

If you want to list all your backups use the command below.

```bash
$ php artisan backup:list
+------------------------------------------------+---------+---------------------+
| Key                                            | Size    | Created At          |
+------------------------------------------------+---------+---------------------+
| /var/www/storage/backups/20151222144908.tar.gz | 2500856 | 2015-12-22 13:49:08 |
| /var/www/storage/backups/20151222144954.tar.gz | 5003001 | 2015-12-22 13:49:54 |
+------------------------------------------------+---------+---------------------+
```

## Documentation

There are other classes in this package that are not documented here. This is because the package is a Laravel wrapper of [Kevin Bond's](https://github.com/kbond) [backup](https://github.com/kbond/php-backup) package.

## License

Laravel Backup is licensed under [The MIT License (MIT)](LICENSE).
