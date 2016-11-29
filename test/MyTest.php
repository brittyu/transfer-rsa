<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Transfer\Client;
use Transfer\Server;

$config = require_once __DIR__ . '/config.php';

$client = new Client($config);
$server = new Server($config);

$secret = $client->encrypt('ceshi');
echo $server->decrypt($secret);

echo "\n";

$secret = $server->encrypt('ceshi');
echo $client->decrypt($secret);
