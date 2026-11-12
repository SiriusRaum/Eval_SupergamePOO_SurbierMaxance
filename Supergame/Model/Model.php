<?php

class Model {
    
    private PDO $bdd;

    public function __construct() {
        $this->bdd = new PDO(
            'mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'],
            $_ENV['DB_USER'],
            $_ENV['DB_PASS']
        );
    }

    public function getBdd(): PDO {
        return $this->bdd;
    }
}