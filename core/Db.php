<?php
 
class Db
{
    private $master;
    private $slave;
    private $config;
    public function __construct()
    {
        $config = get_config();
        $this->config = $config['db'];
    }
    public function __call($name, $arguments)
    {
        if ($name != 'query') {
            throw new RuntimeException($name."：This command is not supported");
        } else {
            return $this->_execute($arguments[0]);
        }
    }
    
    public function connect($config)
    {
        //主库
        $master = new Swoole\Coroutine\MySQL();
        $res = $master->connect($this->config);
        if ($res === false) {
            throw new RuntimeException($master->connect_error, $master->errno);
        } else {
            $this->master = $master;
        }
        return $res;
    }
    
    public function add($table = '', $data = [])
    {
        $fields = '';
        $values = '';
        $keys = array_keys($data);
        foreach ($keys as $k) {
            $fields .= "`".addslashes($k)."`, ";
            $values .= "'".addslashes($data[$k])."', ";
        }
        $fields = substr($fields, 0, -2);
        $values = substr($values, 0, -2);
        $sql = "INSERT INTO `{$table}` ({$fields}) VALUES ({$values})";
        return $this->_execute($sql);
    }
    
    public function update($table = '', $set = [], $where = [])
    {
        $arr_set = [];
        foreach ($set as $k => $v) {
            $arr_set[] = '`'.$k . '` = ' . $this->_escape($v);
        }
        $set = implode(', ', $arr_set);
        $where = $this->_where($where);
        $sql = "UPDATE `{$table}` SET {$set} {$where}";
        return $this->_execute($sql);
    }
    
    public function del($table = '', $where = [])
    {
        $where = $this->_where($where);
        $sql = "DELETE FROM `{$table}` {$where}";
        return $this->_execute($sql);
    }
    
    public function find($table = '', $where = [])
    {
        $where = $this->_where($where);
        $sql = "SELECT * FROM `{$table}` {$where}";
        return $this->_execute($sql);
    }
    
    private function _where($where = [])
    {
        $str_where = '';
        foreach ($where as $k => $v) {
            $str_where .= " AND `{$k}` = ".$this->_escape($v);
        }
        return "WHERE 1 ".$str_where;
    }
    
    private function _escape($str)
    {
        if (is_string($str)) {
            $str = "'".$str."'";
        } elseif (is_bool($str)) {
            $str = ($str === false) ? 0 : 1;
        } elseif (is_null($str)) {
            $str = 'NULL';
        }
        return $str;
    }
    public function sql($sql)
    {
        return $this->_execute($sql);
    }
    private function _execute($sql)
    {
        $db = $this->_get_usable_db();
        dump($sql);
        $result = $db->query($sql);
        
        if ($result === true) {
            return [
                    'affected_rows' => $db->affected_rows,
                    'insert_id'     => $db->insert_id,
                    'data'=>$db->fetchAll()
                ];
        }
        return $result;
    }
    
    private function _get_usable_db()
    {
        $master = new Swoole\Coroutine\MySQL();
        $res = $master->connect($this->config);
        if ($res === false) {
            throw new RuntimeException($master->connect_error, $master->errno);
        } else {
            $this->master = $master;
        }
        return $this->master;
    }
}
