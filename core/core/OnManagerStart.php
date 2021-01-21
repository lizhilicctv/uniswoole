<?php

class OnManagerStart
{
    public static function run($serv, $config)
    {
        try {
            swoole_set_process_name($config['manager_process_name']);
            echo str_pad("Manager", 20, ' ', STR_PAD_BOTH ).
                str_pad($config['manager_process_name'], 23, ' ', STR_PAD_BOTH ).
                str_pad($serv->manager_pid, 17, ' ', STR_PAD_BOTH ).
                str_pad(posix_getppid(), 16, ' ', STR_PAD_BOTH ).
                str_pad(posix_user_name(), 16, ' ', STR_PAD_BOTH ).PHP_EOL;

            file_put_contents($config['manager_pid_file'],
                $serv->manager_pid."-".
                posix_getppid()."-".
                posix_user_name());
				
			
			// 实例化 mysql 进程池
			// 使用task
			// $param=[
			// 	'type'=>'mysqlpool'
			// ];
			// $serv->task(json_encode($param));
						
		//	 new MysqlPool();	
				

        } catch(Exception $e) {
        }
	
		
    }
}
