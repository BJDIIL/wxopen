<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015.12.16
 * Time: 16:09
 */
$filename = 'messageevent.txt';
$content = file_get_contents("php://input");
file_put_contents($filename, $content . PHP_EOL, FILE_APPEND);