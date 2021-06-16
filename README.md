# YouTrack API PHP

[![GitHub license](https://img.shields.io/github/license/samihsoylu/youtrack-api-php?style=for-the-badge)](https://github.com/samihsoylu/youtrack-api-php/blob/master/LICENSE)
![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/samihsoylu/youtrack-api-php?style=for-the-badge)
![GitHub release (latest by date)](https://img.shields.io/github/v/release/samihsoylu/youtrack-api-php?label=stable&style=for-the-badge)
![Packagist Downloads](https://img.shields.io/packagist/dt/samihsoylu/youtrack-api-php?style=for-the-badge)

This is an implementation for communicating with the JetBrains YouTrack RestAPI. This library covers basic resource calls available in the [YouTrack RestAPI docs](https://www.jetbrains.com/help/youtrack/devportal/api-resources.html). Using this library, you can create, update, delete issues in your YouTrack instance.

## Feature highlights 
- [x] Query YouTrack for information about projects, and issues. 
- [x] Create, update and delete issues.
- [x] Add time spent to issues.

## Requirements

The YouTrack Rest API library requires the following in order to work properly:

* PHP 8.0.0 or later.
* [curl](https://www.php.net/manual/en/book.curl.php) (php extension)
* [json](https://www.php.net/manual/en/book.json.php) (php extension)
* [openssl](https://www.php.net/manual/en/book.openssl.php) (php extension)

## Installation

```sh
composer require samihsoylu/youtrack-api-php
```

## How to use?

Please look inside the [examples/ directory](https://github.com/samihsoylu/youtrack-api-php/tree/master/examples) for more information on how to use the api client.

This library has been tested in a YouTrack instance that has the following fields: Priority, Type, Assignee, State, and Estimation. These field names must exist in your YouTrack project for this library to work out of the box. 

<img src="https://nivano.nl/downloads/youtrack-fields-menu.png" alt="screenshot" height="312px" width="280px" />

## Disclaimer
YouTrack is a very customizable issue tracking system. This library will likely not function if you have customized your fields in your YouTrack instance. In order to make use of this library, you may have to fork this project and make adjustments to the Repository classes accordingly.
