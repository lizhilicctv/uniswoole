<?php

define('ROOT_PATH', str_replace( '\\', '/', __DIR__.'/'));

require_once ROOT_PATH."core/core/Base.php";
require_once ROOT_PATH."core/core/HandlerException.php";
require_once ROOT_PATH."core/Conn.php";

spl_autoload_register(function ($className) {
	//dump($className);
	if(substr($className,0,2)=='On'){
		$className='core/core/'.$className;
	}elseif($className=='MysqlPool'){
		$className='core/'.$className;
	}elseif($className=='Db'){
		$className='core/'.$className;
	}elseif($className!='core\core\Core'){
		$className='app/'.$className;
	}
    $classPath = str_replace( '\\', '/', ROOT_PATH . $className . ".php");
	//dump($classPath);
    if (is_file($classPath)) {
        require_once "{$classPath}";
    }
});

$sw = new core\core\Core();
$sw::run();