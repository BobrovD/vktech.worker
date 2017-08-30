<?php
/**
 * Created by PhpStorm.
 * User: Orange
 * Date: 28.08.17
 * Time: 17:04
 */


function update_timeout_payments(){
    $table = 'payment';
    $server = 'master';
    $timeout = time() - 60 * 60 * 8; //время на оплату
    $query = 'UPDATE '.$table.' SET status = \'outdated\' WHERE status = \'created\' AND time < \''.$timeout.'\'';
    query($table, $server, $query);
}
