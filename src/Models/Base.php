<?php

namespace App\Models;



use App\Database\MicroBlogMessages;
use App\Database\MicroBlogUsers;

class Base
{
    protected static $pdo;
    protected $microBlogTable;
    protected $microBlogMessagesTable;

    function __construct()
    {
    $this->microBlogTable = new MicroBlogUsers();
        $this->microBlogTable->timestamps = false;
        $this->microBlogMessagesTable = new MicroBlogMessages();
        $this->microBlogMessagesTable->timestamps = false;
    }

    protected function getConnect()
    {
        if (self::$pdo === null) {
            self::$pdo = new \PDO(
                DSN_DB, USERNAME_DB, PASSWORD_DB
            );
        }
        return self::$pdo;
    }


}