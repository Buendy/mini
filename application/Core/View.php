<?php
namespace Mini\Core;



class View
{
    public function render($filename, $data = null)
    {
        if ($data) {
            foreach ($data as $key => $value) {
                $this->{$key} = $value;
            }
        }
        echo $this->view->render("/home/index");
    }

}