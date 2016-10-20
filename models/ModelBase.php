<?php

/**
 * ComponentAccessToken 实体类.
 * User: Administrator
 * Date: 2016.9.22
 * Time: 15:40
 */
include_once(dirname(__FILE__) . '/../helper/db.php');

class ModelBase
{
    public $db;
    public $primary_key;
    public $primary_key_value;
    public $table_name = null;

    public function __construct()
    {
        $this->db = new DB();
    }

    public function __destruct()
    {
        $this->db->close();
    }

    public function first()
    {
        return $this->db->fetOne($this->table_name, '*',
            $this->primary_key . " = '" . $this->primary_key_value . "'");
    }

    public function initData()
    {
        return null;
    }

    public function add()
    {
        if ($this->exist()) {
            return $this->update();
        }
        $data = $this->initData();
        return $this->db->add($this->table_name, $data) > 0;

    }

    public function update()
    {
        $data = $this->initData();
        $this->db->update($this->table_name, $data, $this->primary_key . " = '" . $this->primary_key_value . "'");
        return true;
    }

    public function exist()
    {
        $sql = "select * from " . $this->table_name
            . " where " . $this->primary_key . " = '" . $this->primary_key_value . "'";
        $result = $this->db->getRowCount($sql);
        return $result > 0;
    }
}