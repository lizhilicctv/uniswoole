<?php

class Login
{
    public function home($request,$param)
    {

		$file=$request->files['file'];
		$res=move($file,'web');
		dump($res);
	
       return $param;
	 
    }
	
	public function logo($request,$param)
	{
		
	
	   return $param;
	 
	}
}