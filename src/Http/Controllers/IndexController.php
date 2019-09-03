<?php

namespace Axe\Http\Controllers;

class IndexController extends BaseController
{
    public function index()
    {
        return $this->vendorView('index');
    }

    public function home()
    {
        return $this->vendorView('home');
    }
}
