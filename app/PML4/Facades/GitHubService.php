<?php namespace PML4\Facades;

use Illuminate\Support\Facades\Facade;

class GitHubService extends Facade {


    public static function getFacadeAccessor()
    {
        return 'github';
    }

}