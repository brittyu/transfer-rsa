<?php
namespace Transfer;

use Transfer\TransferTrait\LoadKey;

class Encrypt
{
    use LoadKey;

    private $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function getPubKey()
    {
        $priKey = $this->loadPubKey($keyPath);

        return $priKey;
    }

    public function doEncrypt($text)
    {
        $time = $_SERVER['REQUEST_TIME'];

        $encryptString = 'spider=' . $time . '=' . $text;
        openssl_public_encrypt($encryptString, $encrypted, $this->getPubKey());

        $encrypted = base64_encode($encrypted);

        return $encrypted;
    }

    public function getNewPriAndPub()
    {
        return $this->generateOne($this->config['basePath']);
    }
}
