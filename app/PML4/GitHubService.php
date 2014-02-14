<?php namespace PML4;


use Github\Client;


class GitHubService extends \BaseController {

    protected $client;
    protected $auth;
    protected $username;
    protected $password;

    public function __construct(Client $client)
    {
        $this->client = new $client;
        $this->username = \Config::get('app.guser');
        $this->password = \Config::get('app.gpassword');
        $this->authorize();
    }

    public function index()
    {

        $issues = $this->client->api('issue')->all('alnutile', 'behat_editor', array('state' => 'open'));
        krumo($issues);

        return "Hello Github";
    }

    public function authorize()
    {
        $auth = $this->client->authenticate($this->username, $this->password, Client::AUTH_HTTP_PASSWORD);
    }

    public function getIssues($repo_owner = FALSE, $repo_name = 'all')
    {
        try {
            $results = $this->client->api('issue')->all($repo_owner, $repo_name, array('state' => 'open'));
        } catch(\Exception $e) {
            return $e->getMessage();
        }

        return $results;
    }

    public function getAllProjects($repoOwner)
    {
        try {

            $results = $this->client->api('user')->setPerpage('200')->repositories($repoOwner);
        }

        catch(\Exception $e) {
            return $e->getMessage();
        }

        return $results;

    }

    public function callback()
    {
        return "callback";
    }

}