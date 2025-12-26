<?php

class Database
{
    private static $conn = null;

    public static function connect()
    {
        if (self::$conn === null) {
      
            $host = "127.0.0.1";
            $dbname = "dbmetis";
            $user = "root";
            $pass = "";  
            
            $dsn = "mysql:host=" . $host . ";dbname=" . $dbname;
            
            self::$conn = new PDO($dsn, $user, $pass);
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }
        return self::$conn;
    }
}