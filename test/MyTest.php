<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Transfer\Encrypt;
use Transfer\Decrypt;

$config = require_once __DIR__ . '/config.php';

$config['basePath'] = __DIR__;

$encrypt = new Encrypt($config);
# echo $encrypt->getPriKey();
$secret = $encrypt->doEncrypt('ceshi');
$decrypt = new Decrypt($config);
echo $decrypt->doDecrypt($secret);

# $encrypt->getNewPriAndPub();
