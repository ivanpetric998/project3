<?php

namespace app\providers;

class DB
{
    private $pdo;

    public function __construct($server, $db, $user, $password) {

        try {
            $this->pdo = new \PDO("mysql:host=" . $server . ";dbname=" . $db .  ";charset=utf8", $user, $password);

            $this->pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
        catch(\PDOException $ex){
            echo $ex->getMessage();
        }
    }

    public function select(string $query, Array $params=null)
    {
        if($params==null)
            return $this->pdo->query($query)->fetchAll();
        
        $prepare = $this->pdo->prepare($query);
        $prepare->execute($params);
        return $prepare->fetchAll();
    }

    public function selectOne(string $query, Array $params=null)
    {
        if($params==null)
            return $this->pdo->query($query)->fetch();
        
        $prepare = $this->pdo->prepare($query);
        $prepare->execute($params);
        return $prepare->fetch();
    }

    public function insert(string $query, Array $params)
    {
        $this->executeNonGet($query, $params);
    }

    public function insertLastId(string $query, Array $params)
    {
        $prepared = $this->pdo->prepare($query);
        $prepared->execute($params);
        return $this->pdo->lastInsertId();
    }

    public function delete(string $query, Array $params)
    {
        $this->executeNonGet($query, $params);
    }

    public function update(string $query, Array $params)
    {
        $this->executeNonGet($query, $params);
    }

    public function startTransaction()
    {
        $this->pdo->beginTransaction();
    }

    public function executeTransaction()
    {
        $this->pdo->commit();
    }

    public function rollBackTransaction()
    {
        $this->pdo->rollBack();
    }

    private function executeNonGet(string $query, Array $params)
    {
        $prepared = $this->pdo->prepare($query);
        $prepared->execute($params);
    }


}