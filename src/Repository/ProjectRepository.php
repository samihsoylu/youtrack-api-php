<?php declare(strict_types=1);

namespace YouTrackAPI\Repository;

use YouTrackAPI\Entity\Project;

class ProjectRepository extends AbstractRepository
{
    /**
     * @return Project[]
     */
    public function getAllProjects(): array
    {
        $parameters = $this->generateGetRequestParams([
            'id',
            'name',
            'shortName',
        ]);

        $projectsArray = $this->api->get("/admin/projects{$parameters}".'&$top=9999');

        $projects = [];
        foreach ($projectsArray as $project) {
            $projects[] = new Project(
                $project['id'],
                $project['name'],
                $project['shortName'],
            );
        }

        return $projects;
    }

    public function getByShortName(string $shortName): ?Project
    {
        foreach ($this->getAllProjects() as $project) {
            if (str_contains($project->getShortName(), $shortName)) {
                return $project;
            }
        }

        return null;
    }
}
