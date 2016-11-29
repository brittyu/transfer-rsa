<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Transfer\Client;
use Transfer\Server;

$config = require_once __DIR__ . '/config.php';

$config['basePath'] = __DIR__;

$client = new Client($config);
$server = new Server($config);

$secret = $client->encrypt('ceshi');
echo $server->decrypt($secret);

# $encrypt->getNewPriAndPub();



$secret = $server->encrypt('ceshi');
echo $client->decrypt($secret);
