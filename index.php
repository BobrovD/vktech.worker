<?php



$mem = new Memcached;
$mem_servers = [
    array('46.101.140.13', 11211),
    array('138.68.108.7', 11211)
];
$mem->AddServers($mem_servers);

//ещё будем собирать статистику по серверам и если что то писать в ошибки о недоступности memcache
var_dump($mem->getStats());
