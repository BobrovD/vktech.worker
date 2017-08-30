<?php
/**
 * Created by PhpStorm.
 * User: Orange
 * Date: 28.08.17
 * Time: 15:19
 */

function get_work ($works = 10) {
    $table = 'work';
    $server = 'master';
    $time = time();
    $query = 'SELECT data, work_id, cat FROM '.$table.' WHERE status = \'new\' AND wait_for <= \''.$time.'\' AND ( die > \''.$time.'\'  OR die = \'0\') ORDER BY priority DESC, work_id ASC LIMIT 0, '.$works;
    $result = query_ass($table, $server, $query);
    update_work_status($result['work_id'], 'in_progress');
    return $result;
}

function update_work_status($work_id, $status){
    $table = 'work';
    $server = 'master';//со слейвом тут не выйдет общаться, так как worker будет не один
    $query = 'UPDATE '.$table.' SET status = \''.$status.'\' WHERE work_id = \''.$work_id.'\'';
    query($table, $server, $query);
}

function delete_timeout_works(){
    $table = 'work';
    $server = 'master';//со слейвом тут не выйдет общаться, так как worker будет не один
    $time = time();
    $query = 'DELETE FROM '.$table. ' WHERE die <= \''.$time.'\' && die != \'0\'';
    query($table, $server, $query);
}

function well_done($work_id){
    $table = 'work';
    $server = 'master';
    $query = 'DELETE FROM '.$table. ' WHERE work_id = \''.$work_id.'\'';
    return query($table, $server, $query);
}

function work_hard($task){
    switch($task['cat']){
        case 'notification':
            if(send_email_notification($task)){
                well_done($task['work_id']);
            }
            break;
    }
}

function send_email_notification($task){
    $data = unserialize($task['data']);
    $to = $data['email'];
    $title = '';
    $message = '';
    switch($data['action']){
        case 'send_new_pwd':
            $title = 'Обновление пароля на eXOR';
            $message = 'Новый пароль: '.$data['pwd'];
            break;
    }
    echo $to.$message;
    return create_mail($to, $title, $message);
}

function create_mail($to, $title, $message){
    $from = 'no-reply@execordervk.tech';
    $headers = 'From: '.$from;
    return mail($to, $title, $message, $headers);
}