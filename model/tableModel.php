<?php

/**
 * Created by PhpStorm.
 * User: ikirab
 * Date: 10/8/16
 * Time: 6:24 AM
 */
class TableModel extends model
{
    public function __construct()
    {
        $this->table = 'mytable';
        $this->db = new db();
    }

    public function getAllData(){
        $items = $this->getAll();
        return $items;
    }

    public function save($data = []){
        if($data and !empty($data)){

            $save_data = [];

            foreach($data as $k=>$v){
                $save_data[] = '('.$k.','.(!empty($v) ? $v : "''").')';
            }

            $this->db->insert_("INSERT INTO `mytable` (`id`, `number`) VALUES ".implode(',',$save_data)." ON DUPLICATE KEY UPDATE `number` = VALUES(number)");

        }
    }
}