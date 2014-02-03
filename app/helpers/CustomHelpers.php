<?php


class CustomHelpers {

    public static function breadCrumbs()
    {
        $url = Request::path();
        $url_array = explode('/', $url);
        $bc[] = 'Dashboard';
        foreach($url_array as $key => $value){
            if(self::crud($value) && $key != 'Dashboard') {
                if ( is_numeric($value) ) {
                    $parent = $key - 1;
                    $model = self::models($url_array[$parent]);
                    $model_name = $model;
                    $model = $model::find($value);
                    $name = $model->name;
                    $bc[] = $model_name . " " . $name;

                } else {
                    $bc[] = self::cleanName($value);
                }
            }
        }
        return self::themeBc($bc);
    }

    public static function models($key)
    {
        $models = array(
            'projects'      => 'Project',
            'users'         => 'User',
            'issues'        => 'Issue',
            'comments'      => 'Comment',
        );

        return $models[$key];
    }

    public static function cleanName($key)
    {
        $name = array(
            'projects'      => 'Project',
            'users'         => 'User',
            'issues'        => 'Issue',
            'comments'      => 'Comment',
            'dashboard'     => 'Dashboard',
        );

        return $name[$key];
    }

    public static function crud($item)
    {
        $crud = array('create', 'edit');
        return (!in_array($item, $crud)) ?  true :  false;
    }

    public static function themeBc($bc)
    {
        $output = '<ol class="breadcrumb">';
            foreach($bc as $key => $value) {
                //$output .= "<li><a href=\"#\">$value</a></li>";
                $output .= "<li>$value</li>";
            }
        $output .= '</ol>';
        return $output;
    }
}