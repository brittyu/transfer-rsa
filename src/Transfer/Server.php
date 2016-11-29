<?php
namespace Transfer;

use Transfer\TransferInterface;
use Transfer\TransferTrait\LoadKey;
use Transfer\TransferTrait\Validate;

class Server implements TransferInterface
{
    use LoadKey, Validate;

    private $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    private function getPriKey()
    {
        $priKey = $this->loadPriKey();

        return $priKey;
    }

    public function encrypt($text)
    {
        $time = $_SERVER['REQUEST_TIME'];

        $encryptString = 'spider=' . $time . '=' . $text;
        openssl_private_encrypt($encryptString, $encrypted, $this->getPriKey());

        $encrypted = base64_encode($encrypted);

        return $encrypted;

    }

    public function decrypt($text)
    {
        openssl_private_decrypt(base64_decode($text), $decrypted, $this->getPriKey());

        if (! $decrypted) {
            throw new \Exception('can not decrypt');
        }

        $category = $this->validateForm($decrypted);

        if ($category == '') {
            return;
        }

        return $decrypted;
    }
}
