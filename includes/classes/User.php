<?php
class User
{
    private $connection;
    private $sqlData;

    public function __construct($connection, $username)
    {
        $this->connection = $connection;
    }
}