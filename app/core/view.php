<?php

namespace Intelpos;

class View
{
    public $data = null;

    function generate($template, $data = null)
    {
        $scripts =[];
        $trace = debug_backtrace();
        $content_view = 'Templates/empty.php';
        $controller = str_replace('Intelpos\Controller\\',"",$trace[1]['class']);
        if (strpos($controller, 'Page') !== false) {
            $file = str_replace('Page',"",$controller);
            $templatePath =  'Pages/' .$file . '/' . lcfirst($file).'.php';
            $scriptPath =  'Pages/' .$file . '/' . lcfirst($file).'.js';
            if (file_exists('app/views/'.$templatePath)) {
                $content_view = $templatePath;
            }
            if (file_exists('app/views/'.$scriptPath)){
                $scripts = [$scriptPath];
            }
        }

        $this->data = $data;
        if (file_exists('app/views/Templates/'.$template.'.php')){
            include 'app/views/Templates/'.$template.'.php';
        }else{
            include 'app/views/Templates/default.php';
        }
    }
}
