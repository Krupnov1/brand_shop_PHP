<?php

namespace app\model;

use app\engine\Db;
use app\interfaces\IModel;
use app\engine\App;


abstract class Repository implements IModel {

    
    public function getAllObject() {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return App::call()->db->queryAllObject($sql, $params = [], $this->getEntityClass()); 
    }

    public function getOneObject($id) {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return App::call()->db->queryOneObject($sql, ['id' => $id], $this->getEntityClass());
    }

    public function getAll() {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return App::call()->db->queryAll($sql);
    }

    public function getOne($id) {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return App::call()->db->queryOne($sql, ['id' => $id]);
    }

    public function getLimit($page) {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} LIMIT 0, ?";
        return App::call()->db->queryLimit($sql, $page);
    }

    public function getLimitLikes($page) {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} ORDER BY likes DESC LIMIT 0, ?";
        return App::call()->db->queryLimit($sql, $page);
    }

    public function getWhere($name, $value) {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE {$name} = :value";
        return App::call()->db->queryOneObject($sql, ['value' => $value], $this->getEntityClass());
    }

    public function getCountWhere($name, $value) {
        $tableName = $this->getTableName();
        $sql = "SELECT count(id) as count FROM {$tableName} WHERE {$name} = :value";
        return App::call()->db->queryOne($sql, ['value' => $value])['count'];
    }

    public function insert(Model $entity) {
        $columns = [];
        $params = []; 
        foreach ($entity->props as $key => $value) {                
            $params[":{$key}"] = $entity->$key;
            $columns[] = $key; 
        }
        $columns = implode(",", $columns);
        $value = implode(",",array_keys($params));
        $tableName = $this->getTableName();  
        $sql = "INSERT INTO {$tableName} ({$columns}) VALUES ({$value})";
        App::call()->db->execute($sql, $params);
        $entity->id = App::call()->db->lastInsertId();
        //var_dump($this->id);
    }

    public function update(Model $entity) {
        $columns = [];
        $params = []; 
        foreach ($entity->props as $key => $value) { 
            $params[":{$key}"] = $entity->$key;
            $columns[] .= "{$key} = :{$key}";
            $entity->props[$key] = false;            
        }
        $columns = implode(",", $columns);
        $params['id'] = $entity->id;
        $tableName = $this->getTableName();
        $sql = "UPDATE {$tableName} SET {$columns} WHERE id = :id";
        App::call()->db->execute($sql, $params);
    }

    public function delete(Model $entity) {
        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        App::call()->db->execute($sql, [':id' => $entity->id]);
    }

    public function save(Model $entity) {
        if(is_null($entity->id)) {
            $this->insert($entity);
        } else {
            $this->update($entity);
        }
    }

    abstract protected function getEntityClass();
    abstract protected function getTableName();
}