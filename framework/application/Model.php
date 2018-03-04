<?php

/**
 * Created by PhpStorm.
 * User: colorrabbit
 * Date: 2017/6/12
 * Time: 下午2:05
 */
class Model
{
    protected $tableName;

    public function __construct($tableName)
    {
        $this->tableName = $tableName;
    }

    /**
     * @param string $field 可以是字段包括{"sum(id), count(*) as cnt"}
     * @param array  $where
     *
     * @return mixed
     */
    public function getInfo($field = '', $where = array())
    {
        if ($where) {
            $this->handleWhere($where);
        }

        return CR::$model->getOne($this->tableName, $field);
    }

    public function getInfos($field = array(), $limit = null, $where = array())
    {
        if ($where) {
            $this->handleWhere($where);
        }

        return CR::$model->get($this->tableName, $limit, $field);
    }

    public function insertInfo($data)
    {
        $lastInsertId = CR::$model->insert($this->tableName, $data);
        if (empty($lastInsertId)) {
            throw new \Exception(CR::$model->getLastError());
        } else {
            return $lastInsertId;
        }
    }

    public function insertInfos($data, $keys = array())
    {
        if (empty($keys)) {
            $lastInsertIds = CR::$model->insertMulti($this->tableName, $data);
        } else {
            $lastInsertIds = CR::$model->insertMulti(
                $this->tableName, $data, $keys
            );
        }
        if (empty($lastInsertIds)) {
            throw new \Exception(CR::$model->getLastError());
        } else {
            return implode(', ', $lastInsertIds);
        }
    }

    public function removeBy($where)
    {
        $this->handleWhere($where);

        CR::$model->delete($this->tableName);
    }

    private function handleWhere($where)
    {
        foreach ($where as $key => $value) {
            CR::$model->where($key, $value);
        }
    }
}