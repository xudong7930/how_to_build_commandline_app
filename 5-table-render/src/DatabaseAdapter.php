<?php

namespace Acme;

use PDO;

class DatabaseAdapter {

    protected $connection;

    public function __construct(PDO $conneciton)
    {
        $this->conneciton = $conneciton;
    }

    public function fetchAll($table)
    {
        return $this->conneciton->query("select * from {$table}")->fetchAll();
    }

    public function query($sql, $parameters)
    {
        return $this->conneciton->prepare($sql)->execute($parameters);
    }
}
