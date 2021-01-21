<?php

class OnRequest
{
    public static function run($request, $response)
    {
        try {
            $response->header("Server", "lizhiliServer");
            $server = $request->server;
            $path_info    = $server['path_info'];
            $request_uri  = $server['request_uri'];

            if ($path_info == '/favicon.ico' || $request_uri == '/favicon.ico') {
                return $response->end();
            }

            $controller = 'Index';
            $method     = 'home';
            
            if ($path_info != '/') {
                $path_info = explode('/', $path_info);
                if (!is_array($path_info)) {
                    $response->status(404);
                    $response->end('URL不存在');
                }

                if ($path_info[1] == 'favicon.ico') {
                    return;
                }

                $count_path_info = count($path_info);
                if ($count_path_info > 4) {
                    $response->status(404);
                    $response->end('URL不存在');
                }
                $controller = (isset($path_info[1]) && !empty($path_info[1])) ? $path_info[1] : $controller;
                $method = (isset($path_info[2]) && !empty($path_info[2])) ? $path_info[2] : $method;
            }
            $controller=ucfirst($controller); //首字母大写
            $result = "class 不存在";
            if (class_exists($controller)) {
                $class = new $controller();
                $result = "method 不存在";
                if (method_exists($controller, $method)) {
                    $get=isset($request->get) ? $request->get : [];
                    $post=isset($request->post) ? $request->post : [];
                    $param=array_merge($get, $post);
                    require_once ROOT_PATH."core/Db.php";
                    $result = $class->$method($request, $param);
                }
            }
            if (is_array($result)) {
                $response->header("Content-Type", "application/json; charset=utf-8");
                $result=json_encode($result);
            } else {
                $response->header("Content-Type", "text/html; charset=utf-8");
            }

            $response->end($result);
        } catch (Exception $e) {
        }
    }
}
