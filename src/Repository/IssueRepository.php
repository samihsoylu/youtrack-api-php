<?php declare(strict_types=1);

namespace YouTrackAPI\Repository;

use YouTrackAPI\Entity\Issue;
use YouTrackAPI\Entity\Issue\CustomField;

class IssueRepository extends AbstractRepository
{
    public function getByIdentifier(string $issueIdentifier): Issue
    {
        $parameters = $this->generateGetRequestParams([
            'idReadable',
            'summary',
            'description',
            'customFields' => [
                'name',
                '$type',
                'value' => [
                    'name',
                    'login',
                ],
            ],
        ]);

        $issue = $this->api->get("/issues/{$issueIdentifier}{$parameters}");

        $customFields = [];
        foreach ($issue['customFields'] as $customField) {
            $value = null;
            if (isset($customField['value']['name'])) {
                $value = new Issue\CustomField\Value(
                    $customField['value']['name'],
                    $customField['value']['$type']
                );
            }

            $customFields[] = new CustomField(
                $customField['name'],
                $customField['$type'],
                $value
            );
        }

        return new Issue(
            $issue['idReadable'],
            $issue['summary'],
            $issue['description'] ?? '',
            $customFields
        );
    }

    public function create(
        string $projectId,
        string $priority,
        string $title,
        string $description,
        string $state,
        string $assignee,
        string $type,
        int $estimatedTimeFrameInMinutes,
    ): string {
        $body = [
            'project'     => ['id' => $projectId],
            'summary'     => $title,
            'description' => $description,
            'customFields' => [
                [
                    'name' => 'Priority',
                    '$type' => 'SingleEnumIssueCustomField',
                    'value' => [
                        'name' => $priority,
                        '$type' => 'EnumBundleElement',
                    ],
                ],
                [
                    'name' => 'Type',
                    '$type' => 'SingleEnumIssueCustomField',
                    'value' => [
                        'name' => $type,
                        '$type' => 'EnumBundleElement',
                    ],
                ],
                [
                    'name' => 'Assignee',
                    '$type' => 'SingleEnumIssueCustomField',
                    'value' => [
                        'login' => $assignee,
                        '$type' => 'User',
                    ],
                ],
                [
                    'name' => 'State',
                    '$type' => 'StateIssueCustomField',
                    'value' => [
                        'name' => $state,
                        '$type' => 'StateBundleElement',
                    ],
                ],
                [
                    'name' => 'Estimation',
                    '$type' => 'PeriodIssueCustomField',
                    'value' => [
                        '$type' => "PeriodValue",
                        'minutes' => $estimatedTimeFrameInMinutes,
                    ],
                ],
            ],
        ];

        $parameters = $this->generateGetRequestParams(['idReadable']);

        $issue = $this->api->post("/issues{$parameters}", $body);

        return $issue['idReadable'];
    }

    public function updateTitle(string $issueIdentifier, string $title): void
    {
        $body = [
            'summary' => $title,
        ];

        $this->api->post("/issues/{$issueIdentifier}", $body, false);
    }

    public function update(string $issueIdentifier, string $title, string $description): void
    {
        $body = [
            'summary'     => $title,
            'description' => $description,
        ];

        $this->api->post("/issues/{$issueIdentifier}", $body, false);
    }

    public function delete(string $issueIdentifier): void
    {
        $this->api->delete("/issues/{$issueIdentifier}");
    }
}
