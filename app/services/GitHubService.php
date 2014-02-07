<?php

use Github\Client;


class GitHubService extends BaseController {

    protected $client;
    protected $auth;

    public function __construct(Client $client)
    {
        $this->client = new $client;
    }

    public function index()
    {

        //$repos = $client->api('user')->repositories('alnutile');
        //krumo($repos);

        $issues = $this->client->api('issue')->all('alnutile', 'behat_editor', array('state' => 'open'));
        krumo($issues);

        return "Hello Github";
    }

    public function authorize()
    {
        $data = array(
            'note' => "Test",
        );
        //$client = $this->client->api('authorizations')->create($data);
        $client = new Github\Client();
        //$auth = $client->authenticate('056fd34a8a9ed77edc5e', '079798e4c541ccc7b7a847a91de1e1975414042c', Github\Client::AUTH_URL_CLIENT_ID);
        $auth = $client->authenticate('alnutile', 'traj9tuf8', Github\Client::AUTH_HTTP_PASSWORD);
        krumo($auth);
        try {
            $results = $client->api('issue')->all('alnutile', 'fis2', array('state' => 'open'));
        } catch(\Exception $e) {
            krumo($e->getMessage());
        }

        if(!empty($results)) {
            krumo($results);
        }

        return "Auth";
    }

    public function callback()
    {
        return "callback";
    }

}

//056fd34a8a9ed77edc5e
//079798e4c541ccc7b7a847a91de1e1975414042c