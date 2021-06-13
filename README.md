# YouTrack API PHP
This is an implementation for communicating with the JetBrains YouTrack RestAPI. This library covers basic resource calls available in the [YouTrack RestAPI docs](https://www.jetbrains.com/help/youtrack/devportal/api-resources.html). Using this library, you can create, update, delete issues in your YouTrack instance.

## Disclaimer
YouTrack is a very customizable issue tracking system. This library will likely not function if you have customized your fields in your YouTrack instance. In order to make use of this library, you may have to fork this project and make adjustments to the Repository classes accordingly.   

## Feature highlights 
- [x] Query YouTrack for information about a projects, and issues. 
- [x] Create, update and delete issues.
- [x] Add time entries to issues.

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

This library has been tested in a YouTrack instance that has the following fields: Priority, Type, Assignee, State, and Estimation. The field names in your YouTrack project must be identical for this library to work out of the box. 

<img src="https://nivano.nl/downloads/youtrack-fields-menu.png" alt="screenshot" height="312px" width="280px" />
