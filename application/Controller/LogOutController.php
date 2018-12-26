<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 2/12/18
 * Time: 21:42
 */

namespace Mini\Controller;
use Mini\Core\Controller;


class LogOutController extends Controller
{
    public function index()
    {

           session_destroy();
           echo $this->view->render("/partials/logout");


    }

}