<?php
/**
 * Created by PhpStorm.
 * User: Orange
 * Date: 28.08.17
 * Time: 22:48
 */

//скрипт, обновляющий статус платежей на outdated
require_once '/var/www/worker/require.php';

error_catcher();

update_timeout_payments();