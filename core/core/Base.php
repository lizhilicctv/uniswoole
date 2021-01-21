<?php
if (!function_exists('get_config')) {
    function get_config($replace = []) {
		static $config;
		if($config){
			return $config;
		}
        $config_path = ROOT_PATH.'config/Config.php';
        if (!file_exists($config_path)) {
            exit('The configuration file does not exist.');
        }
		$config=require_once "{$config_path}";
		return $config;
    }
}

if (!function_exists('posix_user_name')) {
    function posix_user_name() {
        $posix = posix_getpwuid(posix_getuid());
        return $posix['name'];
    }
}

if (!function_exists('output')) {
    function output($msg = '') {
        return "[".date("Y-m-d H:i:s")."] ".$msg.PHP_EOL;
    }
}