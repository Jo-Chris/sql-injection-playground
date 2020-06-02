<?php

class Database
{

    public $connection;

    /**
     * Connect to MySQL database
     */
    public function connect(){
        try {
            $this->connection = new PDO('mysql:host=localhost;dbname=sqlinjection', 'root', 'root');
        } catch (Exception $e){
            echo 'Could not connect to database!';
        }
    }

}