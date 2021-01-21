<?php




//最简单定义dump
if (!function_exists('dump')) {
	function dump($data=null){
	 var_dump($data);	
	}
}

//查看文件有没有更改
if (!function_exists('hotfile')) {
	function hotfile($file){
	$md5='';
	 $temp=scandir($file);
	 foreach($temp as $v){
		 $a=$file.'/'.$v;
		if(!is_dir($a)){//如果是文件夹则执行
		 $md5.=md5_file($a);
		}
	 }
	 return $md5;
	}
}
//上传 文件
if (!function_exists('move')) {
	function move($file,$uplod_path){
	    $file_name = md5($file['name']).'.'.substr($file['name'], strrpos($file['name'], '.')+1);
	    $file_tmp_path = $file['tmp_name'];
	    $uplod_path = ROOT_PATH.'static/uplode/'.date('Ymd').'/';
	    if(!file_exists($uplod_path)){
	        mkdir($uplod_path);
	    }
	    $res = move_uploaded_file($file_tmp_path,$uplod_path . $file_name);//函数将上传的文件移动到新位置。
		if($res){
			return $uplod_path . $file_name;
		}
		return false;
	}
}


// //下面是定义dump 由于在cil 不太好用
// function dump_web($var, $echo=true, $label=null, $strict=true) {
//     $label = ($label === null) ? '' : rtrim($label) . ' ';
//     if (!$strict) {
//         if (ini_get('html_errors')) {
//             $output = print_r($var, true);
//             $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
//         } else {
//             $output = $label . print_r($var, true);
//         }
//     } else {
//         ob_start();
//         var_dump($var);
//         $output = ob_get_clean();
//         if (!extension_loaded('xdebug')) {
//             $output = preg_replace('/\]\=\>\n(\s+)/m', '] => ', $output);
//             $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
//         }
//     }
//     if ($echo) {
//         echo($output);
//         return null;
//     }else
//         return $output;
// }
