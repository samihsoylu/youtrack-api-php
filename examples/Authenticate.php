<?php

$projectRootDirectory = dirname(__DIR__);

require($projectRootDirectory . '/vendor/autoload.php');

$api = new \YouTrackAPI\ApiClient(
    'https://youtrack.example.com',
    'token'
);
