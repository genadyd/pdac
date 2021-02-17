<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 2/17/21
 * Time: 12:46 PM
 */


namespace App\Db;


class DbConnection
{
    private function __construct()
    {
    } /*hold static class*/

    private static ?DbConnection $instance = NULL;

    public static function getConnection():?\PDO
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance->connection();
    }

    private function connection():?\PDO
    {

        $db_config = array(
            'host'=>'localhost',
            'db_name'=>'pdac',
            'db_user'=>'root',
            'db_pass'=>'1234'
        );
        try {
            return new \PDO('mysql:host=' . $db_config['host'] . ';dbname=' . $db_config['db_name'], $db_config['db_user'], $db_config['db_pass']);
        } catch (\Exception $e) {
            echo 'Connection failed: ' . $e;
            return NULL;
        }
    }
}
