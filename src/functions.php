<?php

if (!function_exists("axe_url")) {
    function axe_url($path = "")
    {
        return "/" . config("axe.url") . "/" . $path;
    }
}
