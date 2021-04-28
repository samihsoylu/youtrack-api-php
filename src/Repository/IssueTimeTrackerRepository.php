<?php declare(strict_types=1);

namespace YouTrackAPI\Repository;

class IssueTimeTrackerRepository extends AbstractRepository
{
    /**
     * Get all time spent work items for an issue
     *
     * @param string $issueIdentifier
     * @return array
     */
    public function getAllWorkItemsForIssue(string $issueIdentifier): array
    {
        $parameters = $this->generateGetRequestParams([
            'id',
            'name',
            'text',
            'date',
            'type' => [
                'id',
                'name',
            ],
            'author' => [
                'id',
                'name',
            ],
            'creator' => [
                'id',
                'name',
            ],
            'duration' => [
                'id',
                'minutes',
                'presentation',
            ]
        ]);

        return $this->api->get("/issues/{$issueIdentifier}/timeTracking/workItems{$parameters}");
    }

    /**
     * Adds time spent to an issue
     *
     * @param string $issueIdentifier
     * @param string $message
     * @param int $timeSpent
     * @return string Issue work item id
     */
    public function createWorkItem(string $issueIdentifier, string $message, int $timeSpentInMinutes): string
    {
        $body = [
            'text' => $message,
            'duration' => [
                'minutes' => $timeSpentInMinutes
            ],
            'type' => [
                // Development
                'id' => '63-0',
            ],
        ];

        $response = $this->api->post("/issues/{$issueIdentifier}/timeTracking/workItems", $body);

        return $response['id'];
    }
}
