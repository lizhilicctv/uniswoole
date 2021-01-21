<?php

class Index
{
    private $mysql;
    public function __construct()
    {
        $pool = MysqlPool::getInstance();
        $this->mysql = $pool->get();
    }
    
    
    public function home($request, $param)
    {
        $param=[
            'id'=>1,
			'name'=>'lizhili'
        ];
		//上传文件实例
        // $file=$request->files['file'];
        // $res=move($file,'web');
        // dump($res);
        
		
		//mysql 使用实例
        //	$wo=$this->mysql->add('wo',['name'=>1111]);
        //	$wo=$this->mysql->del('wo',['name'=>1111]);
        //	$wo=$this->mysql->update('wo',['name'=>1222222221],['id'=>1]);
        //	$wo=$this->mysql->find('wo',['id'=>1]);
        //	$wo=$this->mysql->sql('select * from `wo`');
        //	dump($wo);
        
        
        return $param;
    }
    
    public function logo($request, $param)
    {
        return $param;
    }
}
