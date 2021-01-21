<?php

class MysqlPool
{
    private static $instance;
    private $pool;
    private $config;

    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function __construct()
    {
        $config = get_config();
        if (empty($this->pool)) {
            $this->config = $config;
            $this->pool = new chan($config['pool']['pool_size']);
            for ($i = 0; $i < $config['pool']['pool_size']; $i++) {
                go(function () use ($config) {
                    $master = new \Db($config['db']);
                    if ($res === false) {
                        throw new RuntimeException($master->connect_error, $master->errno);
                    } else {
                        $this->pool->push($master);
                    }
                });
            }
        }
    }

    public function get()
    {
        // if ($this->pool->length() > 0) {
        $mysql = $this->pool->pop($this->config['pool']['pool_get_timeout']);
        if (false === $mysql) {
            throw new RuntimeException("Pop mysql timeout");
        }
        defer(function () use ($mysql) { //释放
            $this->pool->push($mysql);
        });
        return $mysql;
        // } else {
        //     throw new RuntimeException("Pool length <= 0");
        // }
    }
}
