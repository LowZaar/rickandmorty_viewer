<?php


if (!function_exists('extractIdFromUrl')) {
    function extractIdFromUrl($url)
    {
        $splitUrl = explode('/', $url);
        return end($splitUrl);
    }
}
