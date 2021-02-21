<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 2/20/21
 * Time: 4:41 AM
 */


namespace App\Models;


use App\Db\DbConnection;
use PDO;

abstract class MainAbstractModel
{
    protected ?PDO $db;
    public function __construct()
    {
       $this->db = DbConnection::getConnection();
    }

}
