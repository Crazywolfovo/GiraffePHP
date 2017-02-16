<?php
/**
    .-----------------------------------------------------------------------------------
    | Software: Giraffe Framework [Neck long to see far~！]
    | Version: 2017.2
    |-----------------------------------------------------------------------------------
    | Author: YZR <154966231@qq.com>
    | Copyright (c) 2017-Forever All Rights Reserved.
    |-----------------------------------------------------------------------------------
    | Discription:Singleton pattern of database
    |-----------------------------------------------------------------------------------
*/
namespace giraffe\lib\db;

use giraffe\lib\load\ConfLoad;

class DataBase
{
    /**
     * Singleton pattern
     * @method private construct()
     * @method private __clone()
     * @method public instacne()      instance class DataBase
     * @param obj private $_instance  $instance exist obj of class DataBase
     */
    private static $_instance = null;
    private static $conf;
    private $link;// object of PDO

    private function __construct()
    {
        self::$conf = ConfLoad::getallline('dbconf');
        $this->connect(self::$conf);
        //dump($this->link);
        //return $this;
    }
    private function __clone(){}
    public static function instance()
    {
        if (!(DataBase::$_instance instanceof DataBase)) {
              DataBase::$_instance = new DataBase();
        }
        return DataBase::$_instance;//object of DataBase
    }
    /**
     * @method filter configs
     */
    private static function filter($value)
    {
        if (is_numeric($value)) {
            return $value;
        }else{
            return isset($value)?addslashes(trim($value)):null;
        }
    }
    /**
     * connect database
     */
    private function connect($config)
    {
        //$dbtype,$dbhost,$dbport,$dbname,$charset,$user,$pass,$pconnect,$prefix
        if (is_array($config)) {
            // analyze the $configs
            $dsn = self::filter($config['dbtype']).':host='.self::filter($config['dbhost']).';port='.self::filter($config['dbport']).';dbname='.self::filter($config['dbname']);
            $user = self::filter($config['user']);
            $pass = self::filter($config['pass']);
            $pcon = array( \PDO::ATTR_PERSISTENT => self::filter($config['pconnect']));
            $charset = self::filter($config['charset']);
            //connect DB by PDO
            try {
                $this->link = new \PDO($dsn, $user, $pass,$pcon);
                $this->link->exec('SET character_set_connection='.$charset.', character_set_results='.$charset.', character_set_client=binary');
            } catch (\PDOException $e) {
                print "Error!: " . $e->getMessage() . "<br/>";
                die("连接失败~!");
            }
        }else{
            die("配置文件格错误~!");
        }
        //return $this;
    }
    /*
    *@method  take off PDO connect
    */
    public function colse_link()
    {
        return $this->link = null;
    }
/*
*|-----------------------------------------------------------------------------------
*| Discription:Original SQL;
*|-----------------------------------------------------------------------------------
*/
    /*
    *@method INSERT
    */
    public function insert($tabel,$values,$option)
    {
        $sql_str = "INSERT INTO ".$tabel." VALUES ".$values;
        $resnum = $this->execute($sql_str);
        if ($option == 'lastInsertId') {
            return $this->link->lastInsertId();
        }else{
            return $resnum;
        }
    }
    /*
    *@method  UPDATE
    */
    public function update($tabel,$values,$conditions)
    {
        if (!is_null($conditions)) {
            $sql_str = "UPDATE ".$tabel." SET ".$values." WHERE ".$conditions;
        }else{
            $sql_str = "UPDATE ".$tabel." SET ".$values;
        }
        return $this->execute($sql_str);
    }
    /*
    *@method  DELETE
    */
    public function delete($table,$conditions)
    {
         if (!is_null($conditions)) {
            $sql_str = "DELETE FROM ".$table." WHERE ".$conditions;
        }else{
            $sql_str = "DELETE FROM ".$table;
        }
        return $this->execute($sql_str);
    }
    /*
    *@method  PDO::exec
    */
    private function execute($sql_str)
    {
        $resnum = $this->link->exec($sql_str);
        if ($resnum) {
            return $resnum;
        }else{
            return false;
        }
    }
    /*
    *@method SELECT
    */
    public function select($columns,$tabel,$conditions,$method,$options = '')
    {
        if (!is_null($conditions)) {
            $sql_str = "SELECT ".$columns." FROM ".$tabel." WHERE ".$conditions;
        }else{
            $sql_str = "SELECT ".$columns." FROM ".$tabel;
        }
        $result = $this->link->query($sql_str);
        switch ($method) {
            case 'fetch':
                $resarray = $result->fetch($options);
                break;
            case 'fetchAll':
                $resarray = $result->fetchAll($options);
                break;
            case 'fetchColumn':
                $resarray = $result->fetchColumn($options);
                break;
            default:
                $resarray = $result->fetchAll(PDO::FETCH_ASSOC);
                break;
        }
        $resnum = isset($resarray['0']['0'])?intval($resarray['0']['0']):null;
        if ($result && $resnum){
            return $resarray;
        }else{
            return false;
        }
    }
}