<?php

// Open Authenticate.php to see where $api comes from
require(__DIR__ . '/Authenticate.php');

/**
 * Example 1: Display details about an issue
 */
$issue = $api->issue()->getByIdentifier('FF-5');
print_r($issue);


/**
 * Example 2: Create an issue
 */
// In this example, it is assumed that a project called "FlowerFactory" is identified with "FF" for new issues.
$project = $api->project()->getByShortName('FF');

$issueIdentifier = $api->issue()->create(
    $project->getId(),
    'Priority (High, Medium, Low)',
    'Title',
    'Description',
    'State (Waiting For Support, In Progress, On Hold, Fixed, etc..)',
    'Assignee',
    'Type (Security, Bug, Enchancement, etc..)',
    120 // 2 hours, time estimated in minutes
);

echo "Issue created, issue id is: {$issueIdentifier}";


/**
 * Example 3: Update an issue
 */
// Update issue title and description
$api->issue()->update('FF-11', 'New Title Goes Here', 'New Description Goes Here');

// OR Only Update issue title
$api->issue()->updateTitle('FF-11', 'New Title Goes Here');


/**
 * Example 4: Delete an issue
 */
$api->issue()->delete('FF-11'); // Parameter: Issue Identifier
