<?php

return [
	//进程名称
	'master_process_name'=>'lizhili_server_master',
	'manager_process_name'=>'lizhili_server_manager',
	'worker_process_name'=>'lizhili_server_worker',
	'task_process_name'=>'lizhili_server_task',
	
	
	//错误日志
	'error_log_file' => ROOT_PATH.'cache/error/',
	'http_log_file' => ROOT_PATH.'cache/log/',
	
	
	//进程ID存储的文件
	'master_pid_file'  => ROOT_PATH.'cache/pid/master.pid',
	'manager_pid_file'  => ROOT_PATH.'cache/pid/manager.pid',
	'worker_pid_file'  => ROOT_PATH.'cache/pid/worker.pid',
	'task_pid_file'  => ROOT_PATH.'cache/pid/task.pid',
	
	//Swoole - IP信息
	'ip'   => '0.0.0.0',
	'websocket_port' => 9509, //onMessage + onRequest(HTTP)
	'tcp_port'       => 9510, //onReceive
	//http 设置
	'set'=>[
		'worker_num' => 4,
		'task_worker_num' => 4,
		'max_request' => 1000,
		'dispatch_mode' => 2,
		'daemonize' => false,
		'log_file' => ROOT_PATH.'cache/error/error.log',
		
		'enable_static_handler' => true,
		'document_root' => ROOT_PATH.'static',
		          
	],
	//长连接 tcp 设置
	'tcp_set'=>[
		'worker_num' => 2,
		'max_request' => 2000,
		'dispatch_mode' => 2,
		'open_length_check' => true,
		'package_max_length' => 8192,
		'package_length_type' => 'N',
		'package_length_offset' => '0',
		'package_body_offset' => '4',
	],
	'pool'=>[
		'pool_size'=>5,
		'pool_get_timeout'=>0.5,
		'timeout'=>0.5,
		'charset'=>'utf8',
	],
	'db'=>[
		'host'=>'127.0.0.1',
		'port'=>3306,
		'user'=>'uniswoole.com',
		'password'=>'Met7MNDdSMzz2X5T',
		'database'=>'uniswoole.com',
		'strict_type' => false,
		'fetch_mode'  => true,
	],
	
];
