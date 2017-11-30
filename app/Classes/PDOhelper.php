<?php
/**
 * Created by PhpStorm.
 * User: teach
 * Date: 11/29/2017
 * Time: 5:20 PM
 */

namespace App\Classes;

use PDO;

// SINGLETON Class
class PDOhelper
{
    private $host;
    private $db;
    private $dbType;
    private $user;
    private $pass;
    private $charset;
    private $dsn;
    private $pdoObject;

    /**
     * PDOhelper constructor.
     */
    protected function __construct()
    {
        $this->host = env('DB_HOST');
        $this->db = env('DB_DATABASE');
        $this->dbType = env('DB_CONNECTION');
        $this->user = env('DB_USERNAME');
        $this->pass = env('DB_PASSWORD');
        $this->charset = 'utf8mb4';

        $this->dsn = "$this->dbType:host=$this->host;dbname=$this->db;charset=$this->charset";
        $this->opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $this->pdoObject = new PDO($this->dsn, $this->user, $this->pass, $this->opt);
    }

    protected static $_instance = null;

    /**
     * @return PDOhelper|null
     */
    public static function instance() {

        if ( !isset( self::$_instance ) ) {

            self::$_instance = new PDOhelper();

        }

        return self::$_instance;
    }


    /**
     * @return PDO
     */
    public function getPDOObject()
    {
        return $this->pdoObject;
    }

    public function startTransaction()
    {
        $this->opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false
        ];

        $this->pdo->beginTransaction();
    }
}