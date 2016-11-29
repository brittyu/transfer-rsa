<?php
namespace Transfer;

use Transfer\TransferInterface;
use Transfer\TransferTrait\LoadKey;
use Transfer\TransferTrait\Validate;

class Client implements TransferInterface
{
    use LoadKey, Validate;

    private $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    private function getPubKey()
    {
        $pubKey = $this->loadPubKey();

        return $pubKey;
    }

    public function encrypt($text)
    {
        $time = $_SERVER['REQUEST_TIME'];

        $encryptString = 'spider=' . $time . '=' . $text;
        openssl_public_encrypt($encryptString, $encrypted, $this->getPubKey());

        $encrypted = base64_encode($encrypted);

        return $encrypted;
    }

    public function decrypt($text)
    {
        openssl_public_decrypt(base64_decode($text), $decrypted, $this->getPubKey());

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
