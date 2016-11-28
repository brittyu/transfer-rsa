<?php
namespace Transfer;

use Transfer\TransferTrait\LoadKey;
use Transfer\TransferTrait\Validate;

class Decrypt
{
    use LoadKey, Validate;

    private $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function getPriKey()
    {
        $priKey = $this->loadPriKey();

        return $priKey;
    }

    public function doDecrypt($text)
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

