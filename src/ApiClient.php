<?php

namespace YouTrackAPI;

use YouTrackAPI\HttpClient\HttpClient;
use YouTrackAPI\Repository\IssueRepository;
use YouTrackAPI\Repository\IssueTimeTrackerRepository;
use YouTrackAPI\Repository\ProjectRepository;

class ApiClient
{
    private HttpClient $httpClient;

    public function __construct(string $youtrackUrl, string $bearerToken)
    {
        $this->httpClient = new HttpClient($youtrackUrl, $bearerToken);
    }

    public function project(): ProjectRepository
    {
        return new ProjectRepository($this->httpClient);
    }

    public function issue(): IssueRepository
    {
        return new IssueRepository($this->httpClient);
    }

    public function issueTimeTracker(): IssueTimeTrackerRepository
    {
        return new IssueTimeTrackerRepository($this->httpClient);
    }
}
