<?php
/**
 * Created by PhpStorm.
 * User: Orange
 * Date: 28.08.17
 * Time: 15:09
 */

//для php -f $_SERVER['DOCUMENT_ROOT'] не подходит
require_once '/var/www/worker/defines/mysql.php';

require_once '/var/www/worker/my_lib/mysql.php';
require_once '/var/www/worker/my_lib/error_catcher.php';

require_once '/var/www/worker/func/work.php';
require_once '/var/www/worker/func/payment.php';
