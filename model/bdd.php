<?php 
class SPDO
{
    private static $instance = null;

    const DEFAULT_SQL_USER = 'root';
    const DEFAULT_SQL_HOST = 'localhost';
    const DEFAULT_SQL_PASS = '';
    const DEFAULT_SQL_DTB = 'studentbook1';

    public static function getInstance()
    {
        if(is_null(self::$instance))
        {
            self::$instance = new PDO('mysql:dbname='.self::DEFAULT_SQL_DTB.';host='.self::DEFAULT_SQL_HOST,self::DEFAULT_SQL_USER ,self::DEFAULT_SQL_PASS);
            self::$instance->exec("SET NAMES 'UTF8'");
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);//defini la méthode de retour fetch
        }
        return self::$instance;
    }

}