<?php

/**
 * Created by PhpStorm.
 * User: ikirab
 * Date: 10/9/16
 * Time: 4:33 AM
 */
class model
{
    /**
     * @var
     */
    public $table;
    /**
     * @var db
     */
    public $db;


    /**
     * @return array|bool|mixed
     */
    public function getAll(){
        $data = $this->db->get_("SELECT * FROM {$this->table} WHERE 1=1", 1);
        return $data;
    }

    /**
     * @param $id
     * @return array|bool|mixed|null
     */
    public function getOne($id){
        if($id){
            $data = $this->db->get_("SELECT * FROM {$this->table} WHERE id=:id",1, array(':id'=>(int)$id));
            return $data;
        }

        return null;
    }

}