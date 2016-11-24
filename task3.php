<?php
/**
 * Created by PhpStorm.
 * User: ikirab
 * Date: 23.11.16
 * Time: 8:59
 */

function getFile()
{
    $pattern = '/^[a-zа-я0-9]+\.(?:txt)$/i';
    $path = 'files';
    $files = scandir($path);
    $result = [];
    foreach ($files as $file){
        if(preg_match($pattern, $file)) {
            $result[] = $file;
        } else continue;
    }

    unset($files);
    sort($result);
    return $result;
}

$data = getFile();

echo "<pre>";
    print_r($data);
echo "</pre>";