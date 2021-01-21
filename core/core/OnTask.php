<?php


class OnTask
{
    public static function tcp_task_run($serv, $task_id, $src_worker_id, $data)
    {
        try {
			$data=json_decode($data,true);
			if($data['type']=='mysqlpool'){
				
			}
			
            echo output("onTask: [PID={$serv->worker_pid}] Task_id={$task_id}");

            //业务代码
            for($i = 1 ; $i <= 5 ; $i ++ ) {
                sleep(1);
                echo output("onTask: Task {$task_id} 已完成了 {$i}/5 的任务");
            }
            $serv->send($data_arr['fd'] , output($data.',发送成功'));
            $serv->finish($data);

        } catch(Exception $e) {
            var_dump($e);
        }
    }

}
