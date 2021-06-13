<?php

// Open Authenticate.php to see where $api comes from
require(__DIR__ . '/Authenticate.php');

// In this example, it is assumed that a project called "FlowerFactory" is identified with "FF" for new issues.
$project = $api->project()->getByShortName('FF');

/**
 * Example 1: List available Time Entry Types (Good to know for Example 2)
 */
$types = $api->issueTimeTracker()->getAllWorkItemTypesForProject($project->getId());
print_r($types);


/**
 * Example 2: Add a time entry of four hours to a YouTrack Issue
 */
// The type of time entry you will submit, depending on the settings use example 1 to check the types available
$entryType = $api->issueTimeTracker()->getWorkItemTypeForProjectByName($project->getId(), 'Development');

$issueId = 'FF-13';
$comment = "I've set up a staging environment";
$timeSpentInMinutes = 240; // 4 hours

// Add a time entry
$api->issueTimeTracker()->createWorkItem(
    $issueId,
    $comment,
    $timeSpentInMinutes,
    $entryType->getId() // (Development)
);


/**
 * Example 3: List existing time entries in issue
 */
$entries = $api->issueTimeTracker()->getAllExistingWorkItemsInIssue('FF-13');
print_r($entries);
