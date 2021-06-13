<?php declare(strict_types=1);

namespace YouTrackAPI\Repository;

use YouTrackAPI\Entity\Issue\WorkItem;

class IssueTimeTrackerRepository extends AbstractRepository
{
    /**
     * Get all time spent work items for an issue
     *
     * @param string $issueIdentifier
     * @return array
     */
    public function getAllExistingWorkItemsInIssue(string $issueIdentifier): array
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

        $workItemArray = $this->api->get("/issues/{$issueIdentifier}/timeTracking/workItems{$parameters}");

        $workItems = [];
        foreach ($workItemArray as $workItem) {
            $workItems[] = WorkItem::fromArray($workItem);
        }

        return $workItems;
    }

    /**
     * Adds time spent to an issue
     *
     * @param string $issueIdentifier
     * @param string $message
     * @param int $timeSpentInMinutes
     * @return string Issue work item id
     * @throws \JsonException
     */
    public function createWorkItem(string $issueIdentifier, string $message, int $timeSpentInMinutes, string $workItemTypeId): string
    {
        $body = [
            'text' => $message,
            'duration' => [
                'minutes' => $timeSpentInMinutes
            ],
            'type' => [
                'id' => $workItemTypeId,
            ],
        ];

        $response = $this->api->post("/issues/{$issueIdentifier}/timeTracking/workItems", $body);

        return $response['id'];
    }

    /**
     * @return WorkItem\Type[]
     */
    public function getAllWorkItemTypesForProject(string $projectId): array
    {
        $workItemTypeArray = $this->api->get("/admin/projects/{$projectId}/timeTrackingSettings/workItemTypes?fields=id,name,url");

        $workItemTypes = [];
        foreach ($workItemTypeArray as $workItemType) {
            $workItemTypes[] = WorkItem\Type::fromArray($workItemType);
        }

        return $workItemTypes;
    }

    public function getWorkItemTypeForProjectByName(string $projectId, string $workItemTypeName): ?WorkItem\Type
    {
        $workItemTypes = $this->getAllWorkItemTypesForProject($projectId);
        foreach ($workItemTypes as $workItemType) {
            if ($workItemType->getName() === $workItemTypeName) {
                return $workItemType;
            }
        }

        return null;
    }
}
