# YouTrack API PHP
This is an implementation for communicating with the JetBrains YouTrack RestAPI. This library covers basic resource calls available in the [YouTrack RestAPI docs](https://www.jetbrains.com/help/youtrack/devportal/api-resources.html). Using this library, you can create, update, delete issues in your YouTrack instance.

## Disclaimer
YouTrack is a very customizable issue tracking system. This library will likely not function if you have customized your fields in your YouTrack instance. In order to make use of this library, you may have to fork this project and make adjustments to the Repository classes accordingly.   

## Features
- [x] Create issues
- [x] Update issues
- [x] Delete issues
- [x] Add time spent to issues
- [x] List projects

## To-do
* The time tracking repository has a 'type' of a time spent hard-coded. There needs to be a method that can list all available 'types' for specifying time spent. 

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
