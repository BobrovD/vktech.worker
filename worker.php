<?php
/**
 * Created by PhpStorm.
 * User: Orange
 * Date: 29.08.17
 * Time: 20:28
 */
//скрипт, выполняющий задания из work
require_once '/var/www/worker/require.php';

error_catcher();

$works = get_work(100);
if(count($works) === 0){
    echo 'Nothing to do';
    exit();
}
foreach ($works as $work){
    work_hard($work);
}