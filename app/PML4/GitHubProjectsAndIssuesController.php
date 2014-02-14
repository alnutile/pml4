<?php namespace PML4;

use Project;
use Github\Client;

class GitHubProjectsAndIssuesController {
    protected $service;

    public function __construct(GitHubService $service = null)
    {
        if ( $service === null ) {
            $this->service = new GitHubService(new Client);
        }
    }

    public function getIssuesThatAreNotLocal($project_id, $repo_owner, $repo_name)
    {
        $local_data = $this->getProjectData($project_id);
        try {
            $results = $this->service->getIssues($repo_owner, $repo_name);
            foreach($results as $key => $value) {
                if ( in_array($value['id'], $local_data)) {
                    unset($results[$key]);
                }
            }
        }
        catch(\Exception $e) {
            return $e->getMessage();
        }
        return array_values($results);
    }

    protected function getProjectData($project_id)
    {
        $data_compare = Project::find($project_id)->issues->toArray();
        foreach($data_compare as $key => $value) {
            $local_data[] = $value['github_id'];
        }
        return (!empty($local_data)) ? $local_data : array();
    }
}