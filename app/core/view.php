<?php

namespace Intelpos;

class View
{
    public $data = null;

    function generate($content_view, $template_view, $data = null)
    {
        $this->data = $data;
        include 'app/views/'.$template_view;
    }
}
