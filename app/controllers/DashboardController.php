<?php

class DashboardController extends BaseController {
    public $user;

    public function __construct($user = null) {
        if ($user == null) {
            $this->user = Auth::user();
        } else {
            $this->user = $user;
        }
    }

    public function index()
    {
        $projects = $this->user->getAllProjects();
        return View::make('dashboards.index', compact('projects'));
    }

}