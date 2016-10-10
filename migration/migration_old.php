<?php

/**
 * Created by PhpStorm.
 * User: ikirab
 * Date: 10/9/16
 * Time: 7:50 AM
 */
class migration
{
    public $migration = 'mytable';
    public $db;
    public $limit = 100;

    public $HOST = "localhost";        // имя сервера
    public $USER = "root";             // пользователь базы данных MySQL
    public $PASS = "Pr1veden1e";                 // пароль для доступа к серверу MySQL
    public $DB = "table";               // название создаваемой базы данных

    public $connect;

    public function up(){
        $this->connect();
        $this->createDb();
        $this->createTable();

        $this->setDefault();
        $this->unlinkMigration();
    }

    public function connect(){
        if(!$this->connect = mysqli_connect("$this->HOST", "$this->USER", "$this->PASS")){
            return $this->connect;
        }
        else {echo mysqli_error($this->connect);}
    }

    public function createDb(){

        echo "Please wait a few seconds while a database is created...<br>";

        $r = mysqli_query($this->connect,"CREATE DATABASE IF NOT EXISTS `{$this->DB}` CHARACTER SET utf8 COLLATE utf8_general_ci");
        if(!$r) exit(mysqli_error($this->connect));

        if (!mysqli_select_db($this->connect,$this->DB)) exit(mysqli_error($this->connect));

        echo "The database {$this->DB} was successfully created...<br>";
    }

    public function createTable(){

        echo "Table create...<br>";

        $t = mysqli_query($this->connect,
            "CREATE TABLE `mytable` (
              id INT UNSIGNED NOT NULL AUTO_INCREMENT,
              number INT(11) NOT NULL,
              PRIMARY KEY(id)
            ) ENGINE=InnoDB;");
        if(!$t) exit(mysqli_error($this->connect));

        echo "The table was successfully created ...<br>";
    }

    public function setDefault(){

        $default = [];

        for($i = 1; $i <= $this->limit; $i++){
            $default[] = '('.$i.')';
        }

        $d = mysqli_query($this->connect, "INSERT INTO `mytable` (`number`) VALUES ".implode(',', $default));
        if(!$d) exit(mysqli_error($this->connect));
    }

    public function unlinkMigration(){
        rename('migration/migration.php', 'migration/migration_old.php');
        header('Location: /');
    }

}