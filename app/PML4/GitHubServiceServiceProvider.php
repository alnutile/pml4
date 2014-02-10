<?php namespace PML4;


use Illuminate\Support\ServiceProvider;

class GitHubServiceServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->app->bind('github', 'PML4\GitHubService');
    }

}