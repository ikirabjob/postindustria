<?php
/**
 * Created by PhpStorm.
 * User: ikirab
 * Date: 22.11.16
 * Time: 9:37
 */

namespace app;

use \PDO;
use \PDOException;

ini_set('display_errors', 1);

define('DBHOST', 'localhost');

define('DBNAME', 'test');

define('DBUSER', 'root');

define('DBPASSWORD', 'Pr1veden1e');

final class Init extends PDO
{

    /**
     * Init constructor.
     */
    public function __construct(){
        try {
            parent::__construct('mysql:host=' . DBHOST . ';dbname=' . DBNAME, DBUSER, DBPASSWORD);
            $this->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            $this->query("SET NAMES `utf8`");
        }
        catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    /**
     * create db table
     */
    private function create(){
        try{
            $this->query("CREATE TABLE IF NOT EXISTS `test` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `script_name` varchar(25) NOT NULL,
                `strart_time` int(11) NOT NULL,
                `end_time` int(11) NOT NULL,
                `result` ENUM ('normal', 'illegal', 'failed' ,'success'),
                PRIMARY KEY (`id`)
            ) Engine=InnoDB DEFAULT CHARSET=utf8;");
        } catch (PDOException $e){
            die($e->getMessage());
        }
    }

    /**
     * Fills table with random data
     */
    private function fill(){

        try {

            $sql = "INSERT INTO `test` (`script_name`, `start_time`, `end_time`, `result`) VALUES (:sname, :start, :tend, :res)" ;

            $params = [
                ['sname' => 'index', 'start' => time(), 'tend' => time()+mt_rand(3600, 86000), 'res' => 'normal'],
                ['sname' => 'about', 'start' => time(), 'tend' => time()+mt_rand(3600, 86000), 'res' => 'illegal'],
                ['sname' => 'contact', 'start' => time(), 'tend' => time()+mt_rand(3600, 86000), 'res' => 'failed'],
                ['sname' => 'login', 'start' => time(), 'tend' => time()+mt_rand(3600, 86000), 'res' => 'success'],
                ['sname' => 'register', 'start' => time(), 'tend' => time()+mt_rand(3600, 86000), 'res' => 'normal'],
                ['sname' => 'logout', 'start' => time(), 'tend' => time()+mt_rand(3600, 86000), 'res' => 'illegal'],
                ['sname' => 'item', 'start' => time(), 'tend' => time()+mt_rand(3600, 86000), 'res' => 'failed'],
                ['sname' => 'cart', 'start' => time(), 'tend' => time()+mt_rand(3600, 86000), 'res' => 'success']
            ];

            $this->beginTransaction();

            $stmt = $this->prepare($sql);

            foreach($params as $row)
            {
                foreach($row as $column => $value)
                {
                    $stmt->bindValue(":{$column}", $value);
                }
                $stmt->execute();
            }

            $this->commit();

        } catch(PDOException $e) {
            $this->rollBack();
        }
    }

    /**
     * @return array|bool
     */
    public function get(){
        try{
            $sql = "SELECT * FROM `test` WHERE `result` IN ('normal', 'success')";
            $stmt = $this->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();

            return $result;

        } catch (PDOException $e){
            die($e->getMessage());
        }
    }
}

$init = new Init();
$data = $init->get();

echo "<pre>";
    print_r($data);
echo "</pre>";