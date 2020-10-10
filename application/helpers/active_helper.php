<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
if (!function_exists('active_menu')) {

    function active_menu($path, $className = ' active') {
        $CI = & get_instance();
        $current_url = $CI->uri->uri_string();
        return ($current_url === $path || substr($current_url, 0, strrpos($current_url, "/"))  === $path || $current_url === $path.'/') ? $className : '';
    }

}
?>