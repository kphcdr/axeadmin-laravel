<?php

namespace Axe\Http\Controllers;


use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    private $viewPrefix = "axe::";

    protected function vendorJson(bool $ret, $data = null, string $message = "")
    {
        return [
            "ret"     => $ret,
            "data"    => $data,
            "message" => $message
        ];
    }

    protected function vendorView($view, $data = [], $mergeData = [])
    {
        return view($this->viewPrefix . $view, $data, $mergeData);
    }
}