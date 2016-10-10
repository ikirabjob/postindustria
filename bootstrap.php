<?php
/**
 * Created by PhpStorm.
 * User: ikirab
 * Date: 10/9/16
 * Time: 4:38 AM
 */

if(file_exists("migration/migration.php")){
    require "migration/migration.php";
    $mgr = new migration();
    $create  = $mgr->up();
    exit();
}

require "config/config.php";
require "core/db.php";
require "core/route.php";
require "core/model.php";
require "core/view.php";
require "core/controller.php";