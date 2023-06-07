<?php

//this function returns the path of shop source
if (!function_exists('shop_path')) {
    function shop_path($path = '')
    {
        return app()->joinPaths(app()->basePath('shop'), $path);
    }
}
//this function returns the given price in cents
if (!function_exists('price_in_cents')) {
    function price_in_cents($price)
    {
        return $price * 100;
    }
}
//this function returns the given price in in float
if (!function_exists('price_in_float')) {
    function price_in_float($price)
    {
        return number_format((float)$price / 100, 2, '.', '');
    }
}
